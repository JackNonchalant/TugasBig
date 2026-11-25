<?php

namespace App\Http\Controllers;

use App\Models\Distribution;
use App\Models\DistributionProof;
use App\Models\DistributionStatusHistory;
use App\Models\DonationItem;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DistributionController extends Controller
{
    /**
     * PBI-013: Daftar transaksi penyaluran barang.
     * Hanya untuk Admin/Tim Posko Transit.
     */
    public function index(Request $request): View
    {
        $query = Distribution::with(['donationItem', 'beneficiary', 'processor']);

        // Filter berdasarkan status
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_resi', 'like', "%{$search}%")
                  ->orWhereHas('donationItem', function ($qi) use ($search) {
                      $qi->where('nama_barang', 'like', "%{$search}%");
                  })
                  ->orWhereHas('beneficiary', function ($qu) use ($search) {
                      $qu->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $distributions = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total' => Distribution::count(),
            'menunggu' => Distribution::where('status', 'Menunggu Penyaluran')->count(),
            'proses' => Distribution::where('status', 'Dalam Proses Penyaluran')->count(),
            'selesai' => Distribution::where('status', 'Disalurkan')->count(),
        ];

        return view('distributions.index', compact('distributions', 'stats'));
    }

    /**
     * Form untuk membuat distribusi baru dari barang yang tersedia.
     */
    public function create(Request $request): View
    {
        $items = DonationItem::where('status', 'tersedia')
            ->with('donor')
            ->latest()
            ->get();

        $beneficiaries = User::where('role', 'beneficiary')->orderBy('name')->get();

        $selectedItemId = $request->get('item_id');

        return view('distributions.create', compact('items', 'beneficiaries', 'selectedItemId'));
    }

    /**
     * Simpan distribusi baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'donation_item_id' => ['required', 'exists:donation_items,id'],
            'beneficiary_id' => ['nullable', 'exists:users,id'],
            'catatan' => ['nullable', 'string', 'max:1000'],
        ], [
            'donation_item_id.required' => 'Barang donasi wajib dipilih.',
            'donation_item_id.exists' => 'Barang donasi tidak ditemukan.',
            'beneficiary_id.exists' => 'Penerima manfaat tidak ditemukan.',
        ]);

        $item = DonationItem::findOrFail($validated['donation_item_id']);

        // Pastikan barang berstatus tersedia
        if ($item->status !== 'tersedia') {
            return back()->with('error', 'Barang ini tidak dalam status tersedia untuk disalurkan.');
        }

        DB::transaction(function () use ($validated, $item) {
            // Buat distribusi
            $distribution = Distribution::create([
                'donation_item_id' => $item->id,
                'beneficiary_id' => $validated['beneficiary_id'] ?? null,
                'status' => 'Menunggu Penyaluran',
                'catatan' => $validated['catatan'] ?? null,
                'processed_by' => Auth::id(),
            ]);

            // Update status barang donasi
            $item->update(['status' => 'Dalam Proses Penyaluran']);

            // Catat histori status awal
            DistributionStatusHistory::create([
                'distribution_id' => $distribution->id,
                'status_before' => null,
                'status_after' => 'Menunggu Penyaluran',
                'catatan' => $validated['catatan'] ?? 'Distribusi baru dibuat',
                'changed_by' => Auth::id(),
            ]);

            // Kirim notifikasi ke donatur
            Notification::create([
                'user_id' => $item->user_id,
                'title' => 'Barang Donasi Dalam Proses Penyaluran',
                'message' => "Barang donasi \"{$item->nama_barang}\" Anda sedang diproses untuk penyaluran oleh Tim Posko Transit.",
                'type' => 'info',
                'related_type' => 'distribution',
                'related_id' => $distribution->id,
            ]);

            // Kirim notifikasi ke penerima manfaat jika ada
            if ($distribution->beneficiary_id) {
                Notification::create([
                    'user_id' => $distribution->beneficiary_id,
                    'title' => 'Barang Donasi Dialokasikan untuk Anda',
                    'message' => "Barang donasi \"{$item->nama_barang}\" telah dialokasikan untuk Anda. Tim Posko Transit sedang memproses penyaluran.",
                    'type' => 'info',
                    'related_type' => 'distribution',
                    'related_id' => $distribution->id,
                ]);
            }
        });

        return redirect()->route('admin.distributions.index')
            ->with('success', 'Distribusi baru berhasil dibuat untuk barang "' . $item->nama_barang . '".');
    }

    /**
     * PBI-013/014/015: Detail transaksi penyaluran + histori + bukti foto.
     */
    public function show($id): View
    {
        $distribution = Distribution::with([
            'donationItem.donor',
            'beneficiary',
            'processor',
            'statusHistories.changedByUser',
            'proofs.uploader',
        ])->findOrFail($id);

        return view('distributions.show', compact('distribution'));
    }

    /**
     * PBI-013: Form pembaruan status penyaluran.
     */
    public function editStatus($id): View
    {
        $distribution = Distribution::with(['donationItem', 'beneficiary'])->findOrFail($id);

        // Tentukan status yang bisa dipilih berdasarkan status saat ini
        $availableStatuses = Distribution::VALID_TRANSITIONS[$distribution->status] ?? [];

        return view('distributions.update-status', compact('distribution', 'availableStatuses'));
    }

    /**
     * PBI-013: Proses pembaruan status penyaluran.
     * PBI-014: Upload bukti foto serah terima (saat status Disalurkan).
     */
    public function updateStatus(Request $request, $id): RedirectResponse
    {
        $distribution = Distribution::with('donationItem')->findOrFail($id);

        $rules = [
            'status' => ['required', 'string', 'in:' . implode(',', Distribution::STATUSES)],
            'catatan' => ['nullable', 'string', 'max:1000'],
            'nomor_resi' => ['nullable', 'string', 'max:255'],
        ];

        $messages = [
            'status.required' => 'Status baru wajib dipilih.',
            'status.in' => 'Status yang dipilih tidak valid.',
            'nomor_resi.max' => 'Nomor resi maksimal 255 karakter.',
        ];

        // Jika status baru = Disalurkan, foto bukti bisa diupload
        if ($request->status === 'Disalurkan') {
            $rules['bukti_foto'] = ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'];
            $rules['bukti_foto.*'] = ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'];
            $messages['bukti_foto.image'] = 'File bukti harus berupa gambar.';
            $messages['bukti_foto.mimes'] = 'Format foto harus JPG, JPEG, atau PNG.';
            $messages['bukti_foto.max'] = 'Ukuran foto maksimal 2MB.';
        }

        $validated = $request->validate($rules, $messages);

        // Validasi transisi status
        if (!$distribution->canTransitionTo($validated['status'])) {
            return back()->with('error', "Status tidak dapat diubah dari \"{$distribution->status}\" ke \"{$validated['status']}\". Periksa alur status yang berlaku.");
        }

        DB::transaction(function () use ($request, $distribution, $validated) {
            $oldStatus = $distribution->status;
            $newStatus = $validated['status'];

            // Update distribusi
            $updateData = [
                'status' => $newStatus,
            ];

            if (!empty($validated['catatan'])) {
                $updateData['catatan'] = $validated['catatan'];
            }

            if (!empty($validated['nomor_resi'])) {
                $updateData['nomor_resi'] = $validated['nomor_resi'];
            }

            if ($newStatus === 'Disalurkan') {
                $updateData['distributed_at'] = now();
            }

            $distribution->update($updateData);

            // Update status barang donasi juga
            $donationItemStatus = match ($newStatus) {
                'Dalam Proses Penyaluran' => 'Dalam Proses Penyaluran',
                'Disalurkan' => 'Disalurkan',
                default => $distribution->donationItem->status,
            };
            $distribution->donationItem->update(['status' => $donationItemStatus]);

            // PBI-015: Catat histori perubahan status
            DistributionStatusHistory::create([
                'distribution_id' => $distribution->id,
                'status_before' => $oldStatus,
                'status_after' => $newStatus,
                'catatan' => $validated['catatan'] ?? null,
                'nomor_resi' => $validated['nomor_resi'] ?? null,
                'changed_by' => Auth::id(),
            ]);

            // PBI-014: Upload bukti foto serah terima
            if ($request->hasFile('bukti_foto')) {
                $files = $request->file('bukti_foto');
                // Jika single file (bukan array)
                if (!is_array($files)) {
                    $files = [$files];
                }

                foreach ($files as $foto) {
                    $path = $foto->store('distribution_proofs', 'public');
                    DistributionProof::create([
                        'distribution_id' => $distribution->id,
                        'foto_path' => $path,
                        'original_name' => $foto->getClientOriginalName(),
                        'uploaded_by' => Auth::id(),
                    ]);
                }
            }

            // Kirim notifikasi ke donatur
            $item = $distribution->donationItem;
            Notification::create([
                'user_id' => $item->user_id,
                'title' => 'Status Penyaluran Diperbarui',
                'message' => "Status penyaluran barang \"{$item->nama_barang}\" telah diperbarui menjadi \"{$newStatus}\"."
                    . ($validated['nomor_resi'] ? " No. Resi: {$validated['nomor_resi']}" : ''),
                'type' => $newStatus === 'Disalurkan' ? 'success' : 'info',
                'related_type' => 'distribution',
                'related_id' => $distribution->id,
            ]);

            // Kirim notifikasi ke penerima manfaat jika ada
            if ($distribution->beneficiary_id) {
                Notification::create([
                    'user_id' => $distribution->beneficiary_id,
                    'title' => 'Status Penyaluran Diperbarui',
                    'message' => "Status penyaluran barang \"{$item->nama_barang}\" telah diperbarui menjadi \"{$newStatus}\"."
                        . ($validated['nomor_resi'] ? " No. Resi: {$validated['nomor_resi']}" : ''),
                    'type' => $newStatus === 'Disalurkan' ? 'success' : 'info',
                    'related_type' => 'distribution',
                    'related_id' => $distribution->id,
                ]);
            }
        });

        return redirect()->route('admin.distributions.show', $distribution->id)
            ->with('success', "Status penyaluran berhasil diperbarui menjadi \"{$validated['status']}\".");
    }

    /**
     * PBI-014: Upload bukti foto serah terima secara terpisah.
     */
    public function uploadProof(Request $request, $id): RedirectResponse
    {
        $distribution = Distribution::findOrFail($id);

        $request->validate([
            'bukti_foto' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ], [
            'bukti_foto.required' => 'Foto bukti serah terima wajib diunggah.',
            'bukti_foto.image' => 'File harus berupa gambar.',
            'bukti_foto.mimes' => 'Format foto harus JPG, JPEG, atau PNG.',
            'bukti_foto.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        $path = $request->file('bukti_foto')->store('distribution_proofs', 'public');

        DistributionProof::create([
            'distribution_id' => $distribution->id,
            'foto_path' => $path,
            'original_name' => $request->file('bukti_foto')->getClientOriginalName(),
            'uploaded_by' => Auth::id(),
        ]);

        return redirect()->route('admin.distributions.show', $distribution->id)
            ->with('success', 'Bukti foto serah terima berhasil diunggah.');
    }

    /**
     * Hapus bukti foto (hanya admin).
     */
    public function deleteProof($id, $proofId): RedirectResponse
    {
        $proof = DistributionProof::where('distribution_id', $id)->findOrFail($proofId);

        // Hapus file dari storage
        if (Storage::disk('public')->exists($proof->foto_path)) {
            Storage::disk('public')->delete($proof->foto_path);
        }

        $proof->delete();

        return redirect()->route('admin.distributions.show', $id)
            ->with('success', 'Bukti foto berhasil dihapus.');
    }

    /**
     * Daftar notifikasi user (semua role).
     */
    public function notifications(): View
    {
        $notifications = \App\Models\Notification::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Tandai notifikasi sebagai sudah dibaca.
     */
    public function markNotificationRead($id): RedirectResponse
    {
        $notification = \App\Models\Notification::where('user_id', Auth::id())->findOrFail($id);
        $notification->markAsRead();

        // Redirect ke halaman terkait jika ada
        if ($notification->related_type === 'distribution' && $notification->related_id) {
            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.distributions.show', $notification->related_id);
            }
        }

        return redirect()->route('notifications.index');
    }

    /**
     * Tandai semua notifikasi sebagai sudah dibaca.
     */
    public function markAllNotificationsRead(): RedirectResponse
    {
        \App\Models\Notification::where('user_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return redirect()->route('notifications.index')
            ->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }
}

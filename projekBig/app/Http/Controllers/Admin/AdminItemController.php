<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonationItem;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminItemController extends Controller
{
    /**
     * Daftar barang donasi untuk verifikasi transit oleh Admin.
     */
    public function index(Request $request): View
    {
        $status = (string) $request->query('status', '');
        $search = trim((string) $request->query('search', ''));

        $query = DonationItem::with('donor');

        if ($status !== '' && $status !== 'semua') {
            $query->where('status', $status);
        }

        if ($search !== '') {
            $escaped = addcslashes($search, '\\%_');
            $pattern = '%' . $escaped . '%';
            $query->where(function ($q) use ($pattern) {
                $q->where('nama_barang', 'like', $pattern)
                  ->orWhere('kategori', 'like', $pattern)
                  ->orWhere('deskripsi', 'like', $pattern)
                  ->orWhereHas('donor', function ($qd) use ($pattern) {
                      $qd->where('name', 'like', $pattern)
                         ->orWhere('email', 'like', $pattern);
                  });
            });
        }

        $items = $query->orderByRaw("CASE WHEN status = 'Menunggu Verifikasi Transit' THEN 0 ELSE 1 END")
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $stats = [
            'total'    => DonationItem::count(),
            'menunggu' => DonationItem::where('status', 'Menunggu Verifikasi Transit')->count(),
            'tersedia' => DonationItem::where('status', 'tersedia')->count(),
            'ditolak'  => DonationItem::where('status', 'ditolak')->count(),
        ];

        return view('admin.items.index', compact('items', 'stats', 'status', 'search'));
    }

    /**
     * Setujui barang donasi -> status berubah menjadi 'tersedia' agar tampil di katalog.
     */
    public function approve(DonationItem $item): RedirectResponse
    {
        if ($item->status !== 'Menunggu Verifikasi Transit') {
            return back()->with('error', 'Barang ini tidak dalam status menunggu verifikasi.');
        }

        DB::transaction(function () use ($item) {
            $item->update(['status' => 'tersedia']);

            Notification::create([
                'user_id'      => $item->user_id,
                'title'        => 'Barang Donasi Lolos Verifikasi',
                'message'      => "Barang donasi \"{$item->nama_barang}\" Anda telah lolos verifikasi Tim Posko Transit dan kini tampil di katalog untuk penerima manfaat.",
                'type'         => 'success',
                'related_type' => 'donation_item',
                'related_id'   => $item->id,
            ]);
        });

        return back()->with('success', "Barang \"{$item->nama_barang}\" berhasil diverifikasi dan kini tersedia di katalog.");
    }

    /**
     * Tolak barang donasi -> status berubah menjadi 'ditolak' dengan alasan opsional.
     */
    public function reject(Request $request, DonationItem $item): RedirectResponse
    {
        if ($item->status !== 'Menunggu Verifikasi Transit') {
            return back()->with('error', 'Barang ini tidak dalam status menunggu verifikasi.');
        }

        $validated = $request->validate([
            'alasan' => ['nullable', 'string', 'max:500'],
        ], [
            'alasan.max' => 'Alasan penolakan maksimal 500 karakter.',
        ]);

        $alasan = trim((string) ($validated['alasan'] ?? ''));

        DB::transaction(function () use ($item, $alasan) {
            $item->update(['status' => 'ditolak']);

            $pesan = "Barang donasi \"{$item->nama_barang}\" belum dapat kami tayangkan di katalog setelah pemeriksaan Tim Posko Transit.";
            if ($alasan !== '') {
                $pesan .= " Catatan: {$alasan}";
            }

            Notification::create([
                'user_id'      => $item->user_id,
                'title'        => 'Barang Donasi Belum Lolos Verifikasi',
                'message'      => $pesan,
                'type'         => 'warning',
                'related_type' => 'donation_item',
                'related_id'   => $item->id,
            ]);
        });

        return back()->with('success', "Barang \"{$item->nama_barang}\" telah ditolak dan notifikasi dikirim ke donatur.");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\DonationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DonationHistoryController extends Controller
{
    /**
     * Menampilkan halaman riwayat donasi dengan dukungan filter status.
     *
     * Otorisasi data dijamin dengan scoping query: hanya record yang memiliki
     * user_id sama dengan Auth::id() yang dikembalikan oleh query.
     */
    public function index(Request $request): View
    {
        $userId = Auth::id();
        $statusParam = strtolower($request->query('status', 'semua'));

        // Query dasar terikat ketat pada ID donatur yang sedang login
        $query = DonationItem::where('user_id', $userId);

        // Penerapan filter status sesuai tab yang dipilih
        if ($statusParam && $statusParam !== 'semua') {
            match ($statusParam) {
                'menunggu' => $query->where(function ($q) {
                    $q->where('status', 'Menunggu Verifikasi Transit')
                      ->orWhere('status', 'menunggu');
                }),
                'diproses' => $query->where(function ($q) {
                    $q->where('status', 'diproses')
                      ->orWhere('status', 'tersedia');
                }),
                'selesai' => $query->where(function ($q) {
                    $q->where('status', 'disalurkan')
                      ->orWhere('status', 'selesai');
                }),
                default => null, // Abaikan jika parameter status tidak dikenal
            };
        }

        // Pengurutan konsisten berdasarkan tanggal transaksi terbaru & pagination
        $donations = $query->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        // Penghitungan jumlah item per status untuk badge counter pada filter tabs
        $counts = [
            'semua' => DonationItem::where('user_id', $userId)->count(),
            'menunggu' => DonationItem::where('user_id', $userId)->where(function ($q) {
                $q->where('status', 'Menunggu Verifikasi Transit')
                  ->orWhere('status', 'menunggu');
            })->count(),
            'diproses' => DonationItem::where('user_id', $userId)->where(function ($q) {
                $q->where('status', 'diproses')
                  ->orWhere('status', 'tersedia');
            })->count(),
            'selesai' => DonationItem::where('user_id', $userId)->where(function ($q) {
                $q->where('status', 'disalurkan')
                  ->orWhere('status', 'selesai');
            })->count(),
        ];

        return view('donations.history', compact('donations', 'statusParam', 'counts'));
    }

    /**
     * Menampilkan detail transaksi riwayat donasi beserta data penerima dan bukti penerimaan.
     * Hanya dapat diakses oleh pemilik transaksi (donatur bersangkutan) atau pihak berwenang (admin).
     */
    public function show(int $id): View
    {
        $donation = DonationItem::with('donor')->findOrFail($id);
        $user = Auth::user();

        if ($user->id !== $donation->user_id && !$user->isAdmin()) {
            abort(403, 'Akses ditolak. Anda tidak memiliki wewenang untuk melihat detail transaksi donasi ini.');
        }

        $authStatus = $user->id === $donation->user_id ? 'owner' : 'admin';

        return view('donations.show', compact('donation', 'authStatus'));
    }
}

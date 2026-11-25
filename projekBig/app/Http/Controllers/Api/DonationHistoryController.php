<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DonationItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DonationHistoryController extends Controller
{
    /**
     * Mengambil daftar riwayat donasi milik donatur yang sedang terautentikasi.
     * Data dikunci pada user_id pengguna yang login dan diurutkan berdasarkan tanggal terbaru.
     */
    public function index(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        $statusParam = strtolower((string) $request->query('status', 'semua'));

        $query = DonationItem::where('user_id', $userId)
            ->select(['id', 'nama_barang', 'kategori', 'jumlah', 'status', 'created_at']);

        if ($statusParam !== '' && $statusParam !== 'semua') {
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
                default => null,
            };
        }

        $donations = $query->orderByDesc('created_at')->get();

        return response()->json([
            'success' => true,
            'message' => 'Riwayat donasi berhasil dimuat.',
            'data'    => $donations,
        ], 200);
    }
}

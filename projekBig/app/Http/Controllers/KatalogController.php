<?php

namespace App\Http\Controllers;

use App\Models\DonationItem;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $page = (int) $request->get('page', 1);
        $loadError = null;

        try {
            // Hanya mengambil barang yang telah disetujui (Tersedia) dan memiliki stok > 0
            $baseQuery = DonationItem::whereIn('status', ['tersedia', 'Tersedia'])
                ->where('jumlah', '>', 0);

            $latestStamp = (clone $baseQuery)->max('updated_at');
            $latestId = (clone $baseQuery)->max('id');
            $totalActive = (clone $baseQuery)->count();
            $cacheKey = 'katalog_edukasi_p' . $page . '_' . md5($totalActive . '_' . $latestId . '_' . $latestStamp);

            // Caching katalog + pagination maksimal 12 item per halaman (PBI-004, PBI-005, PBI-006)
            $items = Cache::remember($cacheKey, now()->addMinutes(10), function () {
                return DonationItem::with('donor')
                    ->whereIn('status', ['tersedia', 'Tersedia'])
                    ->where('jumlah', '>', 0)
                    ->latest()
                    ->orderByDesc('id')
                    ->paginate(12);
            });
        } catch (\Throwable $e) {
            Log::error('Gagal memuat katalog barang edukasi: ' . $e->getMessage());
            $loadError = 'Terjadi kendala saat memuat data katalog barang. Silakan muat ulang halaman beberapa saat lagi.';
            $items = new LengthAwarePaginator([], 0, 12, $page, [
                'path' => $request->url(),
                'query' => $request->query(),
            ]);
        }

        return view('katalog.index', compact('items', 'loadError'));
    }
}
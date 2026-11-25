<?php

namespace App\Http\Controllers;

use App\Models\DonationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class KatalogController extends Controller
{
    /**
     * F-02 & F-03: Katalog & Pencarian Barang Edukasi (PBI-004 s/d PBI-009).
     * Hanya menampilkan barang aktif/tersedia (status = 'tersedia' & jumlah > 0).
     */
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', $request->query('q', '')));
        if (mb_strlen($search) > 100) {
            $search = mb_substr($search, 0, 100);
        }

        $page = max(1, (int) $request->query('page', 1));

        // Jika tidak ada kata kunci pencarian, gunakan cache katalog (PBI-005)
        if ($search === '') {
            $latestStamp = DonationItem::available()->max('updated_at');
            $totalActive = DonationItem::available()->count();
            $cacheKey = 'katalog_edukasi_p' . $page . '_' . md5($totalActive . '_' . $latestStamp);

            $items = Cache::remember($cacheKey, now()->addMinutes(10), function () {
                return DonationItem::with('donor')
                    ->available()
                    ->latest()
                    ->paginate(12);
            });
        } else {
            // Pencarian teroptimasi dengan index (status, jumlah, created_at) & parameter binding aman
            $items = DonationItem::with('donor')
                ->available()
                ->search($search)
                ->latest()
                ->paginate(12)
                ->withQueryString();
        }

        return view('katalog.index', compact('items', 'search'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\DonationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->get('page', 1);

        // Kunci cache otomatis berubah jika ada barang baru diposting (PBI-005)
        $latestStamp = DonationItem::where('status', 'tersedia')->max('updated_at');
        $totalActive = DonationItem::where('status', 'tersedia')->where('jumlah', '>', 0)->count();
        $cacheKey = 'katalog_edukasi_p' . $page . '_' . md5($totalActive . '_' . $latestStamp);

        // Caching katalog + fetching data berstatus tersedia + pagination 12 item (PBI-004 & PBI-006)
        $items = Cache::remember($cacheKey, now()->addMinutes(10), function () {
            return DonationItem::with('donor')
                ->where('status', 'tersedia')
                ->where('jumlah', '>', 0)
                ->latest()
                ->paginate(12);
        });

        return view('katalog.index', compact('items'));
    }
}
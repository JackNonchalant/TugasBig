<?php

namespace App\Http\Controllers;

use App\Models\Distribution;
use App\Models\DonationItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Donor Dashboard: list of items posted by current donor and quick action.
     */
    public function donor(): View
    {
        $items = DonationItem::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        $totalPosted = DonationItem::where('user_id', Auth::id())->count();
        $totalMenungguVerifikasi = DonationItem::where('user_id', Auth::id())->where('status', 'Menunggu Verifikasi Transit')->count();
        $totalTersedia = DonationItem::where('user_id', Auth::id())->where('status', 'tersedia')->count();
        $totalKategori = DonationItem::where('user_id', Auth::id())->distinct('kategori')->count('kategori');

        return view('dashboards.donor', compact('items', 'totalPosted', 'totalMenungguVerifikasi', 'totalTersedia', 'totalKategori'));
    }

    /**
     * Beneficiary Dashboard: available items catalog.
     */
    public function beneficiary(): View
    {
        $items = DonationItem::where('status', 'tersedia')
            ->with('donor')
            ->latest()
            ->paginate(6);

        $totalTersedia = DonationItem::where('status', 'tersedia')->count();

        return view('dashboards.beneficiary', compact('items', 'totalTersedia'));
    }

    /**
     * Admin Dashboard: all items, user counts, and monitoring.
     */
    public function admin(): View
    {
        $stats = [
            'total_items' => DonationItem::count(),
            'total_menunggu_verifikasi' => DonationItem::where('status', 'Menunggu Verifikasi Transit')->count(),
            'total_available' => DonationItem::where('status', 'tersedia')->count(),
            'total_users' => User::count(),
            'total_donors' => User::where('role', 'donor')->count(),
            'total_beneficiaries' => User::where('role', 'beneficiary')->count(),
        ];

        $items = DonationItem::with('donor')
            ->latest()
            ->paginate(15);

        return view('dashboards.admin', compact('stats', 'items'));
    }
}

<?php

namespace App\Http\Controllers;

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
        $totalTersedia = DonationItem::where('user_id', Auth::id())->where('status', 'tersedia')->count();

        return view('dashboards.donor', compact('items', 'totalPosted', 'totalTersedia'));
    }

    /**
     * Beneficiary Dashboard: available items catalog.
     */
    public function beneficiary(): View
    {
        $items = DonationItem::where('status', 'tersedia')
            ->with('donor')
            ->latest()
            ->paginate(12);

        return view('dashboards.beneficiary', compact('items'));
    }

    /**
     * Admin Dashboard: all items, user counts, and monitoring.
     */
    public function admin(): View
    {
        $stats = [
            'total_items' => DonationItem::count(),
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

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
     * Lacak Permintaan & Posko Transit.
     */
    public function permintaan(): View
    {
        $items = DonationItem::with('donor')
            ->latest()
            ->take(6)
            ->get();

        $totalPengajuan = DonationItem::count();
        $totalDalamProses = DonationItem::where('status', 'Menunggu Verifikasi Transit')->count();
        $totalSelesai = DonationItem::where('status', 'tersedia')->count();

        return view('dashboards.permintaan', compact('items', 'totalPengajuan', 'totalDalamProses', 'totalSelesai'));
    }

    /**
     * Admin Dashboard: all items, user counts, and monitoring.
     */
    public function admin(): View
    {
        return $this->verifikasi();
    }

    /**
     * Verifikasi Barang Donasi di Posko Transit.
     */
    public function verifikasi(): View
    {
        $pendingItems = DonationItem::where('status', 'Menunggu Verifikasi Transit')->with('donor')->latest()->get();
        $approvedItems = DonationItem::where('status', 'tersedia')->with('donor')->latest()->get();
        $rejectedItems = DonationItem::where('status', 'ditolak')->with('donor')->latest()->get();

        $stats = [
            'total_items' => DonationItem::count(),
            'total_menunggu_verifikasi' => $pendingItems->count(),
            'total_available' => $approvedItems->count(),
            'total_rejected' => $rejectedItems->count(),
            'total_users' => User::count(),
            'total_donors' => User::where('role', 'donor')->count(),
            'total_beneficiaries' => User::where('role', 'beneficiary')->count(),
        ];

        return view('dashboards.verifikasi', compact('pendingItems', 'approvedItems', 'rejectedItems', 'stats'));
    }
}

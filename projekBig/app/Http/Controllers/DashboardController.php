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
     * Admin Dashboard: Manajemen Katalog Barang & Posko Transit.
     */
    public function admin(): View
    {
        $items = DonationItem::with('donor')->latest()->paginate(15);

        $totalKatalog = DonationItem::count();
        $totalSiapKlaim = DonationItem::where('status', 'tersedia')->count();
        $totalStokMenipis = DonationItem::where('status', 'tersedia')->where('jumlah', '<=', 2)->count();
        $totalTersalurkan = DonationItem::whereIn('status', ['disalurkan', 'ditolak'])->count();

        $stats = [
            'total_items' => $totalKatalog,
            'total_menunggu_verifikasi' => DonationItem::where('status', 'Menunggu Verifikasi Transit')->count(),
            'total_available' => $totalSiapKlaim,
            'total_rejected' => DonationItem::where('status', 'ditolak')->count(),
            'total_users' => User::count(),
            'total_donors' => User::where('role', 'donor')->count(),
            'total_beneficiaries' => User::where('role', 'beneficiary')->count(),
        ];

        $poskoTransitList = DonationItem::getPoskoTransitList();

        return view('dashboards.admin', compact('items', 'totalKatalog', 'totalSiapKlaim', 'totalStokMenipis', 'totalTersalurkan', 'stats', 'poskoTransitList'));
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

    /**
     * Pusat Aktivitas & Notifikasi Pengguna.
     */
    public function notifikasi(): View
    {
        $user = Auth::user();

        // Ambil data aktivitas donasi dan status posko
        $myDonations = DonationItem::where('user_id', $user->id)->latest()->take(5)->get();
        $recentTransitItems = DonationItem::latest()->take(4)->get();
        $pendingTransitCount = DonationItem::where('status', 'Menunggu Verifikasi Transit')->count();

        return view('dashboards.notifikasi', compact('user', 'myDonations', 'recentTransitItems', 'pendingTransitCount'));
    }
}

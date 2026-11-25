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

        return view('dashboards.donor', compact('items', 'totalPosted', 'totalMenungguVerifikasi', 'totalTersedia'));
    }

    /**
     * Beneficiary Dashboard: available items catalog.
     */
    public function beneficiary(): View
    {
        $items = DonationItem::where('status', 'tersedia')
            ->where('jumlah', '>', 0)
            ->with('donor')
            ->latest()
            ->orderByDesc('id')
            ->paginate(12);

        return view('dashboards.beneficiary', compact('items'));
    }

    /**
     * Admin Dashboard: unified view — stats, users, distributions, items.
     */
    public function admin(): View
    {
        // ── Statistik Global ──────────────────────────────────────────
        $stats = [
            // Barang Donasi
            'total_items'               => DonationItem::count(),
            'total_menunggu_verifikasi' => DonationItem::where('status', 'Menunggu Verifikasi Transit')->count(),
            'total_available'           => DonationItem::where('status', 'tersedia')->count(),
            'total_disalurkan_items'    => DonationItem::where('status', 'Disalurkan')->count(),

            // Pengguna
            'total_users'               => User::whereIn('role', ['donor','beneficiary'])->count(),
            'total_donors'              => User::where('role', 'donor')->count(),
            'total_beneficiaries'       => User::where('role', 'beneficiary')->count(),
            'total_suspended'           => User::where('status_akun', 'suspended')->count(),

            // Distribusi
            'total_distributions'       => Distribution::count(),
            'distributions_menunggu'    => Distribution::where('status', 'Menunggu Penyaluran')->count(),
            'distributions_proses'      => Distribution::where('status', 'Dalam Proses Penyaluran')->count(),
            'distributions_selesai'     => Distribution::where('status', 'Disalurkan')->count(),
        ];

        // ── Barang Donasi terbaru (5) ─────────────────────────────────
        $recentItems = DonationItem::with('donor')
            ->latest()
            ->take(5)
            ->get();

        // ── Distribusi terbaru (5) ───────────────────────────────────
        $recentDistributions = Distribution::with(['donationItem', 'beneficiary', 'processor'])
            ->latest()
            ->take(5)
            ->get();

        // ── Pengguna terbaru (5) ─────────────────────────────────────
        $recentUsers = User::whereIn('role', ['donor', 'beneficiary'])
            ->latest()
            ->take(5)
            ->get();

        // ── Akun perlu perhatian (suspended) ─────────────────────────
        $suspendedUsers = User::where('status_akun', 'suspended')
            ->whereIn('role', ['donor','beneficiary'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboards.admin', compact(
            'stats',
            'recentItems',
            'recentDistributions',
            'recentUsers',
            'suspendedUsers'
        ));
    }
}

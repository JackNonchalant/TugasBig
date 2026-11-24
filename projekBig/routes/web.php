<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationItemController;
use App\Http\Controllers\KatalogController;
use App\Models\DonationItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - PojokBerbagi
|--------------------------------------------------------------------------
*/

// Public Landing Page
Route::get('/', function () {
    $recentItems = DonationItem::where('status', 'tersedia')
        ->with('donor')
        ->latest()
        ->take(6)
        ->get();

    return view('welcome', compact('recentItems'));
})->name('home');

// F-02: Katalog Barang Edukasi
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');

// Guest Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Central dashboard redirector
    Route::get('/dashboard', function () {
        $user = Auth::user();
        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'beneficiary' => redirect()->route('beneficiary.dashboard'),
            default => redirect()->route('donor.dashboard'),
        };
    })->name('dashboard');

    // Donor Specific Routes
    Route::middleware('role:donor')->group(function () {
        Route::get('/donor/dashboard', [DashboardController::class, 'donor'])->name('donor.dashboard');
        Route::get('/items/create', [DonationItemController::class, 'create'])->name('items.create');
        Route::post('/items', [DonationItemController::class, 'store'])->name('items.store');
    });

    // Beneficiary Specific Routes
    Route::middleware('role:beneficiary')->group(function () {
        Route::get('/beneficiary/dashboard', [DashboardController::class, 'beneficiary'])->name('beneficiary.dashboard');
    });

    // Lacak Permintaan / Posko Transit (dapat diakses pengguna terautentikasi)
    Route::get('/permintaan-saya', [DashboardController::class, 'permintaan'])->name('permintaan.index');

    // Pusat Aktivitas & Notifikasi (dapat diakses semua pengguna terautentikasi)
    Route::get('/notifikasi', [DashboardController::class, 'notifikasi'])->name('notifikasi.index');

    // Admin Specific Routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
        Route::get('/admin/verifikasi', [DashboardController::class, 'verifikasi'])->name('admin.verifikasi');
        Route::post('/admin/items/{id}/verify', [DonationItemController::class, 'verifyItem'])
            ->whereNumber('id')
            ->name('admin.items.verify');
    });

    // Detail barang donasi (dapat dilihat oleh pengguna terautentikasi)
    Route::get('/items/{id}', [DonationItemController::class, 'show'])
        ->whereNumber('id')
        ->name('items.show');

    // Ajukan Permintaan / Klaim Barang Donasi
    Route::get('/items/{id}/claim', [DonationItemController::class, 'claimForm'])
        ->whereNumber('id')
        ->name('items.claim');
    Route::post('/items/{id}/claim', [DonationItemController::class, 'submitClaim'])
        ->whereNumber('id')
        ->name('items.claim.submit');
});

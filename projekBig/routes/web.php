<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistributionController;
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

    // Admin Specific Routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

        // PBI-013: Daftar & manajemen penyaluran barang
        Route::get('/admin/distributions', [DistributionController::class, 'index'])->name('admin.distributions.index');
        Route::get('/admin/distributions/create', [DistributionController::class, 'create'])->name('admin.distributions.create');
        Route::post('/admin/distributions', [DistributionController::class, 'store'])->name('admin.distributions.store');
        Route::get('/admin/distributions/{id}', [DistributionController::class, 'show'])->name('admin.distributions.show');

        // PBI-013: Form & proses update status penyaluran
        Route::get('/admin/distributions/{id}/update-status', [DistributionController::class, 'editStatus'])->name('admin.distributions.edit-status');
        Route::put('/admin/distributions/{id}/update-status', [DistributionController::class, 'updateStatus'])->name('admin.distributions.update-status');

        // PBI-014: Upload bukti foto serah terima
        Route::post('/admin/distributions/{id}/upload-proof', [DistributionController::class, 'uploadProof'])->name('admin.distributions.upload-proof');
        Route::delete('/admin/distributions/{id}/proof/{proofId}', [DistributionController::class, 'deleteProof'])->name('admin.distributions.delete-proof');
    });

    // Notifikasi (semua role yang terautentikasi)
    Route::get('/notifications', [DistributionController::class, 'notifications'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [DistributionController::class, 'markNotificationRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [DistributionController::class, 'markAllNotificationsRead'])->name('notifications.read-all');

    // Detail barang donasi (dapat dilihat oleh pengguna terautentikasi)
    Route::get('/items/{id}', [DonationItemController::class, 'show'])
        ->whereNumber('id')
        ->name('items.show');
});

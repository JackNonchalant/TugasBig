<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistributionController;
use App\Http\Controllers\DonationHistoryController;
use App\Http\Controllers\DonationItemController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\Admin\AdminItemController;
use App\Http\Controllers\Admin\AdminUserController;
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

    // Metrik dihitung dari data nyata platform (satuan konsisten: unit & akun).
    $metrics = [
        'units_total'     => (int) DonationItem::sum('jumlah'),
        'units_delivered' => (int) DonationItem::where('status', 'Disalurkan')->sum('jumlah'),
        'donors'          => \App\Models\User::where('role', 'donor')->count(),
        'beneficiaries'   => \App\Models\User::where('role', 'beneficiary')->count(),
    ];

    // Penyaluran terbaru untuk kartu status (tanpa data pribadi penerima).
    $latestDistribution = \App\Models\Distribution::with('donationItem')
        ->latest('updated_at')
        ->first();

    return view('welcome', compact('recentItems', 'metrics', 'latestDistribution'));
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
Route::middleware(['auth', 'account.active'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->withoutMiddleware('account.active')
        ->name('logout');

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
        Route::get('/donor/my-donations', [DonationHistoryController::class, 'index'])->name('donor.my-donations');
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

        // Verifikasi Barang Donasi oleh Tim Posko Transit
        Route::get('/admin/items', [AdminItemController::class, 'index'])->name('admin.items.index');
        Route::patch('/admin/items/{item}/approve', [AdminItemController::class, 'approve'])->name('admin.items.approve');
        Route::patch('/admin/items/{item}/reject', [AdminItemController::class, 'reject'])->name('admin.items.reject');

        // Verifikasi Kelayakan Barang oleh Tim Posko Transit (PBI-005)
        Route::patch('/admin/items/{id}/verify', [DonationItemController::class, 'verify'])
            ->whereNumber('id')
            ->name('admin.items.verify');
            
        // Kelola Pengguna (PBI-016, PBI-017, PBI-018)
        Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::patch('/admin/users/{user}/suspend', [AdminUserController::class, 'suspend'])->name('admin.users.suspend');
        Route::patch('/admin/users/{user}/activate', [AdminUserController::class, 'activate'])->name('admin.users.activate');

        // Distribusi / Penyaluran Barang (PBI-013, PBI-014, PBI-015)
        Route::prefix('admin/distributions')->name('admin.distributions.')->group(function () {
            Route::get('/',                         [DistributionController::class, 'index'])       ->name('index');
            Route::get('/create',                   [DistributionController::class, 'create'])      ->name('create');
            Route::post('/',                        [DistributionController::class, 'store'])       ->name('store');
            Route::get('/{id}',                     [DistributionController::class, 'show'])        ->name('show');
            Route::get('/{id}/edit-status',         [DistributionController::class, 'editStatus'])  ->name('edit-status');
            Route::match(['post', 'put'], '/{id}/update-status', [DistributionController::class, 'updateStatus'])->name('update-status');
            Route::post('/{id}/upload-proof',       [DistributionController::class, 'uploadProof']) ->name('upload-proof');
            Route::delete('/{id}/proofs/{proofId}', [DistributionController::class, 'deleteProof']) ->name('delete-proof');
        });
    });

    // Notifikasi (semua role yang sudah login)
    Route::get('/notifications', [DistributionController::class, 'notifications'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [DistributionController::class, 'markNotificationRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [DistributionController::class, 'markAllNotificationsRead'])->name('notifications.read-all');

    // Detail barang donasi (dapat dilihat oleh pengguna terautentikasi)
    Route::get('/items/{id}', [DonationItemController::class, 'show'])
        ->whereNumber('id')
        ->name('items.show');

    // Detail riwayat donasi (hanya pemilik transaksi atau admin)
    Route::get('/donor/my-donations/{id}', [DonationHistoryController::class, 'show'])
        ->whereNumber('id')
        ->name('donor.my-donations.show');
});

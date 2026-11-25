<?php

use App\Http\Controllers\Api\DonationHistoryController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/my-donations', [DonationHistoryController::class, 'index'])
        ->name('api.my-donations');
});

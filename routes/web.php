<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    $locale = session('locale', config('app.locale', 'en'));
    if (! in_array($locale, ['en', 'ar', 'tr'], true)) {
        $locale = 'en';
    }

    return redirect()->route('home', ['locale' => $locale]);
});

Route::prefix('{locale}')
    ->whereIn('locale', ['en', 'ar', 'tr'])
    ->middleware('setlocale')
    ->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('throttle:60,1')->group(function () {
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::post('/products', [ProductController::class, 'store'])->middleware('role:admin|manager')->name('products.store');
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
        Route::put('/products/{product}', [ProductController::class, 'update'])->middleware('role:admin|manager')->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->middleware('role:admin|manager')->name('products.destroy');

        Route::get('/transactions', [StockTransactionController::class, 'index'])->name('transactions.index');
        Route::post('/transactions', [StockTransactionController::class, 'store'])->middleware('role:admin|manager')->name('transactions.store');

        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

        Route::get('/settings', [SettingsController::class, 'index'])->middleware('role:admin')->name('settings.index');
        Route::put('/settings', [SettingsController::class, 'update'])->middleware('role:admin')->name('settings.update');
    });
});

    require __DIR__.'/auth.php';
});

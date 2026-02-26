<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\ReportController;

Route::get('/', fn() => redirect()->route('products.index'));

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/transactions', [StockTransactionController::class, 'index'])->name('transactions.index');
Route::post('/transactions', [StockTransactionController::class, 'store'])->name('transactions.store');

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
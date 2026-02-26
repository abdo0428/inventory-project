<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalTransactions = StockTransaction::count();
        $lowStockProducts = Product::whereColumn('quantity', '<=', 'low_stock_threshold')->count();
        $recentTransactions = StockTransaction::with('product')->latest()->take(5)->get();

        return view('dashboard', compact('totalProducts', 'totalTransactions', 'lowStockProducts', 'recentTransactions'));
    }
}

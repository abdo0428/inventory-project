<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $days = (int)($request->get('days', 30));
        $days = max(1, min(365, $days));

        $from = now()->subDays($days);

        // الأكثر حركة: مجموع العمليات (IN+OUT) + مجموع الكميات
        $topMoving = StockTransaction::query()
            ->select([
                'product_id',
                DB::raw('COUNT(*) as tx_count'),
                DB::raw('SUM(qty) as total_qty'),
                DB::raw("SUM(CASE WHEN type='IN' THEN qty ELSE 0 END) as in_qty"),
                DB::raw("SUM(CASE WHEN type='OUT' THEN qty ELSE 0 END) as out_qty"),
            ])
            ->where('created_at', '>=', $from)
            ->groupBy('product_id')
            ->orderByDesc('tx_count')
            ->with('product:id,sku,name,quantity,low_stock_threshold')
            ->limit(20)
            ->get();

        // منتجات منخفضة المخزون
        $lowStock = Product::query()
            ->whereColumn('quantity', '<=', 'low_stock_threshold')
            ->orderBy('quantity')
            ->get();

        return view('reports.index', compact('topMoving', 'lowStock', 'days'));
    }
}
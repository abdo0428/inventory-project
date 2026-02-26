<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $days = (int) $request->get('days', 30);
        $days = max(1, min(365, $days));
        $from = now()->subDays($days);

        $topMoving = Cache::remember("reports.top_moving.{$days}", 300, function () use ($from) {
            return StockTransaction::query()
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
        });

        $lowStock = Cache::remember('reports.low_stock', 300, function () {
            return Product::query()
                ->whereColumn('quantity', '<=', 'low_stock_threshold')
                ->orderBy('quantity')
                ->get();
        });

        $periodStats = StockTransaction::query()
            ->where('created_at', '>=', $from)
            ->selectRaw("SUM(CASE WHEN type = 'IN' THEN qty ELSE 0 END) as in_qty")
            ->selectRaw("SUM(CASE WHEN type = 'OUT' THEN qty ELSE 0 END) as out_qty")
            ->first();

        return view('reports.index', [
            'topMoving' => $topMoving,
            'lowStock' => $lowStock,
            'days' => $days,
            'periodStats' => [
                'in' => (int) ($periodStats?->in_qty ?? 0),
                'out' => (int) ($periodStats?->out_qty ?? 0),
            ],
        ]);
    }
}

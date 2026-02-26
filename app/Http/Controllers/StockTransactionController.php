<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockTransactionController extends Controller
{
    public function index()
    {
        $transactions = StockTransaction::with('product')
            ->latest()->limit(200)->get();

        $products = Product::orderBy('name')->get();

        return view('transactions.index', compact('transactions', 'products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required','exists:products,id'],
            'type' => ['required','in:IN,OUT'],
            'qty' => ['required','integer','min:1'],
            'note' => ['nullable','string','max:255'],
        ]);

        DB::transaction(function () use ($data) {
            $product = Product::lockForUpdate()->findOrFail($data['product_id']);

            $before = $product->quantity;

            if ($data['type'] === 'OUT' && $data['qty'] > $before) {
                abort(422, 'لا يمكن سحب كمية أكبر من المتوفر في المخزن.');
            }

            $after = $data['type'] === 'IN'
                ? $before + $data['qty']
                : $before - $data['qty'];

            $product->update(['quantity' => $after]);

            StockTransaction::create([
                'product_id' => $product->id,
                'type' => $data['type'],
                'qty' => $data['qty'],
                'note' => $data['note'] ?? null,
                'before_qty' => $before,
                'after_qty' => $after,
            ]);
        });

        return back()->with('success', 'تم تسجيل العملية بنجاح ✅');
    }
}
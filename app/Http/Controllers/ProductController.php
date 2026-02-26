<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        $products = $query->latest()->paginate(20);

        return view('products.index', compact('products'));
    }

    public function show(string $locale, Product $product)
    {
        $transactions = $product->stockTransactions()->latest()->paginate(10);

        return view('products.show', compact('product', 'transactions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sku' => ['required', 'string', 'max:80', 'unique:products,sku', 'regex:/^[A-Z0-9\-]+$/'],
            'name' => ['required', 'string', 'max:190', 'min:2'],
            'description' => ['nullable', 'string', 'max:2000'],
            'quantity' => ['required', 'integer', 'min:0', 'max:1000000'],
            'low_stock_threshold' => ['required', 'integer', 'min:0', 'max:1000000'],
        ]);

        Product::create($data);

        return back()->with('success', __('ui.Product created successfully.'));
    }

    public function update(Request $request, string $locale, Product $product)
    {
        $data = $request->validate([
            'sku' => ['required', 'string', 'max:80', Rule::unique('products', 'sku')->ignore($product->id), 'regex:/^[A-Z0-9\-]+$/'],
            'name' => ['required', 'string', 'max:190', 'min:2'],
            'description' => ['nullable', 'string', 'max:2000'],
            'low_stock_threshold' => ['required', 'integer', 'min:0', 'max:1000000'],
        ]);

        $product->update($data);

        Cache::forget('reports.low_stock');

        return back()->with('success', __('ui.Product updated successfully.'));
    }

    public function destroy(string $locale, Product $product)
    {
        $product->delete();

        Cache::forget('reports.low_stock');

        return back()->with('success', __('ui.Product deleted successfully.'));
    }
}

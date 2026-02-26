<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sku' => ['required','string','max:80', 'unique:products,sku'],
            'name' => ['required','string','max:190'],
            'description' => ['nullable','string','max:2000'],
            'quantity' => ['required','integer','min:0'],
            'low_stock_threshold' => ['required','integer','min:0','max:1000000'],
        ]);

        Product::create($data);

        return back()->with('success', 'تم إضافة المنتج بنجاح ✅');
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'sku' => ['required','string','max:80', Rule::unique('products','sku')->ignore($product->id)],
            'name' => ['required','string','max:190'],
            'description' => ['nullable','string','max:2000'],
            'low_stock_threshold' => ['required','integer','min:0','max:1000000'],
        ]);

        $product->update($data);

        return back()->with('success', 'تم تحديث المنتج بنجاح ✅');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'تم حذف المنتج ✅');
    }
}
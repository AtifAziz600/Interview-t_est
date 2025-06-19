<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return Inertia::render('products/index', compact('products'));
    }

    public function create()
    {
        return Inertia::render('products/create', []);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|in:fruits,vegetables,snacks,dairy',
        ]);

        Product::create($data);

        return redirect()->route('products.index')->with('message', 'Product Added Successfully');
    }
    public function edit(Product $product){
        return Inertia::render('products/Edit', compact('product'));
    }

    public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'category' => 'required|string|in:fruits,vegetables,snacks,dairy',
    ]);

    $product->update([
        'name' => $request->input('name'),
        'price' => $request->input('price'),
        'category' => $request->input('category'),
    ]);

    return redirect()->route('products.index')->with('message', 'Product Edit Successfully');
}

public function destroy(Product $product){
    $product->delete();
    return redirect()->route('products.index')->with('message', 'Product Delete Successfully');
}
}

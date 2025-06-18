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
}

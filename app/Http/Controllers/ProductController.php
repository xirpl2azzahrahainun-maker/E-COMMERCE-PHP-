<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::latest()->paginate(10);
        return view('product.index', compact('products'));
    }

    public function create(): View
    {
        return view('product.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // VALIDASI
        $request->validate([
            'image'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'title'       => 'required|string|min:5',
            'description' => 'required|string|min:10',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
        ]);

        // UPLOAD IMAGE
        $image = $request->file('image');
        $image->storeAs('products', $image->hashName());

        // SIMPAN KE DATABASE
        Product::create([
            'image'       => $image->hashName(),
            'title'       => $request->title,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
        ]);

        return redirect()
            ->route('product.index')
            ->with('success', 'Product berhasil ditambahkan!');
    }


    public function show(string $id): view{
        $product= Product::findOrfail($id);
        return view('product.show', compact('product'));
    }

     public function edit($id) {
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }

     public function update(Request $request, $id) {
        $request->validate([
            'image' => 'sometimes|image|max:2048',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product', 'public');
            $product->image = $imagePath;
        }

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id) {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
}


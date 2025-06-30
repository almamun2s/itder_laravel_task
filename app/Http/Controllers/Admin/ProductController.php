<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the product.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'category' => 'required',
            'price' => 'required',
        ]);

        Product::create([
            'name' => $request->name,
            'category_id' => (int) $request->category,
            'price' => (float) $request->price,
            'discount_price' => $request->disc_price ? (float) $request->disc_price : null,
            'description' => $request->description,
        ]);


        toastr()->success('Product created.');
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.product.edit', compact(['product', 'categories']));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|min:3',
            'category' => 'required',
            'price' => 'required',
        ]);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = (int) $request->category;
        $product->price = (float) $request->price;
        $product->discount_price = $request->disc_price ? (float) $request->disc_price : null;

        $product->save();

        toastr()->success('Product Updated.');
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        toastr()->info('Product Deleted.');
        return redirect()->route('admin.product.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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

        $fileName = null;
        if ($request->file('image')) {
            $file = $request->file('image');

            // Renaming the file
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            if (!file_exists(PUBLIC_PATH . 'uploads/products')) {
                mkdir(PUBLIC_PATH . 'uploads/products');
            }
            // Uploading the file to upload directory
            $file->move(PUBLIC_PATH . 'uploads', $fileName);

            // Resize the image and move
            $imageManager = new ImageManager(Driver::class);
            $image = $imageManager->read("uploads/$fileName");
            $image->resize(1000, 700);
            $image->save(PUBLIC_PATH . 'uploads/products/' . $fileName);

            // Deleting image from upload directory
            unlink(PUBLIC_PATH . 'uploads/' . $fileName);
        }

        Product::create([
            'name' => $request->name,
            'category_id' => (int) $request->category,
            'price' => (float) $request->price,
            'discount_price' => $request->disc_price ? (float) $request->disc_price : null,
            'description' => $request->description,
            'image' => $fileName,
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

        if ($request->file('image')) {
            // Removing previows images
            if ($product->image && file_exists(PUBLIC_PATH . 'uploads/products/' . $product->image)) {
                unlink(PUBLIC_PATH . 'uploads/products/' . $product->image);
            }
            $file = $request->file('image');
            // Renaming the file
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            if (!file_exists(PUBLIC_PATH . 'uploads/products')) {
                mkdir(PUBLIC_PATH . 'uploads/products');
            }
            // Uploading the file to upload directory
            $file->move(PUBLIC_PATH . 'uploads', $fileName);

            // Resize the image and move
            $imageManager = new ImageManager(Driver::class);
            $image = $imageManager->read("uploads/$fileName");
            $image->resize(1000, 700);
            $image->save(PUBLIC_PATH . 'uploads/products/' . $fileName);
            $product->image = $fileName;

            // Deleting image from upload directory
            unlink(PUBLIC_PATH . 'uploads/' . $fileName);
        }

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
        if (($product->image != null) && (file_exists(PUBLIC_PATH . 'uploads/products/' . $product->image))) {
            unlink(PUBLIC_PATH . 'uploads/products/' . $product->image);
        }
        $product->delete();

        toastr()->info('Product Deleted.');
        return redirect()->route('admin.product.index');
    }
}

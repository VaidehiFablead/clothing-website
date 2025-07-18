<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::all(); // fetch all categories
        return view('addproductform', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:category,category_id',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'status' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        $imageNames = [];

        if ($request->hasFile('images')) {
            // dd($request->hasFile('images'));
            foreach ($request->file('images') as $index => $image) {
                $name = time() . '_' . $index . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/products'), $name);
                $imageNames[] = $name;
            }
        }

        Product::create([
            'image' => implode(',', $imageNames),
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ]);


        return redirect()->back()->with('success', 'Product added successfully!');
    }
    
    //  Add this method to show product table
    public function showTable()
    {
        $products = Product::with('category')->latest()->get(); // eager load category
        return view('tables', compact('products'));
    }

    public function index()
    {
        $product = Product::with('category')->get(); // unused unless needed elsewhere
        return view('product', compact('product'));
    }



    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('tables')->with('success', 'Product deleted.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('editProduct', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:category,category_id',
            'price' => 'required|numeric',
            'description' => 'required',
            'status' => 'required',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png',
            'old_images' => 'nullable|string'
        ]);

        $data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $allImages = [];

        // Include old images
        if ($request->filled('old_images')) {
            $oldImages = explode(',', $request->old_images);
            $allImages = array_merge($allImages, $oldImages);
        }

        // Add new uploaded images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/products'), $filename);
                $allImages[] = $filename;
            }
        }

        $data['image'] = implode(',', $allImages);

        $product->update($data);

        return response()->json([
            'message' => 'Product updated successfully.',
            'redirect' => route('tables')
        ]);
    }




    public function view($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('viewProduct', compact('product'));
    }
}

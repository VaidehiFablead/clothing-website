<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imageNames = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $name = time() . '_' . $image->getClientOriginalName();
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

    public function index()
    {
        $product = Product::with('category')->get(); // eager load category
        return view('product', compact('product'));
    }
}

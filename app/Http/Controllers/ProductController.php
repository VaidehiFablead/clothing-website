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
        $products = Product::with('category')->get(); // eager load category
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

    Log::info('Update Request:', $request->all());
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'status' => 'required',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
        ];

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/products'), $filename);
                $images[] = $filename;
            }
            $data['image'] = implode(',', $images);
        }

        $product->update($data);

        return response()->json([
            'message' => 'Product updated successfully.',
            'redirect' => route('tables')  // Make sure route 'tables' exists
        ]);
    }
}

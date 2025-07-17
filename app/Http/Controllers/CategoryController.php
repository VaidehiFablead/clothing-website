<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('viewcategory', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:category,name',
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->route('viewcategory')->with('success', 'Category added successfully');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('editcategory', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update(['name' => $request->name]);
        return redirect()->route('viewcategory')->with('success', 'Category updated.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('viewcategory')->with('success', 'Category deleted.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function showOrder()
    {
        $customers = Customer::all(); // ✅ fetch customers
        $products = Product::all();
        return view('orders', compact('customers', 'products')); // ✅ pass to view
    }


    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|array',
            'price' => 'required|array',
            'qty' => 'required|array',
            'total' => 'required|array',
            'subtotal' => 'required'
        ]);


        foreach($request->product_id as $index => $productId){
            $product=Product::find($productId);

            Orders::create([
                'customer_id'=>$request->customer_id,
                'product_name'=>$request->product_name,
                'qty'=>$request->qty[$index],
                'price'=>$request->price[$index],
                'subtotal'=>$request->total[$index],
            ]);
        }
        return redirect()->back()->with("success","ordered successfully");
    }
}

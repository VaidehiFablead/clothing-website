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
        $customers = Customer::all(); 
        $products = Product::all();
        return view('orders', compact('customers', 'products')); 
    }


    public function store(Request $request)
    {
        // logger('Request payload:', $request->all());

        $request->validate([
            'customer_id' => 'required|exists:customer,customer_id',
            'product_id' => 'required|array',
            'product_name' => 'required|array',
            'price' => 'required|array',
            'qty' => 'required|array',
            'total' => 'required|array',
            'subtotal' => 'required'
        ]);

        foreach ($request->product_id as $index => $productId) {
            Orders::create([
                'customer_id' => $request->customer_id,
                'product_name' => $request->product_name[$index],
                'qty' => $request->qty[$index],
                'price' => $request->price[$index],
                'subtotal' => $request->total[$index],
            ]);
        }

        return response()->json(['message' => 'Order placed successfully']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\OrderItem;
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


    // public function store(Request $request)
    // {

    //     $request->validate([
    //         'customer_id' => 'required|exists:customer,customer_id',
    //         'product_id' => 'required|array',
    //         'product_name' => 'required|array',
    //         'price' => 'required|array',
    //         'qty' => 'required|array',
    //         'total' => 'required|array',
    //         'subtotal' => 'required'
    //     ]);

    //     foreach ($request->product_id as $index => $productId) {
    //         Orders::create([
    //             'customer_id' => $request->customer_id,
    //             'product_name' => $request->product_name[$index],
    //             'qty' => $request->qty[$index],
    //             'price' => $request->price[$index],
    //             'subtotal' => $request->total[$index],
    //         ]);
    //     }

    //     return response()->json(['message' => 'Order placed successfully']);
    // }



    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customer,customer_id',
            'product_id' => 'required|array',
            'product_name' => 'required|array',
            'price' => 'required|array',
            'qty' => 'required|array',
            'total' => 'required|array',
            'subtotal' => 'required'
        ]);

        // Step 1: Create one order
        $order = Orders::create([
            'customer_id' => $request->customer_id,
            'subtotal' => $request->subtotal,
        ]);

        // Step 2: Insert multiple order_items
        foreach ($request->product_id as $index => $productId) {
                OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'product_name' => $request->product_name[$index],
                'qty' => $request->qty[$index],
                'price' => $request->price[$index],
                'total' => $request->total[$index],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json(['message' => 'Order placed successfully']);
    }

    public function index()
    {
        $orders = Orders::all();
        return view('viewOrder', compact('orders'));
    }
}

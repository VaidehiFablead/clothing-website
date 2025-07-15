<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
   public function index()
    {
        return view('addcustomer');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customer,email',
            'password' => 'required|min:6',
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'gender' => 'required',
            'city' => 'required',
            'address' => 'required',
            'contact' => 'required|digits:10',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/customers'), $imageName);
        }

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'image' => $imageName,
            'gender' => $request->gender,
            'city' => $request->city,
            'address' => $request->address,
            'contact' => $request->contact,
        ]);

        return response()->json(['success' => true, 'message' => 'Customer added successfully!']);
    }
}

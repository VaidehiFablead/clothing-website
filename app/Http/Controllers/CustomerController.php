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
            'email' => 'required|email',
            'password' => 'required|min:6',
            'image' => 'nullable|image|mimes:jpeg,jpg,png',
            'gender' => 'required',
            'city' => 'required',
            'address' => 'required',
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
            'address' => $request->address
        ]);

        return redirect()->back()->with('success', 'Customer added successfully!');
    }
}

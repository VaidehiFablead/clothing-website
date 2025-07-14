<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class ViewCustomerController extends Controller
{
    public function show()
    {
        return view('viewcustomer');
    }

    public function showTable()
    {
        $customer = Customer::all();
        return view('viewcustomer', compact('customer'));
    }

    public function deleteCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('viewcustomer')->with('success', 'Customer deleted successfully.');
    }


// update
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('editCustomer', compact('customer'));
    }

    public function update(Request $request, $id)
    {    
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'city' => 'required',
            'address' => 'required',
            'contact' => 'required',
            // add more validations if needed
        ]);

        $customer = Customer::findOrFail($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->gender = $request->gender;
        $customer->city = $request->city;
        $customer->address = $request->address;
        $customer->contact = $request->contact;

        // optional: handle image update

        $customer->save();

        return redirect()->route('viewcustomer')->with('success', 'Customer updated successfully.');
    }
}

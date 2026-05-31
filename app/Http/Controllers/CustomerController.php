<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    // Display customers table (only logged-in user's records)
    public function index()
    {
        if (!session('user')) {
            return redirect()->route('login');
        }
        
        $customers = Customer::where('user_id', session('id'))->get();
        return view('pages.customers', compact('customers'));
    }

    // Add customer
    public function store(Request $request)
    {
        // Check if email exists
        $existing = Customer::where('email', $request->email)->first();
        
        if ($existing) {
            return redirect()->back()->with('error', 'Email already exists!');
        }
        
        // Create customer
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->user_id = session('id');
        $customer->save();
        
        return redirect()->back()->with('success', 'Customer added successfully!');
    }

    // Update customer
    public function update(Request $request)
    {
        $customer = Customer::find($request->customer_id);
        
        // Check if email exists (exclude current customer)
        $existing = Customer::where('email', $request->email)
                        ->where('id', '!=', $request->customer_id)
                        ->first();
        
        if ($existing) {
            return redirect()->back()->with('error', 'Email already used!');
        }
        
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();
        
        return redirect()->back()->with('success', 'Customer updated successfully!');
    }

    // Delete customer
    public function destroy(Request $request)
    {
        $customer = Customer::find($request->customer_id);
        $customer->delete();
        
        return redirect()->back()->with('success', 'Customer deleted successfully!');
    }
}
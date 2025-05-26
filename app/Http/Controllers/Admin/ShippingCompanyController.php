<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingCompany;

class ShippingCompanyController extends Controller
{
    // Display a listing of the shipping companies
    public function index()
    {
        $shippingCompanies = ShippingCompany::all();
        return view('admin.shipping.index', compact('shippingCompanies'));
    }

    // Show the form for creating a new shipping company
    public function create()
    {
        return view('admin.shipping.create');
    }

    // Store a newly created shipping company in storage
   // Store a newly created shipping company in storage
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'charge' => 'required|numeric|min:0', // Ensure charge field is validated properly
        ]);

        // Create a new shipping company
        ShippingCompany::create([
            'name' => $request->name,
            'charge' => $request->charge, // Save the shipping price correctly
        ]);

        return redirect()->route('admin.shipping.index')->with('success', 'Shipping company added successfully!');
    }

    // Show the form for editing the specified shipping company
    public function edit($id)
    {
        $shippingCompany = ShippingCompany::findOrFail($id);
        return view('admin.shipping.edit', compact('shippingCompany'));
    }

    // Update the specified shipping company in storage
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'charge' => 'required|numeric|min:0',
        ]);

        // Find and update the shipping company
        $shippingCompany = ShippingCompany::findOrFail($id);
        $shippingCompany->update([
            'name' => $request->name,
            'charge' => $request->charge,
        ]);

        return redirect()->route('admin.shipping.index')->with('success', 'Shipping company updated successfully!');
    }

    // Remove the specified shipping company from storage
    public function destroy($id)
    {
        $shippingCompany = ShippingCompany::findOrFail($id);
        $shippingCompany->delete();

        return redirect()->route('admin.shipping.index')->with('success', 'Shipping company deleted successfully!');
    }
}

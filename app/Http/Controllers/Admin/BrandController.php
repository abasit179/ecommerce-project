<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    // Display a listing of the brands
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    // Show the form for creating a new brand
    public function create()
    {
        return view('admin.brands.create');
    }

    // Store a newly created brand in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands,name|max:255',
            'status' => 'required|boolean',
        ]);

        Brand::create($request->all());

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully.');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $brand->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }



    // Remove the specified brand from storage
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully.');
    }
}
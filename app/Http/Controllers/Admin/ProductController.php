<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price_old' => 'nullable|numeric',
            'price_new' => 'nullable|numeric',
            'status' => 'required|in:0,1',
            'tags' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:subcategories,id',
            'brand_id' => 'required|exists:brands,id',
            'sku' => 'nullable|string',
            'stock_quantity' => 'nullable|integer',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product = new Product();
        $product->fill($request->except('images')); // Fill all attributes except images

        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/products'), $imageName);
                $imagePaths[] = 'uploads/products/' . $imageName;
            }
            $product->images = json_encode($imagePaths);
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $subCategories = Subcategory::all();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'subCategories'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price_old' => 'nullable|numeric',
            'price_new' => 'nullable|numeric',
            'status' => 'required|in:0,1',
            'tags' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:subcategories,id',
            'brand_id' => 'required|exists:brands,id',
            'sku' => 'nullable|string',
            'stock_quantity' => 'nullable|integer',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product->update($validatedData);

        // Handle image upload
        if ($request->hasFile('images')) {
            // Retrieve existing images
            $existingImages = json_decode($product->images, true) ?: [];

            // Process new images
            $newImagePaths = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/products'), $imageName);
                $newImagePaths[] = 'uploads/products/' . $imageName;
            }

            // Merge new images with existing ones
            $allImagePaths = array_merge($existingImages, $newImagePaths);
            $product->images = json_encode($allImagePaths);
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }

    // SubcategoryController.php
    public function getUpdatedSubcategories($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json(['subcategories' => $subcategories]);
    }
    


    // ProductController.php
public function deleteImage(Request $request)
{
    $imagePath = $request->input('image');
    
    // Delete image from public directory
    if (file_exists(public_path($imagePath))) {
        unlink(public_path($imagePath));
    }

    // Remove image from database
    $product = Product::whereJsonContains('images', $imagePath)->first();
    if ($product) {
        $images = json_decode($product->images, true);
        if (($key = array_search($imagePath, $images)) !== false) {
            unset($images[$key]);
            $product->images = json_encode(array_values($images));
            $product->save();
        }
    }

    return response()->json(['success' => true]);
}


    public function destroy(Product $product)
    {
        // Delete any associated images if needed
        if ($product->images) {
            $images = json_decode($product->images, true);
            foreach ($images as $image) {
                if (Storage::exists($image)) {
                    Storage::delete($image);
                }
            }
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
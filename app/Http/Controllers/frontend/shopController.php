<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request, $categorySlug = NULL, $subCategorySlug = NULL)
    {
        $categorySelected = '';
        $subCategorySelected = '';
        $brandsArray = [];

        $navCategories = Category::with('subcategories')->where('status', 1)->take(5)->get();
        $categories = Category::with('subcategories')->where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();

        $products = Product::where('status', 1);

        // Apply filters
        if (!empty($categorySlug)) {
            $category = Category::where('name', $categorySlug)->first();
            if ($category) {
                $products = $products->where('category_id', $category->id);
                $categorySelected = $category->id;
            }
        }

        if (!empty($subCategorySlug)) {
            $subCategory = SubCategory::where('name', $subCategorySlug)->first();
            if ($subCategory) {
                $products = $products->where('sub_category_id', $subCategory->id);
                $subCategorySelected = $subCategory->id;
            }
        }

        // brand filter
        if (!empty($request->get('brand'))) {
            $brandsArray = explode(',', $request->get('brand'));
            $products = $products->whereIn('brand_id', $brandsArray);
        }



        // search filter
        if (!empty($request->get('search'))) {
            $products = $products->where('name', 'like', '%' . $request->get('search') . '%');
        }


        if ($request->get('sort') != '') {
            if ($request->get('sort') == 'latest') {
                $products = $products->orderBy('id', 'DESC');
            } elseif ($request->get('sort') == 'price_desc') {
                $products = $products->orderBy('price_new', 'DESC');
            } else {
                $products = $products->orderBy('price_new', 'ASC');
            }
        } else {
            $products = $products->orderBy('id', 'DESC');
        }



        $products = $products->paginate(6);

        $data['navCategories'] = $navCategories;
        $data['categories'] = $categories;
        $data['brands'] = $brands;
        $data['products'] = $products;
        $data['categorySelected'] = $categorySelected;
        $data['subCategorySelected'] = $subCategorySelected;
        $data['brandsArray'] = $brandsArray;
        $data['sort'] = $request->get('sort');

        return view('frontend.shop', $data);
    }


    public function product($id)
    {
        $navCategories = Category::with('subcategories')->where('status', 1)->take(5)->get();
        // Fetch the product by ID
        $product = Product::find($id);


        // Check if product exists
        if (!$product) {
            abort(404);
        }

        // You can also fetch related products if needed
        $relatedProducts = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->take(5)->get();

        // Pass the product data to the detail view
        return view('frontend.product', compact('navCategories', 'product', 'relatedProducts'));
    }
}

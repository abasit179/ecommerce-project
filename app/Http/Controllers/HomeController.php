<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index(){
        $navCategories = Category::with('subcategories')
                    ->where('status', 1)
                    ->take(5)
                    ->get();
        $products = Product::where('status', 1)->paginate(12);
        $featuredProducts = Product::where('status', 1)
                   ->where('tags', 'LIKE', '%featured%')->paginate(8);

        
       

        return view('frontend.home',compact('navCategories' , 'products', 'featuredProducts'));
    }


    public function addToWishlist(Request $request){

         // if user not login go to login page
         if (Auth::check() == false) {

            if (!session()->has('url.intended')) {
                session(['url.intended' => url()->previous()]);
            }
            


            return response()->json([
                'status' => false,
            ]);
        }
        session()->forget('url.intended');


        $product=Product::where('id', $request->id)->first();
        if($product == null){
            return response()->json([
                'status' => true,
                'message'=> '<div class="alert alert-danger">Product not found</div>'
            ]);
        }


        Wishlist::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'product_id'=>$request->id
            ],
            [
                'user_id' => Auth::user()->id,
                'product_id'=>$request->id
            ]
        );


        return response()->json([
            'status' => true,
            'message' =>'<div class="alert alert-success">Product <strong>"'.$product->id.'"</strong> added in your wish list</div>'
        ]);

       
    }
}

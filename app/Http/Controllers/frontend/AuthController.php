<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;




class AuthController extends Controller
{
    public function login()
    {
        $navCategories = Category::with('subcategories')->where('status', 1)->take(5)->get();
        $data['navCategories'] = $navCategories;


        return view('frontend.account.login', $data);
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    // Send reset link email
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    // Show reset form
    public function showResetForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    // Reset password
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

    public function register()
    {
        $navCategories = Category::with('subcategories')->where('status', 1)->take(5)->get();
        $data['navCategories'] = $navCategories;
        return view('frontend.account.register', $data);
    }



    public function processRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|min:10', // Add validation for phone
            'password' => 'required|min:5|confirmed', // Ensure password confirmation
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ]);
        }

        // Create user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone; // Save phone number
        $user->password = bcrypt($request->password); // Encrypt password
        $user->save();

        session()->flash('success', 'you have been registerd successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Registration successful!',
        ]);
    }



    public function authenticate(Request $request)
    {
        // Validate form inputs
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ]);
        }

        // Attempt to authenticate the user
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Check if there's an intended URL to redirect to
            $redirectUrl = session()->pull('url.intended', route('account.profile')); // Default to profile page if no intended URL
            
            // Authentication passed, respond with success status and redirect URL
            return response()->json([
                'status' => true,
                'redirect_url' => $redirectUrl,
            ]);
        }

        // Authentication failed, respond with error message
        return response()->json([
            'status' => false,
            'message' => ['email' => ['The provided credentials do not match our records.']],
        ]);
    }


    public function profile()
    {
        $navCategories = Category::with('subcategories')->where('status', 1)->take(5)->get();
        
        $user = User::where('id', Auth::user()->id)->first();
        $customerAddress = CustomerAddress::where('user_id', Auth::id())->first();
        
        
        $data['navCategories'] = $navCategories;
        $data['user'] = $user;
        $data['customerAddress'] = $customerAddress
        ;
        return view('frontend.account.profile', $data);
    }

    public function updateProfile(Request $request){

        $userId = Auth::user()->id;
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$userId.',id',
            'phone' => 'required',
        ]);

        if($validator->passes()){
            $user  = User::find($userId);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();

            session()->flash('success' , 'your personal information has been updated');

            return response()->json([
                'status' => true,
                'message'=> 'your personal information has been updated'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'errors'=> $validator->errors()
            ]);
        }
    }

    public function updateAddress(Request $request){
        $userId = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'first_name' => 'required | min:3',
            'last_name' => 'required | min:3',
            'email' => 'required|email|unique:users,email,'.$userId.',id',
            'country' => 'required',
            'address' => 'required | min:30',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'mobile' => 'required',
        ]);

        if($validator->passes()){
        $userId = Auth::user()->id;
           
            CustomerAddress::updateOrCreate(
                [
                    'user_id' => $userId,
                ],
                [
                    'user_id' => $userId,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'country' => $request->country,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                    'mobile' => $request->mobile,
                    'apartment' => $request->apartment,
                ]
            );

            session()->flash('success' , 'your Address Information has been updated');

            return response()->json([
                'status' => true,
                'message'=> 'your personal information has been updated'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'errors'=> $validator->errors()
            ]);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function orders(){
        $navCategories = Category::with('subcategories')->where('status', 1)->take(5)->get();

        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();


        $data['navCategories'] = $navCategories;
        $data['orders'] = $orders;
        return view('frontend.account.order', $data);
    }

    public function orderDetail($id){

        $navCategories = Category::with('subcategories')->where('status', 1)->take(5)->get();

        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->where('id', $id)->first();
        $orderItems = OrderItem::where('order_id', $id)->with('product')->get();


        $data['navCategories'] = $navCategories;
        $data['order'] = $order;
        $data['orderItems'] = $orderItems;
        return view('frontend.account.orderdetail', $data);
    }

    public function  wishlist(){
        $navCategories = Category::with('subcategories')->where('status', 1)->take(5)->get();
        
        $wishlists =  Wishlist::where('user_id', Auth::user()->id)->with('product')->get();


        $data['navCategories'] = $navCategories;
        $data['wishlists'] = $wishlists;
        return view('frontend.account.wishlist', $data);
    }

    public function removeProductWishList($id){
        // Find the wishlist item by ID and delete it
    $wishlist = Wishlist::find($id);

    if ($wishlist) {
        $wishlist->delete();
        return redirect()->back()->with('success', 'Item removed from wishlist.');
    } else {
        return redirect()->back()->with('error', 'Item not found.');
    }
    }
}

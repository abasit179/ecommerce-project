<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmation;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CustomerAddress;
use App\Models\UserNotification;
use App\Models\AdminNotification;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingCompany;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;
use Illuminate\Support\Facades\Validator;



class cartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);

        if ($product == null) {
            return response([
                'status' => false,
                'message' => 'Product not found'
            ]);
        }

        // Fetch the first image from the images field
        $images = json_decode($product->images, true); // Decode JSON to array
        $firstImage = !empty($images) ? $images[0] : 'uploads/products/default.jpg'; // Set default image if none exists

        if (Cart::count() > 0) {

            $cartContent = Cart::content();
            $productAlreadyExist = false;

            foreach ($cartContent as $item) {
                if ($item->id == $product->id) {
                    $productAlreadyExist = true;
                }
            }

            if ($productAlreadyExist == false) {
                Cart::add($product->id, $product->name, 1, $product->price_new, ['productImage' => $firstImage]);
                $status = true;
                $message = $product->name . ' added in cart';
            } else {
                $status = false;
                $message = $product->name . ' already added in cart';
            }
        } else {
            Cart::add($product->id, $product->name, 1, $product->price_new, ['productImage' => $firstImage]);
            $status = true;
            $message = $product->name . ' added in cart';
        }

        return response([
            'status' => $status,
            'message' => $message
        ]);
    }

    public function cart()
    {
        $navCategories = Category::with('subcategories')->where('status', 1)->take(5)->get();
        $cartContent = Cart::content();


        $data['navCategories'] = $navCategories;
        $data['cartContent'] = $cartContent;

        // dd($cartContent);
        return view('frontend.cart', $data);
    }

    public function updateCart(Request $request)
    {
        // Validate the request data
        $request->validate([
            'rowId' => 'required|string',
            'qty' => 'required|integer|min:1',
        ]);

        $rowId = $request->rowId;
        $qty = $request->qty;

        // Get the cart item
        $itemInfo = Cart::get($rowId);
        if (!$itemInfo) {
            return response()->json([
                'status' => false,
                'message' => 'Cart item not found'
            ]);
        }

        // Get the product
        $product = Product::find($itemInfo->id);
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ]);
        }

        // Check stock quantity
        if ($qty <= $product->stock_quantity) {
            Cart::update($rowId, $qty);
            $message = 'Cart updated successfully';
            $status = true;
            session()->flash('success', $message);
        } else {
            $message = 'Requested qty(' . $qty . ') not available in stock.';
            $status = false;
            session()->flash('error', $message);
        }

        // Return JSON Response
        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }

    public function removeFromCart(Request $request)
    {
        $rowId = $request->rowId;
        Cart::remove($rowId);

        $message = "Item removed from cart successfully";
        session()->flash('success', $message);

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }


    public function checkout()
    {
        $navCategories = Category::with('subcategories')->where('status', 1)->take(5)->get();

        // if there is no item in the cart return to cart page
        if (Cart::count() == 0) {
            session()->flash('error', 'The cart is empty');
            return redirect()->route('frontend.cart');
        }
        // if user not login go to login page
        if (Auth::check() == false) {

            if (!session()->has('url.intended')) {
                session(['url.intended' => url()->current()]);
            }
            return redirect()->route('login');
        }

        $customerAddress = CustomerAddress::where('user_id', Auth::id())->first();
        $shippingMethods = ShippingCompany::all();

        session()->forget('url.intended');

        $data['navCategories'] = $navCategories;
        $data['customerAddress'] = $customerAddress;
        $data['shippingMethods'] = $shippingMethods;

        return view('frontend.checkout', $data);
    }

    public function processCheckout(Request $request)
{
    // 1-step Apply Validation
    $validator = Validator::make($request->all(), [
        'first_name' => 'required|min:3',
        'last_name' => 'required|min:3',
        'email' => 'required|email',
        'country' => 'required',
        'address' => 'required|min:30',
        'city' => 'required',
        'state' => 'required',
        'zip' => 'required',
        'mobile' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Please fix the errors',
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }

    // Save data in the customer addresses table 
    $user = Auth::user();
    CustomerAddress::updateOrCreate(
        [
            'user_id' => $user->id
        ],
        [
            'user_id' => $user->id,
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

    // Save data in the orders table 
    if ($request->payment_method == 'cod') {
        $shipping = 0;
        $discount = 0;
        $subTotal = Cart::subtotal(2, '.', '');
        $grandTotal = $subTotal + $shipping;

        $order = new Order;
        $order->subtotal = $subTotal;
        $order->shipping = $shipping;
        $order->grand_total = $grandTotal;
        $order->payment_status = 'not paid';
        $order->status = 'pending';
        $order->user_id = $user->id;
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->email = $request->email;
        $order->address = $request->address;
        $order->country = $request->country;
        $order->city = $request->city;
        $order->state = $request->state;
        $order->zip = $request->zip;
        $order->mobile = $request->mobile;
        $order->apartment = $request->apartment;
        $order->notes = $request->order_notes;
        $order->save();

        // Save data in the order items table 
        foreach (Cart::content() as $item) {
            $orderItem = new OrderItem;

            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->id;
            $orderItem->name = $item->name;
            $orderItem->qty = $item->qty;
            $orderItem->price = $item->price;
            $orderItem->total = $item->price * $item->qty;

            $orderItem->save();

            // Update stock 
            $productData = Product::find($item->id);
            $currentQty = $productData->stock_quantity;
            $updatedQty = $currentQty - $item->qty;

            $productData->stock_quantity = $updatedQty;
            $productData->save();
        }

        // Send user notification
        UserNotification::create([
            'user_id' => $user->id,
            'title' => 'Order Placed',
            'message' => 'Your order has been placed successfully. Order ID: ' . $order->id,
        ]);

        // Send admin notification
        AdminNotification::create([
            'title' => 'New Order',
            'message' => 'A new order has been placed by ' . $request->first_name . ' ' . $request->last_name . '. Order ID: ' . $order->id,
        ]);

        // Send email notification to the user
        $emailData = [
            'subject' => 'Order Confirmation',
            'greeting' => 'Thank you for your order!',
            'message' => 'Your order has been placed successfully. Your order ID is: ' . $order->id,
        ];

        Mail::to($user->email)->send(new NotificationMail($emailData));

        session()->flash('success', 'You have successfully placed your order');

        Cart::destroy();
        return response()->json([
            'message' => 'Order saved successfully',
            'orderId' => $order->id,
            'status' => true
        ]);
    } else {
        // Handle other payment methods if needed
    }
}



    public function thankyou($id)
    {
        $navCategories = Category::with('subcategories')->where('status', 1)->take(5)->get();

        $data['navCategories'] = $navCategories;
        $data['id'] = $id;
        return view('frontend.thanks', $data);
    }
}

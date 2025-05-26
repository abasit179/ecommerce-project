<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\UserNotification;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get();


        $data['orders'] = $orders;
        return view('admin.Orders.list', $data);
    }
    public function detail($id)
    {

        $order = Order::where('id', $id)->first();
        $orderItems = OrderItem::where('order_id', $id)->with('product')->get();
        // Calculate the total quantity of all items in the order
        $totalQuantity = $orderItems->sum('qty');

        $data['order'] = $order;
        $data['orderItems'] = $orderItems;
        $data['totalQuantity'] = $totalQuantity;
        return view('admin.Orders.detail', $data);
    }

    public function update(Request $request, $id)
    {
        // Validate the request (optional)
        $request->validate([
            'status' => 'required|in:pending,shipped,delivered',
            'payment_status' => 'required|in:not paid,paid',
        ]);

        // Find the order by ID
        $order = Order::findOrFail($id);

        // Update the order status
        $order->status = $request->status;

        // If status is 'delivered', automatically set payment_status to 'paid'
        if ($request->status === 'delivered') {
            $order->payment_status = 'paid';
            $emailData = [
                'subject' => 'Order Delivery Confirmation',
                'greeting' => 'Order no. '. $order->id. ' has been delivered',
                'message' => 'Your order has been delivered successfully on '.now().'.',
            ];

            Mail::to($order->user->email)->send(new NotificationMail($emailData));
        } else {
            // Update payment status from request if not delivered
            $order->payment_status = $request->payment_status ?? 'not paid';
        }

        // Save the order with the updated status and payment status
        $order->save();
        // Send user notification
        UserNotification::create([
            'user_id' => $order->user->id,
            'title' => 'Order ' . $order->status,
            'message' => 'Your order # ' . $order->id .' is '.$order->status.'. ',
        ]);
        // Redirect back with a success message
        return redirect()->route('orders.detail',$id)->with('success', 'Order status updated successfully.');
    }
}

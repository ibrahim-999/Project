<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        if($request->isMethod('post')) {
            $orderData = $request->input();
            $order = new Order();
            $order->user_id = $orderData['user_id'];
            $order->ticket_id = $orderData['ticket_id'];
            $order->qty = $orderData['qty'];
            $order->order_number = $orderData['order_number'];
            $order->total = $orderData['total'];
            $order->admin_status = $orderData['admin_status'];
            $order->payment_method = $orderData['payment_method'];
            $order->save();
            return response()->json(['message'=>'User Added Successfully!']);

        }
    }
}

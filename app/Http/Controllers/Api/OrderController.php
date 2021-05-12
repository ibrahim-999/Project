<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Validator;
class OrderController extends Controller
{
    public function allOrders()
    {
        $order=Order::get();
        return response()->json(['order'=>$order],200);
    }

    public function indexOrder($id)
    {
        $order=Order::findOrFail($id);

        return response()->json(['order'=>$order],200);
    }

    public function createOrder(Request $request)
    {
        $order = new Order();
        $orderData = $request->input();

        $rules = [
            "qty" => "required|numeric",
            "order_number"  => "required|unique:orders",
            "admin_status" => "required",
            "payment_method" => "required",

        ];

        $customMessage = [
            "qty.required" =>"Quantity is required" ,
            "order_number.required" => "Order Number is required",
            "order_number.unique"=> "Order Number must be unique",
            "admin_status.required"=>" Admin Status is required",
            "payment_method.required" => "Payment Method is required",

        ];

        $validator = Validator::make($orderData,$rules,$customMessage);

        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }


        if($request->isMethod('post')) {
            $order->user_id = $orderData['user_id'];
            $order->ticket_id = $orderData['ticket_id'];
            $order->qty = $orderData['qty'];
            $order->order_number = $orderData['order_number'];
            $order->total = $orderData['total'];
            $order->admin_status = $orderData['admin_status'];
            $order->payment_method = $orderData['payment_method'];
            $order->save();
            return response()->json(['message'=>'Order has been Added Successfully!']);

        }
    }
}

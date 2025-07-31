<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use Session;

class OrdersController extends Controller
{
    public function getOrdersByType($type){
        // return response()->json($type === "pending");
        // if($type == 'all'){
        //     $orders = Order::where('sale_mode', Session::get('sale_mode'))->get();
        // }else if($type == 'pending'){
        //     $orders = Order::where('sale_mode', Session::get('sale_mode'))->where('status', 'pending')->get();
        // }
        // else if($type == 'shipped'){
        //     $orders = Order::where('sale_mode', Session::get('sale_mode'))->where('status', 'shipped')->get();
        // }else if($type == 'cancelled'){
        //     $orders = Order::where('sale_mode', Session::get('sale_mode'))->where('status', 'canceled')->get();
        // }else if($type == 'completed'){
        //     $orders = Order::where('sale_mode', Session::get('sale_mode'))->where('status', 'completed')->get();
        // }else{
        //     $orders = Order::all();
        // }

        if ($type == 'all') {
            $orders = Order::orderBy('created_at', 'desc')->get();
        } else if ($type === 'pending') {
            $orders = Order::where('status', 'pending')->orderBy('created_at', 'desc')->get();
        } else if ($type === 'shipped') {
            $orders = Order::where('status', 'shipped')->orderBy('created_at', 'desc')->get();
        } else if ($type === 'cancelled') {
            $orders = Order::where('status', 'canceled')->orderBy('created_at', 'desc')->get();
        } else if ($type === 'completed') {
            $orders = Order::where('status', 'completed')->orderBy('created_at', 'desc')->get();
        } else {
            $orders = Order::orderBy('created_at', 'desc')->get();
        }

        // return response()->json($orders);
        return view('Admin.Orders.orders_list',['orders'=> $orders, 'type'=> $type]);
    }

    public function orderDetails($id){
        $order = Order::find($id);

        $order_cart = json_decode($order->cart);
        $order_shipping_address = json_decode($order->shipping_details);
        // return response()->json(json_decode($order));

        
        return view('Admin.Orders.order_details',['order' => $order, 'order_cart'=> $order_cart, 'address'=> $order_shipping_address]);
    }

    public function updateOrderStatus($id, Request $request){
        // return response()->json([$id, $request->all()]);
        Order::find($id)->update(['status'=> $request->order_status]);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        try {
            $order->delete();
            return redirect()->back()->with('msg', 'Order deleted successfully.');
        } catch (\Exception $e) {
            \Log::error("Order deletion failed: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete order.');
        }
    }
}

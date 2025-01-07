<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::all();
        return view("admin.orders",compact("order"));
    }
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|in:received,processing,pending,reject',
        ]);
        $order->order_status = $request->order_status;
        $order->save();
        return redirect()->route('view.orders')->with('success', 'Order status updated successfully.');
    }
    
} 
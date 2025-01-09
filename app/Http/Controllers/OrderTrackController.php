<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderTrackController extends Controller
{
    public function index(Request $request)
    {
        
        $orderStatus = null;
        $order = Order::all();
        if ($request->has('order_number')) {
            $validated = $request->validate([
                'order_number' => 'required|string|',
            ]);

            $order = Order::where('order_number', $validated['order_number'])->first();
            $orderStatus = $order ? $order->order_status : null;
        }

        return view('admin.order-track', compact('orderStatus','order'));
    }
}

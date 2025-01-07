<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        return view('user.chekout', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'firstname' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'payment' => 'required|string|in:visa,paypal,cod',
        ]);
        $cartItems = CartItem::where('user_id', $user->id)->get();
        $totalAmount = 0;
        foreach ($cartItems as $cartItem) {
            $productPrice = $cartItem->product->price;
            $productQuantity = $cartItem->quantity;
            $payableAmount = $productPrice * $productQuantity;
            $totalAmount += $payableAmount;
            Order::create([
                'user_id' => $user->id,
                'product_id' => $cartItem->product->id,
                'quantity' => $cartItem->quantity,
                'payment_status' => $request->payment, 
                'firstname' => $request->firstname, 
                'email' => $request->email, 
                'address' => $request->address, 
                'city' => $request->city, 
                'state' => $request->state, 
                'zip' => $request->zip, 
                'payable_amount' => $payableAmount 
            ]);
        }

        CartItem::where('user_id', $user->id)->delete();
        
        return redirect()->route('view.cart')->with('message', 'Order placed successfully!');
    }
}

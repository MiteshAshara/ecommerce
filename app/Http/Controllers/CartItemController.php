<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartItemController extends Controller
{
    public function viewcart()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();

        return view("user.cart", compact('cartItems'));
    }

    public function addcart(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login')->with('error', 'You must be logged in to add items to the cart');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        if ($request->quantity > $product->stock) {
            return redirect()->back()->with('error', 'Not enough stock available');
        }

        DB::beginTransaction();

        try {
            $cartItem = CartItem::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->first();

            if ($cartItem) {
                $cartItem->quantity += $request->quantity;
                $cartItem->save();
            } else {
                CartItem::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                ]);
            }

            $product->stock -= $request->quantity;
            $product->save();

            DB::commit();

            return redirect()->back()->with('success', 'Product added to cart');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to add product to cart. Please try again');
        }
    }
    public function remove(CartItem $cartItem)
    {

        if ($cartItem->user_id === Auth::id()) {
            $product = $cartItem->product;
            $product->stock += $cartItem->quantity;
            $product->save();
            $cartItem->delete();

            return redirect()->route('view.cart')->with('success', 'Item removed from cart and stock updated');
        }

        return redirect()->route('view.cart')->with('error', 'You cannot remove an item from another user\'s cart');
    }
}

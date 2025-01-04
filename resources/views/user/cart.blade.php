@extends('admin.includes.master')

@section('admin.content')
<main class="main">
    <div class="container">
        <h1>Your Cart</h1>

        @if($cartItems->isEmpty())
        <p>Your cart is empty!</p>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $subTotal = null;
                @endphp

                @foreach($cartItems as $cartItem)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $cartItem->product->image) }}" alt="Product Image" width="50">
                        {{ $cartItem->product->name }}
                    </td>
                    <td>{{ $cartItem->quantity }}</td>
                    <td>₹{{ number_format($cartItem->product->price, 2) }}</td>
                    <td>₹{{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-dark btn-sm">Remove</button>
                        </form>
                    </td>
                </tr>

                @php
                $subTotal += $cartItem->product->price * $cartItem->quantity;
                @endphp
                @endforeach
                <tr>
                    <td colspan="4" class="text-right"><strong>Sub Total:</strong></td>
                    <td><strong>₹{{ number_format($subTotal, 2) }}</strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        @endif
    </div>
</main>
@endsection
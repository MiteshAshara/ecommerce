@extends('admin.includes.master')

@section('admin.content')
<main class="main">
    <div class="container mt-3 text-center">
        <h1 class="my-4 text-center">Cart</h1>
        @if($cartItems->isEmpty())
        <p style="font-weight:bold;">Your cart is empty!</p>
        @else
        <table class="table text-center mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $subTotal = 0;
                @endphp

                @foreach($cartItems as $cartItem)
                <tr data-cart-id="{{ $cartItem->id }}">
                    <td>{{ $loop->iteration }}</td> 
                    <td>{{ $cartItem->product->name }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $cartItem->product->image) }}" alt="Product Image" width="50">
                    </td>
                    <td>
                        <form action="{{ route('cart.update', $cartItem->id) }}" method="POST"  class="update-cart-form">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="product_id" value="{{ $cartItem->product->id }}">
                            <div class="_p-add-cart">
                                <div class="_p-qty">
                                    <div class="value-button decrease_" data-cart-id="{{ $cartItem->id }}" value="Decrease Value">-</div>
                                    <input class="quantity-input text-center" type="number" name="quantity" id="quantity-{{ $cartItem->id }}" value="{{ $cartItem->quantity }}" min="1" max="{{ $cartItem->product->stock }}" required>
                                    <div class="value-button increase_" data-cart-id="{{ $cartItem->id }}" value="Increase Value">+</div>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td>₹{{ number_format($cartItem->product->price, 2) }}</td>
                    <td class="total-price">₹{{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}</td>
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
                    <td colspan="5" class="text-right"><strong>Sub Total:</strong></td>
                    <td><strong>₹{{ number_format($subTotal, 2) }}</strong></td>
                </tr>

                <tr>
                    <td colspan="5" class="text-right"><strong>Total Payment:</strong></td>
                    <td><strong>₹{{ number_format($subTotal, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>        
        @endif
    </div>
</main>
@endsection

<style>
    ._p-add-cart {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    ._p-qty {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .value-button {
        border: 2px solid #ccc;
        background-color: gray;
        color: #ddd;
        border-radius: 50px;
        padding: 8px;
        cursor: pointer;
        font-size: 18px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .quantity-input {
        width: 60px;
        text-align: center;
        margin: 0 10px;
        padding: 5px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const decreaseBtns = document.querySelectorAll('.decrease_');
        const increaseBtns = document.querySelectorAll('.increase_');

        decreaseBtns.forEach(button => {
            button.addEventListener('click', function() {
                const cartId = this.getAttribute('data-cart-id');
                const inputField = document.getElementById('quantity-' + cartId);
                let currentValue = parseInt(inputField.value);
                if (currentValue > 1) {
                    inputField.value = currentValue - 1;
                    updateCart(cartId, inputField.value);
                }
            });
        });

        increaseBtns.forEach(button => {
            button.addEventListener('click', function() {
                const cartId = this.getAttribute('data-cart-id');
                const inputField = document.getElementById('quantity-' + cartId);
                let currentValue = parseInt(inputField.value);
                const maxQuantity = parseInt(inputField.getAttribute('max'));
                if (currentValue < maxQuantity) {
                    inputField.value = currentValue + 1;
                    updateCart(cartId, inputField.value);
                }
            });
        });
    });

    function updateCart(cartId, quantity) {
        const form = document.querySelector(`form[data-cart-id="${cartId}"]`);
        const inputField = document.getElementById('quantity-' + cartId);
        inputField.value = quantity;
        form.submit();
    }
</script>

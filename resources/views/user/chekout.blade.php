@extends('admin.includes.master')

@section('admin.content')
<main class="main">
    <div class="row">
        <div class="col-75">
            <h3 class="text-center mt-3">Checkout Billing</h3>
            <div class="container">
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-50">
                            <label for="fname">Full Name</label>
                            <input type="text" id="fname" name="firstname" placeholder="John M. Doe" required>
                            <label for="email"> Email</label>
                            <input type="text" id="email" name="email" placeholder="john@example.com" required>
                            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street" required>
                            <label for="city"><i class="fa fa-institution"></i> City</label>
                            <input type="text" id="city" name="city" placeholder="New York" required>

                            <div class="row">
                                <div class="col-50">
                                    <label for="state">State</label>
                                    <input type="text" id="state" name="state" placeholder="India" required>
                                </div>
                                <div class="col-30">
                                    <label for="zip">Zip</label>
                                    <input type="text" id="zip" name="zip" placeholder="360003" required>
                                </div>
                                <div class="col-20">
                                    <label for="payment">Payment Method</label>
                                    <div class="payment-options">
                                        <label><input type="radio" name="payment" value="visa" checked>Visa Card</label>
                                        <label><input type="radio" name="payment" value="paypal">Paypal</label>
                                        <label><input type="radio" name="payment" value="cod">Cash on Delivery</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-50">
                            <h5 class="text-center mt-5" style="font-weight: bold;">You're Checkout Cart</h5>
                            <div class="container">

                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Image</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $subTotal = 0;
                                        @endphp
                                        @foreach($cartItems as $cartItem)
                                        <tr data-cart-id="{{ $cartItem->id }}">
                                            <td>{{ $cartItem->product->name }}</td>
                                            <td><img src="{{ asset('storage/' . $cartItem->product->image) }}" alt="Product Image" width="50"></td>
                                            <td>{{ $cartItem->quantity }}</td>
                                            <td>₹{{ number_format($cartItem->product->price, 2) }}</td>
                                        </tr>
                                        @php
                                        $subTotal += $cartItem->product->price * $cartItem->quantity;
                                        @endphp
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="total">
                                    <p><strong>Payable Amount:</strong> ₹{{ number_format($subTotal, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dark">Make Order</button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
<style>
    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -16px;
        justify-content: space-between;
    }

    .col-25,
    .col-50,
    .col-75 {
        padding: 0 16px;
    }

    .col-50 {
        flex: 48%;
    }

    .col-75 {
        flex: 72%;
    }

    h3 {
        font-size: 24px;
        color: #333;
        font-weight: 600;
        margin-bottom: 20px;
    }

    label {
        margin-bottom: 8px;
        font-size: 14px;
        color: #555;
    }

    input[type=text],
    input[type=radio] {
        width: 100%;
        margin-bottom: 15px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    input[type=radio] {
        width: auto;
        margin-right: 8px;
    }

    .payment-options label {
        display: inline-block;
        margin-right: 15px;
    }

    .btn {
        padding: 12px;
        margin: 20px 0;
        border: none;
        width: 100%;
        border-radius: 3px;
        cursor: pointer;
        font-size: 17px;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #045d39;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    .total {
        margin-top: 20px;
        font-size: 18px;
        font-weight: bold;
        color: #333;
    }

    @media (max-width: 800px) {
        .row {
            flex-direction: column;
            align-items: center;
        }

        .col-50,
        .col-75 {
            flex: 100%;
            padding: 0 10px;
        }

        .container {
            padding: 15px;
        }

        h3 {
            font-size: 20px;
        }

        table th,
        table td {
            font-size: 12px;
        }
    }
</style>
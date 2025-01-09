@extends('admin.includes.master')

@section('admin.content')
<main class="main">
    <div class="col-md-10 mx-auto">
        <h3 class="text-center mt-4">Checkout Billing</h3>
        <div class="container">
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-group">
                            <label for="fname">Full Name</label>
                            <input type="text" id="fname" name="firstname" class="form-control" placeholder="John M. Doe" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="adr">Address</label>
                            <input type="text" id="adr" name="address" class="form-control" placeholder="542 W. 15th Street" required>
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" class="form-control" placeholder="New York" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" id="state" name="state" class="form-control" placeholder="California" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="zip">Zip Code</label>
                                    <input type="text" id="zip" name="zip" class="form-control" placeholder="902105" required>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-3">Payment Method</h5>
                        <div class="form-check" >
                            <input type="radio" id="visa" name="payment" value="visa" class="form-check-input" checked>
                            <label for="visa" class="form-check-label">Visa Card</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="paypal" name="payment" value="paypal" class="form-check-input">
                            <label for="paypal"  class="form-check-label">PayPal</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="cod" name="payment" value="cod" class="form-check-input">
                            <label for="cod"  class="form-check-label">Cash on Delivery</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="text-secondary text-center mt-5 font-weight-bold">Checkout Cart</h5>
                        <div class="container">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Product</th>
                                        <th>Image</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $subTotal = 0; @endphp
                                    @foreach($cartItems as $cartItem)
                                        <tr data-cart-id="{{ $cartItem->id }}">
                                            <td>{{ $cartItem->product->name }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $cartItem->product->image) }}" 
                                                     alt="{{ $cartItem->product->name }}" class="img-fluid" width="50">
                                            </td>
                                            <td>{{ $cartItem->quantity }}</td>
                                            <td>₹{{ number_format($cartItem->product->price, 2) }}</td>
                                        </tr>
                                        @php $subTotal += $cartItem->product->price * $cartItem->quantity; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-right">
                                <strong>Total Payable: ₹{{ number_format($subTotal, 2) }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-dark mt-4 btn-lg" style="margin-bottom: 50px;">Make Order</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

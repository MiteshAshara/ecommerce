@extends('admin.includes.master')

@section('admin.content')
<main class="main">
    <div class="container">
        <h1 class="my-4 text-center">Track Your Order</h1>

        <form action="{{ route('order.track') }}" method="GET">
            <div class="form-group">
                <label for="order_number">Enter Your Order Number:</label>
                <input type="text" name="order_number" id="order_number" class="form-control"
                    value="{{ old('order_number') }}" placeholder="12345678" maxlength="8" required>
            </div>
            <button type="submit" class="btn btn-dark">Track Order</button>
        </form>

        @if(isset($orderStatus))
            @if($orderStatus)
                <div class="mt-4 alert alert-dark">
                    <strong>Order Status:</strong> {{ ucfirst($orderStatus) }}
                </div>
            @endif
        @elseif(request()->has('order_number'))
            <div class="mt-4 alert alert-dark">
                <strong>You have no orders available</strong>
            </div>
        @endif
    </div>
</main>
@endsection

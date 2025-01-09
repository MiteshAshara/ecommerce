@extends('admin.includes.master')

@section('admin.content')
<main class="main">
    <div class="container">
        <h1 class="my-4 text-center">Orders</h1>
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">City</th>
                    <th scope="col">State</th>
                    <th scope="col">Zipcode</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Payment Via</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Order Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order as $orders)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $orders->firstname }}</td>
                    <td>{{ $orders->email }}</td>
                    <td>{{ $orders->address }}</td>
                    <td>{{ $orders->city }}</td>
                    <td>{{ $orders->state }}</td>
                    <td>{{ $orders->zip }}</td>
                    <td>{{ $orders->quantity }}</td>
                    <td>{{ $orders->payment_status }}</td>
                    <td style="font-weight: bold;">₹{{ number_format($orders->payable_amount, 2)}}</td>
                    <td>
                        @if($orders->product && $orders->product->image)
                        <img src="{{ asset('storage/' . $orders->product->image) }}" alt="{{ $orders->product->name }}" width="80" height="auto">
                        @else
                        <span>No Image</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('orders.updateStatus', $orders->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select class="form-select" name="order_status" onchange="this.form.submit()">
                                <option value="received" {{ old('order_status', $orders->order_status) === 'received' ? 'selected' : '' }}>Received</option>
                                <option value="processing" {{ old('order_status', $orders->order_status) === 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ old('order_status', $orders->order_status) === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="dispatch" {{ old('order_status', $orders->order_status) === 'dispatch' ? 'selected' : '' }}>Dispatch</option>
                                <option value="delivered" {{ old('order_status', $orders->order_status) === 'delivered' ? 'selected' : '' }}>Delivered</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</main>
@endsection
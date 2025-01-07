@extends('admin.includes.master')

@section('admin.content')
<main class="main">

<div class="container">
        <h1 class="my-4 text-center">Orders</h1>
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">firstname</th>
                    <th scope="col">email</th>
                    <th scope="col">address</th>
                    <th scope="col">city</th>
                    <th scope="col">state</th>
                    <th scope="col">zip</th>
                    <th scope="col">quantity</th>
                    <th scope="col">payment_status</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Product Image</th>
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
                    <td style="font-weight: bold;">{{ $orders->payable_amount }}</td>
                    <td>
                        @if($orders->product && $orders->product->image)
                            <img src="{{ asset('storage/' . $orders->product->image) }}" alt="{{ $orders->product->name }}" width="80" height="auto">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</main>
@endsection

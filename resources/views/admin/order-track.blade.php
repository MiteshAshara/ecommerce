@extends('admin.includes.master')

@section('admin.content')
<main class="main">
    <div class="container"  style="overflow:hidden">
        <h1 class="my-4 text-center">Track Your Order</h1>

        <div class="row">
            <div class="col-12">
                <form action="{{ route('order.track') }}" method="GET">
                    <div class="form-group">
                        <label for="order_number">Enter Your Order Number:</label>
                        <input type="text" name="order_number" id="order_number" class="form-control"
                            value="{{ old('order_number') }}" placeholder="#ordABC1234" required>
                    </div>
                    <button type="submit" class="btn btn-dark">Track Order</button>
                </form>
            </div>
        </div>

    </div>
    @if(request()->has('order_number'))
    <div class="row mt-4">
        <div class="col-12">
            @if(isset($orderStatus))
            <div class="col-12 col-md-10 hh-grayBox pt45 pb20">
                <div class="row justify-content-between">
                    <div class="order-tracking {{ in_array($orderStatus, ['received', 'processing', 'shipped', 'dispatch', 'delivered']) ? 'completed' : '' }}">
                        <span class="is-complete"></span>
                        <p>Received<br></p>
                    </div>
                    <div class="order-tracking {{ in_array($orderStatus, ['processing', 'shipped', 'dispatch', 'delivered']) ? 'completed' : '' }}">
                        <span class="is-complete"></span>
                        <p>Processing<br></p>
                    </div>
                    <div class="order-tracking {{ in_array($orderStatus, ['shipped', 'dispatch', 'delivered']) ? 'completed' : '' }}">
                        <span class="is-complete"></span>
                        <p>Shipped<br></p>
                    </div>
                    <div class="order-tracking {{ in_array($orderStatus, ['dispatch', 'delivered']) ? 'completed' : '' }}">
                        <span class="is-complete"></span>
                        <p>Dispatch<br></p>
                    </div>
                    <div class="order-tracking {{ $orderStatus === 'delivered' ? 'completed' : '' }}">
                        <span class="is-complete"></span>
                        <p>Delivered<br></p>
                    </div>
                </div>
            </div>
            @else
            <div class="conatainer">
                <div class=" text-center">
                    <strong>No Order Details Found</strong>
                </div>
                @endif
            </div>
        </div>
        @endif

        <style>
            .pt45 {
                padding-top: 45px;
                margin-left: 120px;
            }

            .order-tracking {
                text-align: center;
                width: 20%;
                position: relative;
                display: block;
            }

            .order-tracking .is-complete {
                display: block;
                position: relative;
                border-radius: 50%;
                height: 30px;
                width: 30px;
                border: 2px solid #AFAFAF;
                background-color: gray;
                margin: 0 auto;
                transition: background 0.25s linear;
                -webkit-transition: background 0.25s linear;
                z-index: 2;
            }

            .order-tracking.completed .is-complete {
                border-color: #27aa80;
                border-width: 2px;
                background-color: #27aa80;
            }

            .order-tracking.completed .is-complete:after {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) rotate(45deg);
                width: 8px;
                height: 15px;
                border: solid #fff;
                border-width: 0 3px 3px 0;
            }

            .order-tracking p {
                color: #A4A4A4;
                font-size: 16px;
                margin-top: 8px;
                margin-bottom: 0;
                line-height: 20px;
            }

            .order-tracking p span {
                font-size: 14px;
            }

            .order-tracking.completed p {
                color: #000;
            }

            .order-tracking::before {
                content: '';
                display: block;
                height: 3px;
                width: calc(100% - 40px);
                background-color: gray;
                top: 13px;
                position: absolute;
                left: calc(-50% + 20px);
                z-index: 0;
            }

            .order-tracking.completed::before {
                background-color: #27aa80;
            }

            .order-tracking:first-child:before {
                display: none;
            }
        </style>
</main>
@endsection
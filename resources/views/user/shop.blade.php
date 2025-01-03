@extends('user.includes.master')
@section('content')
<main class="main">
	<!-- Start Hero Section -->
	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1>Shop</span></h1>
						<p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>
						<p><a href="{{URL::to('shop')}}" class="btn btn-secondary me-2">Shop Now</a></p>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="hero-img-wrap">
						<img src="frontend/images/couch.png" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="untree_co-section product-section before-footer-section">
		<div class="container">
			<div class="container">
				<div class="row">
					@foreach($products as $product)
					<div class="col-12 col-md-4 col-lg-3 mb-5">
						<a class="product-item" href="{{URL::to('add-cart')}}">
							<img src="{{ asset('storage/' . $product->image) }}" class="img-fluid product-thumbnail" alt="image not found">
							<h3 class="product-title">{{ $product->name }}</h3>
							<strong class="product-price">₹{{ number_format($product->price, 2) }}</strong>
							<span class="icon-cross">
								<img src="{{ asset('frontend/images/cross.svg') }}" class="img-fluid" alt="remove">
							</span>
						</a>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	</div>
</main>
@endsection
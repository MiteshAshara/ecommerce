@extends('user.includes.master')

@section('content')
<main class="main">
	<!-- Start Hero Section -->
	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1>Shop</h1>
						<p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>
						<p><a href="{{ URL::to('shop') }}" class="btn btn-secondary me-2">Shop Now</a></p>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="hero-img-wrap">
						<img src="frontend/images/couch.png" class="img-fluid" alt="Hero Image">
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="untree_co-section product-section before-footer-section">
		<div class="container">
			<div class="row">
				@foreach($products as $product)
				<div class="col-12 col-md-4 col-lg-3 mb-5">
					<div class="product-item">
						<img src="{{ asset('storage/' . $product->image) }}" class="img-fluid product-thumbnail" alt="Product Image">
						<h3 class="product-title">{{ $product->name }}</h3>
						<strong class="product-price">₹{{ number_format($product->price, 2) }}</strong>
						<p class="product-stock">Stock: {{ $product->stock }}</p>
						@if(Auth::check() && Auth::user()->role != 'admin')
						<form action="{{ route('cart.add') }}" method="POST">
							@csrf
							<input type="hidden" name="product_id" value="{{ $product->id }}">
							<div class="_p-add-cart">
								<div class="_p-qty">
									<div class="value-button decrease_" data-product-id="{{ $product->id }}" value="Decrease Value">-</div>
									<input class="quantity-input text-center" type="number" name="quantity" id="quantity-{{ $product->id }}" value="1" min="1" max="{{ $product->stock }}" required>
									<div class="value-button increase_" data-product-id="{{ $product->id }}" value="Increase Value">+</div>
								</div>
							</div>
							<button class="btn btn-dark mt-3" type="submit" @if($product->stock == 0) disabled @endif>
								@if($product->stock == 0) Out of Stock @else Add to Cart @endif
							</button>
						</form>
						@else
						<button class="btn btn-dark mt-3" disabled>
							@if($product->stock == 0) Out of Stock @elseif(Auth::check()) Admin @else Login @endif
						</button>
						@endif
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>

</main>
@endsection

<style>
	.product-item {
		border: 1px solid #ddd;
		border-radius: 8px;
		padding: 45px;
		text-align: center;
		transition: all 0.3s ease;
	}

	.product-item:hover {
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		transform: translateY(-5px);
	}

	.product-thumbnail {
		max-height: 200px;
		object-fit: contain;
		margin-bottom: 10px;
	}

	.product-title {
		font-size: 1.1rem;
		font-weight: 600;
	}

	.product-price {
		font-size: 1.2rem;
		color: #333;
	}

	.product-stock {
		font-size: 0.9rem;
		color: #555;
	}

	.btn-dark {
		width: 100%;
		text-transform: uppercase;
		padding: 10px 0;
		font-weight: 600;
	}

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
				const productId = this.getAttribute('data-product-id');
				const inputField = document.getElementById('quantity-' + productId);
				let currentValue = parseInt(inputField.value);
				if (currentValue > 1) {
					inputField.value = currentValue - 1;
				}
			});
		});

		increaseBtns.forEach(button => {
			button.addEventListener('click', function() {
				const productId = this.getAttribute('data-product-id');
				const inputField = document.getElementById('quantity-' + productId);
				let currentValue = parseInt(inputField.value);
				const maxQuantity = parseInt(inputField.getAttribute('max'));
				if (currentValue < maxQuantity) {
					inputField.value = currentValue + 1;
				}
			});
		});
	});
</script>
@extends('user.includes.master')
@section('content')
<main class="main">

	<!-- Start Hero Section -->
	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1>Blog</h1>
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
	<!-- End Hero Section -->



	<!-- Start Blog Section -->
	<div class="untree_co-section product-section before-footer-section">
		<div class="container">
			<div class="container">
				<div class="row">
					@foreach($blogs as $blog)
					<div class="col-12 col-md-4 col-lg-3 mb-5">
						<a href="#" class="post-thumbnail product-item"><img src="{{ asset('storage/' . $blog->blog_image) }}" alt="Image" class="img-fluid"></a>
							<h3 class="mt-3"><a href="#" style="text-decoration: none;">{{ $blog->blog_title }}</a></h3>
							<span class="fw-bold" style="overflow: hidden;">{{ $blog->blog_description}}</span>
							<div class="meta">
								<span>by <a href="{{URL::to('blog')}}" class="fw-bold text-secondary" style="text-decoration: none;">Admin</a> <span>on <span class="fw-bold">{{ $blog->created_at->format('F,Y') }}</span></span>
							</div>
						</a>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<!-- End Blog Section -->

</main>
@endsection
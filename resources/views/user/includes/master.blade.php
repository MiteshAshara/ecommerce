<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Untree.co">
	<link rel="shortcut icon" href="favicon.png">

	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap4" />

	<!-- Bootstrap CSS -->
	<link href="{{ URL::to('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="{{ URL::to('frontend/css/tiny-slider.css') }}" rel="stylesheet">
	<link href="{{ URL::to('frontend/css/style.css') }}" rel="stylesheet">
	<title>Furni Free Bootstrap 5 Template for Furniture and Interior Design Websites by Untree.co </title>
</head>

<body>

	@include('user.includes.header')

	@yield('content')

	@include('user.includes.footer')

	<!-- JavaScript Files -->
	<script src="{{ URL::to('frontend/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ URL::to('frontend/js/tiny-slider.js') }}"></script>
	<script src="{{ URL::to('frontend/js/custom.js') }}"></script>
</body>

</html>
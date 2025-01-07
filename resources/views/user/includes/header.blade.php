<!-- Start Header/Navigation -->
<nav class="custom-navbar fixed-top navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

    <div class="container">
        <a class="navbar-brand" href="{{URL::to('/')}}">E-com<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item"><a class="nav-link" href="{{ URL::to('/') }}">Home</a></li>
                    <li><a class="nav-link" href="{{ URL::to('shop') }}">Shop</a></li>
                    <li><a class="nav-link" href="{{ URL::to('about') }}">About us</a></li>
                    <li><a class="nav-link" href="{{ URL::to('services') }}">Services</a></li>
                    <li><a class="nav-link" href="{{ URL::to('blog') }}">Blog</a></li>
                    <li><a class="nav-link" href="{{ URL::to('contact-us') }}">Contact us</a></li>
                </ul>

                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li>
                        @if(Auth::check())

                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <img src="frontend/images/user.svg" alt="User">
                            <span class="ms-2">{{ Auth::user()->name }}</span>
                        </a>
                        @else

                        <a class="nav-link" href="{{ route('user.login') }}">
                            <img src="frontend/images/user.svg" alt="User">
                        </a>
                        @endif
                    </li>
                    @if(Auth::check())
                    <li>
                        @if(Auth::user()->is_admin)
                        <a class="nav-link text-light" href="{{ route('admin.dashboard') }}">
                            <img src="frontend/images/cart.svg" alt="Admin Panel">
                            Admin Panel
                        </a>
                        @else
                        <a class="nav-link text-light" href="{{ route('view.cart') }}">
                            
                            @php
                            $cartItemCount = App\Models\CartItem::where('user_id', Auth::id())->sum('quantity');
                            @endphp
                            @if($cartItemCount > 0)
                            <img src="frontend/images/cart.svg" alt="Cart"><sup style="font-size: 18px;">{{ $cartItemCount }}</sup>
                            @endif
                        </a>
                        @endif
                    </li>
                    @else
                    <li>
                        <a class="nav-link text-light" href="{{ route('user.login') }}">
                            <img src="frontend/images/cart.svg" alt="Cart"> 
                        </a>
                    </li>
                    @endif
                </ul>

            </div>

        </div>

</nav>
<!-- End Header/Navigation -->
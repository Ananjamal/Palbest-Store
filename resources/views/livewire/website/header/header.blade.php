<div>
    <header class="header">
        <div class="container">
            <div class="header__content">
                <!-- Logo -->
                <div class="header__logo">
                    <a href="{{ route('/') }}"><img src="{{ asset('assets/website/img/logo.png') }}" alt="Logo"></a>
                </div>

                <!-- Navigation Menu -->
                <nav class="header__menu">
                    <ul>
                        <li><a href="{{ route('/') }}">Home</a></li>
                        <li><a href="{{ route('shop') }}">Shop</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                    </ul>
                </nav>

                <!-- User Actions -->
                <div class="header__actions">
                    <a href="#" class="icon-link search-switch">
                        <i class="fa fa-search"></i>
                    </a>
                    <a href="{{ route('favorites') }}" class="icon-link">
                        <i class="fa fa-heart"></i>
                        @auth
                            <span class="badge">{{ $favoriteCount }}</span>
                        @endauth
                    </a>
                    <a href="{{ route('cart') }}" class="icon-link cart-icon">
                        <i class="fa fa-shopping-cart"></i>
                        @auth
                            <span class="badge">{{ $cartCount }}</span>
                        @endauth
                    </a>

                    @auth
                        <a href="{{ route('orders') }}" class="icon-link">
                            <i class="fa-solid fa-truck"></i>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary" >Profile</a>
                        @role('admin')
                            <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
                        @endrole
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">Sign up</a>
                        @endif
                    @endauth
                </div>

                <!-- Mobile Menu Icon -->
                <div class="canvas__open d-lg-none">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
        </div>
    </header>
</div>

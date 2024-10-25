    {{-- Be like water. --}}
    <div>
        <header class="header">
            <div class="container">
                <div class="row align-items-center ">
                    <!-- Logo -->
                    <div class="col-lg-3 col-md-3">
                        <div class="header__logo">
                            <a href="{{ route('/') }}"><img src="{{ asset('assets/website/img/logo.png') }}"
                                    alt="Logo"></a>
                        </div>
                    </div>

                    <!-- Navigation Menu -->
                    <div class="col-lg-5 col-md-5">
                        <nav class="mt-4 header__menu mobile-menu">
                            <ul>
                                <li><a href="{{ route('/') }}">Home</a></li>
                                <li><a href="{{ route('shop') }}">Shop</a></li>
                                <li><a href="{{ route('contact') }}">Contacts</a></li>
                                <li><a href="{{ route('about') }}">About Us</a></li>

                            </ul>
                        </nav>
                    </div>

                    <!-- Icons and User Actions -->
                    <div class="text-right col-lg-4 col-md-4">
                        <div class="header__nav__option " >
                            <!-- Search Icon -->

                            <a href="#" class="icon-link search-switch">
                                <i class="fa fa-search"></i>
                            </a>

                            <!-- Favorites Icon -->
                            <a href="{{ route('favorites') }}" class="icon-link">
                                <i class="fa fa-heart"></i>
                                <span class="cart-count">{{ $favoriteCount }}</span>

                            </a>

                            <!-- Cart Icon -->
                            <a href="{{ route('cart') }}" class="icon-link cart-icon">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="cart-count">{{ $cartCount }}</span>
                            </a>
                            <a href="{{ route('/') }}" class="icon-link">
                                <i class="fa-solid fa-truck"></i>
                            </a>


                            <!-- Profile Actions -->
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Profile</a>
                                    @role('admin')
                                        <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
                                    @endrole
                                    {{-- <a href="{{ route('profile.edit') }}" class="btn btn-primary">Orders</a> --}}
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-primary">Sign up</a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Icon -->
                <div class="canvas__open">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
        </header>

    </div>

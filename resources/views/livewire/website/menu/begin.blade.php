<div>
    <div class="offcanvas-menu-overlay"></div>
    <div class="p-4 offcanvas-menu-wrapper bg-light" style="width: 230px;">
        <!-- Auth buttons -->
        <div class="col-lg-3 col-md-3">
            <div class="header__logo">
                <a href="{{ route('/') }}"><img src="{{ asset('assets/website/img/logo.png') }}"
                        alt="Logo"></a>
            </div>
        </div>
        <div class="mb-4 text-center auth-buttons">
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Profile</a>
                    @role('admin')
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
                    @endrole
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Orders</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary">Sign up</a>
                    @endif
                @endauth
            @endif
        </div>

        <!-- Offcanvas Navigation Icons (Cart, Heart, etc.) -->
        <div class="mb-4 offcanvas__nav__option d-flex justify-content-around">
            <a href="#" class="icon-link">
                <i class="fa fa-search"></i>
            </a>

            <!-- Favorites Icon -->
            <a href="{{ route('favorites') }}" class="icon-link">
                <i class="fa fa-heart"></i>
            </a>

            <!-- Cart Icon -->
            <a href="{{ route('cart') }}" class="icon-link cart-icon">
                <i class="fa fa-shopping-cart"></i>
                <span class="cart-count">{{ $cartCount }}</span>
            </a>

        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu-wrap"></div>
    </div>
</div>

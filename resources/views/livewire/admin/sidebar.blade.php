<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- User Profile Section -->
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ Storage::url($user->image) }}" alt="profile" />
                    <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{$user->name}}</span>
                    <span class="text-secondary text-small">Project Manager</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>

        <!-- Dashboard Link -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        <!-- Dashboard Link -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('categories') }}">
                <span class="menu-title">Categories</span>
                {{-- <i class="mdi mdi-home menu-icon"></i> --}}
                <i class="fa-solid fa-list menu-icon"></i>
            </a>
        </li>

        <!-- Dashboard Link -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('products') }}">
                <span class="menu-title">Products</span>
                <i class="fa-brands fa-product-hunt menu-icon"></i>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('inventory') }}">
                <span class="menu-title">Inventory</span>
                <i class="fa-solid fa-warehouse menu-icon"></i>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('coupons') }}">
                <span class="menu-title">Coupons</span>
                <i class="fa-solid fa-dollar-sign menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.orders') }}">
                <span class="menu-title">Orders</span>
                <i class="fa-solid fa-truck menu-icon"></i>
            </a>
        </li>
        {{-- <!-- Basic UI Elements -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Basic UI Elements</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ asset('pages/ui-features/buttons.html') }}">Buttons</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ asset('pages/ui-features/dropdowns.html') }}">Dropdowns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ asset('pages/ui-features/typography.html') }}">Typography</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Icons -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <span class="menu-title">Icons</span>
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
            <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ asset('pages/icons/font-awesome.html') }}">Font Awesome</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Forms -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#forms" aria-expanded="false" aria-controls="forms">
                <span class="menu-title">Forms</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
            <div class="collapse" id="forms">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ asset('pages/forms/basic_elements.html') }}">Form Elements</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Charts -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <span class="menu-title">Charts</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ asset('pages/charts/chartjs.html') }}">ChartJs</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Tables -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <span class="menu-title">Tables</span>
                <i class="mdi mdi-table-large menu-icon"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ asset('pages/tables/basic-table.html') }}">Basic table</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- User Pages -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-lock menu-icon"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ asset('pages/samples/blank-page.html') }}"> Blank Page </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ asset('pages/samples/login.html') }}"> Login </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ asset('pages/samples/register.html') }}"> Register </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ asset('pages/samples/error-404.html') }}"> 404 </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ asset('pages/samples/error-500.html') }}"> 500 </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Documentation -->
        <li class="nav-item">
            <a class="nav-link" href="{{ asset('docs/documentation.html') }}" target="_blank">
                <span class="menu-title">Documentation</span>
                <i class="mdi mdi-file-document-box menu-icon"></i>
            </a>
        </li> --}}
    </ul>
</nav>

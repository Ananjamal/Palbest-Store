<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PalBest Store</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('assets/website/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/website/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/website/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/website/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/website/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/website/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/website/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

{{-- Add your CSS for animations --}}
<style>
    .filter-button {
        cursor: pointer;
        transition: transform 0.2s; /* Smooth scaling effect */
    }

    .filter-button:hover {
        transform: scale(1.05); /* Slightly enlarge button on hover */
    }

    .fade-in {
        opacity: 0;
        transition: opacity 0.5s ease-in-out; /* Fade-in effect */
    }

    /* Active state */
    .active {
        font-weight: bold;
        color: #007bff; /* Change color of active button */
    }

    /* Trigger the fade-in effect */
    .product__filter .fade-in {
        opacity: 1; /* Reset opacity for visible items */
    }
</style>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <!-- Offcanvas Menu Begin -->
    {{-- <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">

        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
            <a href="#"><img src="img/icon/heart.png" alt=""></a>
            <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
            <button class="btn btn-primary">Log in</button>
            <button class="btn btn-primary">Sign up</button>
        </div>
        <div id="mobile-menu-wrap"></div>

    </div> --}}
    <!-- Offcanvas Menu End -->
    <div class="header">
        @livewire('website.header.header')
        @livewire('website.menu.begin')

        {{ $slot }}
        @livewire('website.footer.footer')
    </div>

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- Js Plugins -->
    <script src="{{ asset('assets/website/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/website/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/website/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/website/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/website/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/website/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/website/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('assets/website/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('assets/website/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/website/js/main.js') }}"></script>
    {{-- <script src="{{ asset('assets/admin/js/modals.js') }}"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.addEventListener('swal:alert', function(event) {
            const alertData = event.detail[0];

            Swal.fire({
                title: alertData.title || 'No Title',
                text: alertData.text || 'No Text',
                icon: alertData.icon || 'info',
                confirmButtonText: 'OK'
            });
        });
    </script>


    {{-- <script src="{{ asset('assets/admin/js/modals.js') }}"></script> --}}







{{-- Add JavaScript for fade-in effect --}}
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.hook('message.processed', (message, component) => {
            // Find all product items and add fade-in class after Livewire updates
            const items = document.querySelectorAll('.product__filter .fade-in');
            items.forEach(item => {
                item.classList.remove('fade-in'); // Remove the class
                void item.offsetWidth; // Trigger reflow to restart the animation
                item.classList.add('fade-in'); // Add it back to trigger fade-in
            });
        });
    });
</script>


    @livewireScripts()


</body>

</html>

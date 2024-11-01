{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login </title>

    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="{{ asset('assets/website/css/authStyle.css') }}">

    <style>
        .bg-video,
        .form-wrap {
            height: 100vh;
            min-height: 500px;
        }

        .bg-video {
            position: relative;
            left: 0;
            width: 100%;
            height: 200px;
            /* Mobile height */
            min-height: 200px;
            z-index: 2;
            overflow: hidden;
        }

        .bg-video video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Responsive adjustments */

        @media (min-width: 768px) {
            .bg-video {
                position: fixed;
                width: 50%;
                height: 100vh;
            }
        }

        @media (min-width: 992px) {
            .bg-video {
                position: fixed;
                width: 50%;
                height: 100vh;
            }
        }

        @media (min-width: 1200px) {
            .bg-video {
                position: fixed;
                width: 60%;
                height: 100vh;
            }
        }
    </style>

    @livewireStyles
</head>

<body>
    <!-- Page Preloader -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <div class="site-wrap d-md-flex align-items-stretch">
        <div class="bg-video">
            <video autoplay muted loop playsinline>
                <source src="{{ asset('assets/website/images/Colorful Trendy Online Shop Logo.mp4') }}"
                    type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="form-wrap">
            <div class="form-inner">
                <h1 class="title">Sign up</h1>
                <p class="caption mb-4">Create your account in seconds.</p>

                <form method="POST" action="{{ route('register') }}" class="pt-3">
                    @csrf

                    <!-- Name -->

                    <!-- Full Name -->
                    <div class="form-floating mb-3">
                        <x-text-input id="name" type="text" name="name" class="form-control"
                            placeholder="Full Name" :value="old('name')" required autofocus autocomplete="name" />
                        <label for="name">Full Name</label>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" style="color: red" />
                    </div>

                    <!-- Email Address -->
                    <div class="form-floating mb-3">
                        <x-text-input id="email" type="email" name="email" class="form-control"
                            placeholder="info@example.com" :value="old('email')" required autocomplete="username" />
                        <label for="email">Email Address</label>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: red" />
                    </div>

                    <!-- Password -->
                    <div class="form-floating mb-3 position-relative">
                        <span
                            class="password-show-toggle js-password-show-toggle position-absolute end-0 top-50 translate-middle-y me-3">
                            <span class="uil"></span>
                        </span>
                        <x-text-input id="password" type="password" name="password" class="form-control"
                            placeholder="Password" required autocomplete="new-password" />
                        <label for="password">Password</label>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" style="color: red" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-floating mb-3 position-relative">
                        <span
                            class="password-show-toggle js-password-show-toggle position-absolute end-0 top-50 translate-middle-y me-3">
                            <span class="uil"></span>
                        </span>
                        <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                            class="form-control" placeholder="Confirm Password" required autocomplete="new-password" />
                        <label for="password_confirmation">Confirm Password</label>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" style="color: red" />
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label for="remember" class="form-check-label">I agree to the <a href="#">Terms of
                                    Service</a> and <a href="#">Privacy Policy</a></label>
                        </div>
                    </div>

                    <div class="d-grid mb-4">
                        <x-primary-button class="btn btn-primary">
                            {{ __('Create an account') }}
                        </x-primary-button>
                    </div>

                    <div class="mb-2">Already a member? <a href="{{ route('login') }}">{{ __('Log in') }}</a></div>

                    <div class="container-fluid bg-light py-3">
                        <div class="row">
                            <div class="col-12 text-center social-account-wrap">
                                <h4 class="mb-4"><span>or continue with</span></h4>
                                <ul class="list-inline social-account">
                                    <li class="list-inline-item">
                                        <a href="{{ route('google') }}">
                                            <img src="{{ asset('assets/website/images/icon-google.svg') }}"
                                                alt="Google logo">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>




    <!-- Bootstrap and Custom JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/website/js/authCustom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    @livewireScripts
</body>

</html>

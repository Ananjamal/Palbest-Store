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
    @livewireStyles
</head>

<body>
    <!-- Page Preloader -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Main Content -->
    <div class="site-wrap d-md-flex align-items-stretch">
        <!-- Background Image Section -->
        <div class="bg-img" style="background-image: url({{ asset('assets/website/images/img-bg-1.jpg') }})"></div>

        <!-- Form Section -->
        <div class="form-wrap">
            <div class="form-inner">
                <!-- Form Title and Description -->
                <h1 class="title">Login</h1>
                <p class="caption mb-4">Please enter your login details to sign in.</p>

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="pt-3">
                    @csrf

                    <!-- Email Input -->
                    <div class="form-floating mb-3">
                        <x-text-input id="email" type="email" name="email" class="form-control"
                            placeholder="info@example.com" :value="old('email')" required autofocus
                            autocomplete="username" />
                        <label for="email">Email Address</label>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: red" />
                    </div>

                    <!-- Password Input with Toggle -->
                    <div class="form-floating mb-3 position-relative">
                        <span
                            class="password-show-toggle js-password-show-toggle position-absolute end-0 top-50 translate-middle-y me-3"><span
                                class="uil"></span></span>
                        <x-text-input id="password" type="password" name="password" class="form-control"
                            placeholder="Password" required autocomplete="current-password" />
                        <label for="password">Password</label>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" style="color: red" />
                    </div>

                    <!-- Remember Me and Forgot Password -->
                    <div class="d-flex justify-content-between mb-3">
                        <div class="form-check">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <label for="remember_me" class="form-check-label">Keep me logged in</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot password?</a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid mb-4">
                        <x-primary-button class="btn btn-primary">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>

                    <!-- Sign Up Link -->
                    <div class="mb-2">Don’t have an account? <a href="{{ route('register') }}">Sign up</a></div>

                    <!-- Social Login Options -->
                    <div class="social-account-wrap">
                        <h4 class="mb-4"><span>or continue with</span></h4>
                        <ul class="list-unstyled social-account d-flex justify-content-between">
                            <li><a href="{{route('google')}}"><img src="{{ asset('assets/website/images/icon-google.svg') }}"
                                        alt="Google logo"></a></li>
                            <li><a href="#"><img src="{{ asset('assets/website/images/icon-facebook.svg') }}"
                                        alt="Facebook logo"></a></li>
                            <li><a href="#"><img src="{{ asset('assets/website/images/icon-apple.svg') }}"
                                        alt="Apple logo"></a></li>
                            <li><a href="#"><img src="{{ asset('assets/website/images/icon-twitter.svg') }}"
                                        alt="Twitter logo"></a></li>
                        </ul>
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

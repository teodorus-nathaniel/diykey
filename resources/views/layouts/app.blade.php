<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DIYKey') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/edec9478a1.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-dark text-light">
    <div id="app">
        <nav class="navbar navbar-expand-md bg-dark shadow-sm">
            <div class="container py-2">
                <a class="navbar-brand font-weight-bold position-relative text-highlight" href="{{ url('/') }}">
                    {{ config('app.name', 'DIYKey') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item mr-2">
                            <a class="nav-link text-light font-weight-bold" href="{{ route('products') }}">Our Products</a>
                        </li>
                        @guest
                        @else
                        <li class="nav-item mr-2">
                            <a class="nav-link text-light font-weight-bold" href="{{ route('transactions') }}">Your Transactions</a>
                        </li>
                        @endif
                        @if(Auth::user() != null && Auth::user()->role == 'admin')
                        <li class="nav-item mr-2">
                            <a class="nav-link text-light font-weight-bold" href="{{ route('add-product-view') }}">Add Product</a>
                        </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto d-flex align-items-center">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item mr-4">
                                <a class="nav-link text-light font-weight-bold" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <button class="btn btn-primary btn-sm font-weight-bold">
                                        <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </button>
                                </li>
                            @endif
                        @else
                            <li class="nav-item mr-2">
                                <a class="nav-link text-light font-weight-bold position-relative" href="{{ route('favourites') }}">
                                    <i class="fa fa-heart fa-lg"></i>
                                </a>
                            </li>   
                            <li class="nav-item mr-4">
                                <a class="nav-link text-light font-weight-bold position-relative" href="{{ route('carts') }}">
                                    <i class="fa fa-shopping-cart fa-lg"></i>
                                </a>
                            </li>
                            <li class="nav-item mr-4 d-flex align-items-center">
                                <p class="m-0 text-sm">Hello, {{ Auth::user()->email }}</p>
                            </li>
                            <li class="nav-item mr-0">
                                <a class="nav-link text-light font-weight-bold" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="w-100 min-height-content">
            @yield('content')
        </main>
    </div>
</body>
</html>

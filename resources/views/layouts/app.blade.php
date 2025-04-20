<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="{{ $currentTheme }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Default Title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md {{ $currentTheme == 'dark' ? 'navbar-dark bg-dark' : 'navbar-light bg-white' }} shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">

                    <!-- Edit navbar, title, logo here -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <div style="display: flex; align-items: center;">
                            <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" style="height:80px; width:80px; border-radius:50%; object-fit:cover; margin-right: 10px;">
                            <p style="margin: 0;">HyperHeaven</p>
                        </div>

                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto align-items-center">
                            @cannot('isAdmin')
                            <!-- Cart Icon -->
                            <!-- if user is login, direct to cart, else direct to login page -->
                            @can('isLogin')
                            <li class="nav-item me-3">
                                <a class="nav-link position-relative" href="{{ route('cartController.showCartList', ['userId' => Auth::id()]) }}">
                                    🛒
                                </a>
                            </li>
                            @else
                            <li class="nav-item me-3">
                                <a class="nav-link position-relative" href="{{ route('login') }}">
                                    🛒
                                </a>
                            </li>
                            @endcan
                            @endcannot

                            <li class="nav-item dropdown me-3">
                                <a class="nav-link dropdown-toggle" href="#" id="themeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-paint-brush"></i> Theme
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="themeDropdown">
                                    <li><a class="dropdown-item" href="{{ route('switchTheme', ['theme' => 'light']) }}">
                                            <i class="fas fa-sun me-2"></i> Light
                                        </a></li>
                                    <li><a class="dropdown-item" href="{{ route('switchTheme', ['theme' => 'dark']) }}">
                                            <i class="fas fa-moon me-2"></i> Dark
                                        </a></li>
                                </ul>
                            </li>

                            <!-- Authentication Links -->
                            @guest
                            @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @endif

                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <!-- Edit Profile Link -->
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a>
                </a>

                @can('isUser')
                <!-- View Orders History Link -->
                <a class="dropdown-item" href="{{ route('cartController.showOrderHistory') }}">
                    View Orders History
                </a>
                @endcan

                <!--For Logout-->
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
            </li>
            @endguest
            </ul>
    </div>
    </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    </div>
</body>

</html>

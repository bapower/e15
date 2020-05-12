<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Food For Thought')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/icons/simple-line-icons.css">
    <link rel="stylesheet" href="css/icons/themify-icons.css">
    <link rel="stylesheet" href="css/icons/set1.css">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    @yield('head')
</head>
<body>
    <div id="app">
        @if(session('flash-alert'))
            <div class='flash-alert'>
                {{ session('flash-alert') }}
            </div>
        @endif
            <div class="nav-menu">
                <div class="bg transition">
                    <div class="container-fluid fixed">
                        <div class="row dark-bg">
                            <div class="col-md-12">
                                <nav class="navbar navbar-expand-lg navbar-light">
                                    <a class="navbar-brand" href="/">Food For Thought</a>
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="icon-menu"></span>
                                    </button>
                                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                                        <ul class="navbar-nav">
                                            <li class="nav-item {{ (request()->is('restaurants')) ? 'active' : '' }}">
                                                <a class="nav-link" href="/restaurants">Browse Restaurants</a>
                                            </li>
                                            <li class="nav-item {{ (request()->is('favorites')) ? 'active' : '' }}">
                                                <a class="nav-link" href="/favorites">Favorites</a>
                                            </li>


                                            @guest
                                                <li class="nav-item {{ (request()->is('login')) ? 'active' : '' }}">
                                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                                </li>
                                                @if (Route::has('register'))
                                                    <li class="nav-item {{ (request()->is('register')) ? 'active' : '' }}">
                                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                                    </li>
                                                @endif
                                            @else
                                                <li class="nav-item dropdown">
                                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                        {{ Auth::user()->name }} <span class="caret"></span>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                        <a class="dropdown-item" dusk="logout-link" href="{{ route('logout') }}"
                                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                            {{ __('Logout') }}
                                                        </a>

                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </li>
                                                @endguest

                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <main class="py-1 app-main">
            @yield('content')
        </main>
            <footer class="main-block dark-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright &copy; 2020 Bry Power</p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
    </div>
</body>
</html>

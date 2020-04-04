<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @section('title')  
            SmartKoli
        @show
    </title>

    <!-- Thumbnail -->
    <meta property="og:image" content="{{ asset('images/kolilogok/teljes_kicsi.png') }}">
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{url('/css/fullcalendar.css')}}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{url('/css/main.css')}}">
    @yield('styles')

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/icons/mouse.png') }}"/>    

    <!-- Scripts -->
    <script src='{{url('/add-on/jquery-3.4.1.min.js')}}'></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    
    <script src='{{url('/add-on/moment.js')}}'></script>
    <script src='{{url('/add-on/fullcalendar.js')}}'></script>
    @yield('scripts-header')

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-158214839-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-158214839-1');
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom fixed-top">
            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">
                    <img id="mandak-logo" src='{{ asset("images/kolilogok/szoveg_nagy.png") }}'>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto ml-md-4 pt-md-1">
                        <!-- Menu items -->
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('laundries') }}">
                                    <span class='icon' style="color: #3490dc"><i class="fas fa-tshirt"></i></span><span id="laundry-nav-text">Mosások</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('guests') }}">
                                    <span class='icon' style="color:hsl(171, 100%, 41%)"><i class="fas fa-bed"></i></span><span id="guest-nav-text">Vendégtáblázat</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('files') }}">
                                    <span class='icon' style="color: #28a745"><i class="fas fa-file-alt"></i></span><span id="file-nav-text">Feltöltések</span>
                                </a>
                            </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if(auth()->user()->isadmin == 1)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin') }}">
                                        <span class='icon' style="color: #858585"><i class="fa fa-cog"></i></span><span>Admin</span>
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span class='icon'><i class="fas fa-user"></i></span><span>{{ Auth::user()->name }}</span><span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
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
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container py-4">
            @yield('content')
        </main>

        @yield('footer')
    </div>

    @yield('scripts-body')
</body>
</html>

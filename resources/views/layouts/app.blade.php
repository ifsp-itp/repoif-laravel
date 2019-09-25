<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/storage/files/logoif.png" type="image/x-icon" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>REPOIF</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-md bg-dark flex-row">
                <a class="navbar-brand mr-auto" href="{{ url('/projects') }}">
                    REPOIF
                </a>
                <ul class="navbar-nav flex-row mr-lg-0">
                    <li class="nav-item">
                         <a class="nav-link pr-2"><i class="fa fa-search"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pr-2"><i class="fa fa-facebook"></i></a>
                    </li>
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle mr-3 mr-lg-0" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i><span class="caret">{{ Auth::user()->name }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/user/profile/{{auth()->id()}}">
                                    Profile
                                </a>
                                    
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
                <button class="navbar-toggler ml-lg-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
            <nav class="navbar navbar-expand-md navbar-light bg-custom">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/projects/create') }}"><span  class="teste"> CRIAR</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/projects/news') }}">NOVOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/projects/photos') }}">FOTOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/projects/videos') }}">VÍDEOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/projects/codes') }}">SCRIPT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/projects/pdf') }}">PDF</a>
                        </li>

                    </ul>
                    <form class="form-inline my-2 my-lg-0" action="/projects/search" method="post">
                        @method('POST')
                        @csrf
                        <input class="form-control mr-sm-2" name="search" type="text" placeholder="Buscar ...">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                    </form>
                </div>
            </nav>
       

        <div class="container-fluid">

            <main class="py-4">
                @yield('content')
            </main>
    </div>
</body>
</html>

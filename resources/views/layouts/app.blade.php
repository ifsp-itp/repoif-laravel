<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/storage/icons/logoif.png" type="image/x-icon" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>REPOIF</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Progress Bar -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f2a0c0f26f.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
            <nav class="navbar navbar-expand-md bg-dark">
                <a class="navbar-brand mr-auto" href="{{ url('/projects') }}">
                    REPOIF
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto mgl">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/projects/news') }}">Ultimos envios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/projects/photos') }}">Fotos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/projects/videos') }}">Vídeos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/projects/codes') }}">Scripts</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/projects/create') }}">
                                <span  class="teste">
                                    CRIAR
                                </span>
                            </a>
                        </li>

                    </ul>
                    <form class="form-inline my-2 my-lg-0 mgr" action="/projects/search" method="post">
                        @method('POST')
                        @csrf
                        <input class="form-control mr-sm-2" type="text" placeholder="Buscar ...">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                    </form>

                    <ul class="navbar-nav flex-row mr-lg-0">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle mr-3 mr-lg-0 mgl " id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret">{{ Auth::user()->name }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/user/profile/{{auth()->id()}}">
                                    Meu Perfil
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Sair') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </li>
                    @endguest
                </ul>

                </div>
            </nav>


        <div class="container-fluid">

            <main class="py-4 w-100">
                @yield('content')
            </main>
    </div>
</body>
</html>

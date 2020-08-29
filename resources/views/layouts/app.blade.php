<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=chrome"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta http-equiv="X-UA-Compatible" content="ie=ie"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/storage/icons/logoif.png" type="image/x-icon" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="theme-colors" content="#000"/>

    <title>REPOIF</title>


    <!-- Progress Bar -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="{{ asset('ajax/jquery.js') }}"></script>
    <script src="{{ asset('ajax/form/jquery.js') }}"></script>

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f2a0c0f26f.js" crossorigin="anonymous"></script>

    <!-- Styles -->
   <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .it{
            list-style-type: none;
            text-decoration: none;
            text-transform: none;
        }
    </style>
</head>
<body>
    <!--
        menu mobile
    -->
    
    <div id="app">
    <nav class="navbar navbar-expand-xl nav-color">
                <a class="navbar-brand text-light mr-auto" href="{{ url('/projects') }}">
                    REPOIF
                </a>
                
                <!--menu dropdown-->
                <button id="btn-menu" onClick="menu()" class="navbar-toggler" type="button" aria-expanded="false" data-toggle="collapse" data-target="#header-nav">
                    <div type="context center">
                      <p class="h2 py-2 mr-4 icon-button text-light">
                          <img src="/storage/icons/icon-menu.png" width="20" height="20" alt="menu">
                      </p> 
                    </div>
                </button>

                <div class="collapse navbar-collapse menu-grade"  id="header-nav">
                    <ul class="flex navbar-nav  mr-auto mgl">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('/projects/news') }}">Ultimos envios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('/projects/photos') }}">Fotos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('/projects/videos') }}">Vídeos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('/projects/codes') }}">Scripts</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('/projects/create') }}">
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
                            <a class="nav-link text-light dropdown-toggle mr-3 mr-lg-0 mgl " id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret text-light">{{ Auth::user()->name }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="#navbarDropdownMenuLink" id="drop">
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
        <div class="lista">
    <ul class="menu">
		<div>
				    <ul class="navbar-nav mr-auto mgl">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('/projects/news') }}">Ultimos envios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('/projects/photos') }}">Fotos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('/projects/videos') }}">Vídeos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('/projects/codes') }}">Scripts</a>
                        </li>

                        <li class="nav-item it">
                            <a class="nav-link text-light" href="{{ url('/projects/create') }}">
                                <span  class="teste">
                                    CRIAR
                                </span>
                            </a>
                        </li>

                    </ul>
				</div>
				<div>
                    <ul class="navbar-nav flex-row mr-lg-0 st-link">
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
                            <a class="nav-link text-light dropdown-toggle mr-3 mr-lg-0 mgl " id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret text-light">{{ Auth::user()->name }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="#navbarDropdownMenuLink" id="drop2">
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
        </ul>	
	</div>
                <!--fim dropdown-->


        <div class="container-fluid">

            <main class="py-4">
                @yield('content')
            </main>
    </div>
</div>
<script src="{{ asset('menu/menu.js') }}"></script>
</body>
</html>

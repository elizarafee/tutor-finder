<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tutor Finder') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Scripts -->
    <script src="{{ asset('js/all.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container pt-2 pb-2">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Tutor Finder') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/about') }}">About</a>
                        </li> 
                        @else 

                     


                        <?php $user_type = auth()->user()->type; ?>
                        

                        @if($user_type == 1)  
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/about') }}">About</a>
                        </li>
                        @elseif($user_type == 2)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/students') }}">Students</a>
                            </li>
                        @elseif($user_type == 3) 
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/tutors') }}">Tutors</a>
                            </li>
                        @endif 



                        @endguest 

                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                       
                        @else

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/login') }}">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</a>
                        </li>

                        <li class="nav-item mr-3">
                            <a class="nav-link" href="{{ url('/login') }}" title="Requests"><i class="fas fa-user-friends fa-2x float-left"></i><sup class="badge badge-success float-left">3</sup></a>
                        </li>

                        <li class="nav-item mt-2">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout <i class="fas fa-sign-out-alt"></i>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" style="min-height: 450px;">
            @yield('content')
        </main>
        <div class="border-top h-100 position-sticky">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 pt-4 text-muted text-center">
                        <p>This application is designed and developed by Eliza Ahmed</p>
                        <p>Tutor Finder &copy; {{date('Y')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

 </body>

</html>
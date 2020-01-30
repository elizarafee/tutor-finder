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

    <!-- Fontawesome Scripts -->
    <script src="{{ asset('js/all.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        @include('shared.nav')
        <main class="container py-4" style="min-height: 350px;">

            @hasSection('page_title')
            <div class="row mb-3 justify-content-center">
                <div class="col-md-8">
                    <h3 class="text-center pb-2 border-bottom">@yield('page_title')</h3>
                </div>
            </div>
            @endif

            @include('shared.alerts')
            @yield('content')
        </main>
        @include('shared.footer')
    </div>
</body>
</html>
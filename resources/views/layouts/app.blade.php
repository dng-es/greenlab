<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ session()->get('site')->name }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ url('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div id="app">
        @include('layouts.header')

        <main class="{{-- py-4 --}}">
            @yield('content')
        </main>
        
    </div>

    <div id="toTop"><i class="fa fa-arrow-up"></i></div>

    @include('layouts.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ url('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    @yield('js')
</body>
</html>

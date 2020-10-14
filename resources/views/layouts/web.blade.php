<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="">
    <title>Savia Corp</title>

    <link rel="stylesheet" href="{{asset('css/main.css')}}">

    @stack('head')

</head>
<body>

<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">

    <!-- Header Start -->
    @include('layouts.includes._header')
    <!-- Header End -->
    <div class="app-main">
        <!-- Left Sidebar Start -->
        @include('layouts.includes._sidebar')
        <!-- Left Sidebar End -->
        <div class="app-main__outer">
            <div class="app-main__inner">
                @yield('content')
            </div>
            <!-- Start Footer -->
            @include('layouts.includes._footer')
            <!-- End Footer -->
        </div>


    </div>


</div>

<script src="{{ asset('js/main.js') }}"></script>

@stack('endBody')
</body>
</html>

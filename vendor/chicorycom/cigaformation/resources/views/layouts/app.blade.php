<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="" />
    <meta property="og:type"  content="website" />
    <meta property="og:description"   content=" " />
    <meta property="og:site_name"   content="" />
    <meta property="og:locale"   content="fr_FR" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:image" content="" />
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="/css/style.css" rel="stylesheet">

</head>
<body class="water-loading">
        <div class="parent-water">
            <div class="water"><span>CIGA FORMATION</span></div>
        </div>

        <div class="all">
            <!--================ Start Header Menu Area =================-->
            @include('chicorycom::partials.navbar')
            @section('header')
                <x-chicorycom-slide></x-chicorycom-slide>
            @show
            <main class="py-4">
                @yield('content')
            </main>
            @include('chicorycom::partials.footer')
        </div>


        <script src="/js/theme.js"></script>
        <script type="text/javascript" src="/js/loader.min.js"></script>
        @stack('scripts')
</body>
</html>

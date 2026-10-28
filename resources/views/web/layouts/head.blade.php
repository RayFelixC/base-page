<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Proyect') }} — Laravel 10 + Bootstrap 5 + React 17 starter</title>

    <!-- SEO -->
    <meta name="description" content="Laravel 10 + Bootstrap 5 + React 17 starter template with authentication and a ready-to-use landing page.">
    <link rel="canonical" href="https://[DOMINIO]/">
    <meta name="theme-color" content="#aad2d7">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Base Laravel Page">
    <meta property="og:title" content="Base Laravel Page — Laravel 10 + Bootstrap 5 + React 17 starter">
    <meta property="og:description" content="Laravel 10 + Bootstrap 5 + React 17 starter template with authentication and a ready-to-use landing page.">
    <meta property="og:url" content="https://[DOMINIO]/">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Base Laravel Page — Laravel 10 + Bootstrap 5 + React 17 starter">
    <meta name="twitter:description" content="Laravel 10 + Bootstrap 5 + React 17 starter template with authentication and a ready-to-use landing page.">

    <!-- Favicons -->
    <link href="{{ asset('/imgs/favicons/favicon.svg') }}" rel="icon" type="image/svg+xml">
    <link href="{{ asset('/imgs/favicons/favicon.ico?v=2') }}" rel="icon" type="image/x-icon">
    <link href="{{ asset('/imgs/favicons/apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180">
    <link href="{{ asset('/imgs/favicons/favicon-96x96.png') }}" rel="icon" type="image/png" sizes="96x96">
    <link href="{{ asset('/imgs/favicons/favicon-32x32.png') }}" rel="icon" type="image/png" sizes="32x32">
    <link href="{{ asset('/imgs/favicons/favicon-16x16.png') }}" rel="icon" type="image/png" sizes="16x16">
    <link href="{{ asset('/imgs/favicons/site.webmanifest') }}" rel="manifest">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Proyect') }}</title>

    <!-- Private area: keep out of search engines -->
    <meta name="robots" content="noindex, nofollow">

    <!-- Favicons -->
    <link href="{{ asset('/imgs/favicons/favicon.svg') }}" rel="icon" type="image/svg+xml">
    <link href="{{ asset('/imgs/favicons/favicon.ico?v=2') }}" rel="icon" type="image/x-icon">
    <link href="{{ asset('/imgs/favicons/apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180">
    <link href="{{ asset('/imgs/favicons/site.webmanifest') }}" rel="manifest">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
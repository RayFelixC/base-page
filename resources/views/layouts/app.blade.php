<!doctype html><html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
    <body>
        <div id="app">
            @include('layouts.navbar')
            <main class="py-4">@yield('content')</main>
        </div>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>

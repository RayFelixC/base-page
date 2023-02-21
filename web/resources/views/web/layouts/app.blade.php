<!doctype html><html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('web.layouts.head')
    <body>
        <div id="app">
            @include('web.layouts.navbar')
            <main class="py-4"><div class="container-fluid">@yield('content')</div></main>
            <div class="container-fluid">@include('web.layouts.footer')</div>
        </div>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
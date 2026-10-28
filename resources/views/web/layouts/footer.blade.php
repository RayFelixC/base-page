<div class="container">
    <footer style="text-align:center">
        <strong>Copyright © {!! \Carbon\Carbon::now()->format('Y') !!} <a href="#">{{ config('app.name') }}</a>.</strong>
        All rights reserved. (<small>Version {!! env('VERSION') !!}</small>)
    </footer>
</div>
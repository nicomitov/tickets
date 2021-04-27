<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Error 403</title>
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="/images/icon.png">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
    <body>
        <div class="app blank sidebar-opened">
            <article class="content">
                <div class="error-card global">
                    <div class="error-title-block">
                        <h1 class="error-title">403</h1>
                        <h2 class="error-sub-title"> Sorry, you don't have permissions to view this page </h2>
                    </div>
                    {{-- <div class="error-container"> --}}
                    <div class="text-center">
                        <a class="btn btn-primary mt-4" href="/">
                            <i class="fas fa-angle-left"></i> Back to Dashboard </a>
                    </div>
                </div>
            </article>
        </div>
        <!-- Reference block for JS -->
        <div class="ref" d="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>

{{--     <script src="{{ asset('js/vendor.js') }}" ></script>
    <script src="{{ asset('js/theme.js') }}" ></script> --}}
    <script src="{{ asset('js/app.js') }}" defer></script>

    </body>
</html>

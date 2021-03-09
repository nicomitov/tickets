<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('page_title')</title>
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="/images/icon.png">

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="https://fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div class="auth">
        <div class="auth-container">
            <div class="card">

                <header class="auth-header">
                    <a href="/" class="font-weight-bold">
                        {{-- <img src="/images/logo_1.svg" style="width:126px;"> --}}
                        TICKETS
                    </a>
                </header>

                <div class="auth-content">
                    <p class="text-center"> @yield('page_title') </p>
                    <p class="text-muted text-center"><small> @yield('page_description') </small></p><br>
                    @yield('content')
                </div>

            </div>
        </div>
    </div>

    <!-- Reference block for JS -->
    <div class="ref" d="ref">
        <div class="color-primary"></div>
        <div class="chart">
            <div class="color-primary"></div>
            <div class="color-secondary"></div>
        </div>
    </div>

    <script src="{{ asset('js/vendor.js') }}" ></script>
    <script src="{{ asset('js/theme.js') }}" ></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    @yield('js')

</body>
</html>

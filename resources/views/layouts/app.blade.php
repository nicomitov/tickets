<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('page_title')</title>
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="/images/icon.png">

    {{-- Styles --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('css')
</head>
<body>
    <div class="main-wrapper">
        <div class="app sidebar-fixed" id="app">

            @include('layouts.header')

            @include('layouts.sidebar')

            <article class="content">
                <div class="title-block">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-baseline mt-2 mt-md-0">
                        <div class="page_title_block">
                            <h1 class="title mr-3">
                                {{ Breadcrumbs::render() }}
                            </h1>
                        </div>

                        <div class="">
                            @yield('page_buttons')
                        </div>
                    </div>
                </div>

                @include('partials.errors')
                @include('partials.status')

                <div class="d-flex flex-column-reverse flex-xl-row">
                    <div class="flex-fill">
                        @yield('content')
                    </div>

                    @yield('filter')
                </div>

            </article>

            @include('layouts.footer')
            @include('partials.form_modal')
        </div>
    </div>

    {{-- Reference block for JS --}}
    <div class="ref" d="ref">
        <div class="color-primary"></div>
        <div class="chart">
            <div class="color-primary"></div>
            <div class="color-secondary"></div>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>

    @yield('js')

    @stack('scripts')

</body>
</html>

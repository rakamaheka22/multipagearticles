<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title_prefix', config('app.name', 'Laravel')) |
        @yield('title', 'CMS') -
        @yield('title_postfix', '')
    </title>

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Fonts --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">

    {{-- Laravel Mix - CSS File --}}
    <link rel="stylesheet" href="{{ mix('css/admin.css') }}">

    {{-- Argon Dashboard CSS --}}
    <link rel="stylesheet" href="{{ asset('vendor/argon/css/argon.min.css') }}">

    @yield('css')
</head>

<body class="@yield('classes_body')">
    {{-- Sidenav --}}
    @include('cms.layouts.partials.sidenav.sidenav-main')

    {{-- Main content --}}
    <div class="main-content" id="panel">
        @include('cms.layouts.partials.main-content.topnav.topnav')

        @component('cms.layouts.partials.main-content.header.header')
            @yield('header')
        @endcomponent

        {{-- Page content --}}
        <div class="container-fluid mt--6">
            @yield('content')

            @include('cms.layouts.partials.main-content.footer.footer')
        </div>
    </div>

    {{-- Laravel Mix - JS File --}}
    <script src="{{ mix('js/admin.js') }}"></script>

    {{-- Argon Dashboard JS --}}
    <script src="{{ asset('vendor/argon/js/argon.min.js') }}"></script>

    @yield('js')
</body>

</html>

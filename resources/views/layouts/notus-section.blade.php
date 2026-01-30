<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="./assets/img/favicon.ico" />
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    @yield('css')
    <title>{{ config('app.name', 'Laravel') }}</title>
    @laravelPWA
</head>

<body class="text-slate-700 antialiased">
    @yield('content')
</body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-livewire-alert::scripts />
@livewireScripts
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
@yield('js')

</html>

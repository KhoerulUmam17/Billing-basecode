<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Description" content="Laravel Tailwind CSS Responsive Admin Web Dashboard Template">
    <meta name="keywords"
        content="admin panel in laravel, tailwind, tailwind template admin, laravel admin panel, tailwind css dashboard, admin dashboard template, admin template, tailwind laravel, template dashboard, admin panel tailwind, tailwind css admin template, laravel tailwind template, laravel tailwind, tailwind admin dashboard">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- FAVICON -->
    <link rel="icon" href="{{asset('build/assets/images/brand-logos/favicon.ico')}}" type="image/x-icon">

    <!-- ICONS CSS -->
    <link href="{{asset('build/assets/iconfonts/icons.css')}}" rel="stylesheet">

    @filamentStyles
    <!-- APP SCSS -->
    @vite(['resources/sass/app.scss'])


    @include('layouts.components.styles')

    <!-- MAIN JS -->
    <script src="{{asset('build/assets/main.js')}}"></script>

    @yield('styles')

    <!-- Styles -->
    {{-- @livewireStyles --}}
    @livewireChartsScripts

    @laravelPWA

    <style>
        .kanban-board {
            display: flex;
            gap: 1rem;
        }

        .kanban-column {
            flex: 1;
            background: #f4f4f4;
            padding: 1rem;
            border-radius: 8px;
            min-height: 400px;
        }

        .task-card {
            background: #fff;
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <!-- SWITCHER -->

    @include('layouts.components.switcher')

    <!-- END SWITCHER -->

    <!-- LOADER -->
    <div id="loader">
        <img src="{{asset('build/assets/images/media/loader.svg')}}" alt="">
    </div>
    <!-- END LOADER -->

    <!-- PAGE -->
    <div class="page">

        <!-- HEADER -->

        @include('layouts.components.header')

        <!-- END HEADER -->

        <!-- SIDEBAR -->

        @include('layouts.components.sidebar')

        <!-- END SIDEBAR -->

        <!-- MAIN-CONTENT -->
        <div class="content">
            <div class="main-content">

                @yield('content', $slot ?? '')

            </div>
        </div>

        <!-- END MAIN-CONTENT -->

        <!-- SEARCH-MODAL -->

        @include('layouts.components.search-modal')

        <!-- END SEARCH-MODAL -->

        <!-- FOOTER -->

        @include('layouts.components.footer')

        <!-- END FOOTER -->

    </div>
    <!-- END PAGE-->

    @include('layouts.components.scripts')

    <!-- STICKY JS -->
    <script src="{{asset('build/assets/sticky.js')}}"></script>

    <!-- APP JS -->
    @vite('resources/js/app.js')

    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v2.x.x/dist/livewire-sortable.js"></script>

    <!-- CUSTOM-SWITCHER JS -->
    @vite('resources/assets/js/custom-switcher.js')

    @vite('resources/assets/js/custom.js')
    
    {{-- @livewireScripts --}}
    @filamentScripts

    @yield('scripts')
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Livewire.on('photoUpdated', newPhotoPath => {
                const profileImage = document.getElementById('profileImage');
                if(profileImage) {
                    profileImage.src = `/storage/${newPhotoPath}`;
                }
            });
        });
    </script>
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <x-livewire-alert::scripts />
</body>

</html>
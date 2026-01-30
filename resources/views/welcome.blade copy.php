<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="flex min-h-screen">
        @include('layouts.components.sidebar')
        <div class="flex-1 flex flex-col">
            @include('layouts.components.header')
            <main class="flex-1 p-6 bg-gray-100">
                <h1 class="text-2xl font-bold mb-4">Selamat Datang di Admin Panel</h1>
                <div class="bg-white rounded shadow p-6">
                    <p>Ini adalah halaman dashboard blank dengan sidebar dan navbar dari komponen.</p>
                </div>
            </main>
        </div>
    </div>
</body>
</html>

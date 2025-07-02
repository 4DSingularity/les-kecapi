<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        {{-- Menggunakan font yang sama dengan front-end dan panel admin --}}
        <link href="https://fonts.bunny.net/css?family=lora:700|poppins:400,500" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Poppins', sans-serif; }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        {{-- [PERBAIKAN] Mengubah latar belakang menjadi warna kustom 'krem' --}}
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-krem">

            {{-- Slot ini akan diisi oleh seluruh konten dari login.blade.php, --}}
            {{-- termasuk div putih pembungkusnya. --}}
            {{ $slot }}
            
        </div>
    </body>
</html>
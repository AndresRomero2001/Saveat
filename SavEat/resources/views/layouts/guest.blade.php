<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">

        <!-- Mobile Content -->
        <div class="min-h-screen bg-gray-100 sm:hidden pb-16">
            <div class="min-h-screen flex flex-col justify-center items-center sm:pt-0 bg-gray-100 ">
                <div class="mb-4">
                    <x-application-logo class="w-16 h-16 fill-current text-gray-500" />
                </div>

                <!-- bienvenido a SavEat -->
                {{-- <h1 class="text-2xl font-bold mb-4">SavEat</h1> --}}

                <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <!-- Desktop/Tablet Message -->
        <div class="min-h-screen bg-gray-100 hidden sm:block">
            <x-only-mobile-msg />
        </div>
    </body>
</html>

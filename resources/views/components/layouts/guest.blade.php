@props([
    'title' => null,
    'withVanta' => false,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ? $title.' — FELINE' : 'FELINE' }}</title>

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="relative min-h-screen overflow-x-hidden bg-[#151824] text-[#F3F5FC] antialiased">
        <div aria-hidden="true" class="crt-scanlines pointer-events-none fixed inset-0 z-40"></div>

        @if ($withVanta)
            <div
                aria-hidden="true"
                class="pointer-events-none fixed inset-0 z-0"
                style="background: radial-gradient(circle at 22% 20%, rgba(24, 49, 70, 0.72) 0%, rgba(21, 24, 36, 0.92) 55%, #11141F 100%);"
            ></div>
            <div
                id="vanta-login-bg"
                data-vanta-login
                aria-hidden="true"
                class="pointer-events-none fixed inset-0 z-0 opacity-0 transition-opacity duration-500"
            ></div>
        @endif

        <main class="relative z-10 flex min-h-screen flex-col justify-center px-5 py-12 sm:px-8">
            {{ $slot }}
        </main>
    </body>
</html>

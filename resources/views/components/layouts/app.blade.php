@props(['title' => null])

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
    <body class="relative flex min-h-screen flex-col bg-[#151824] text-[#F3F5FC] antialiased">
        <div aria-hidden="true" class="crt-scanlines pointer-events-none fixed inset-0 z-40"></div>

        <x-navbar />

        <main class="relative z-10 flex-1 py-8 sm:py-12">
            <div class="feline-container">
                <x-flash-status />
                {{ $slot }}
            </div>
        </main>

        <footer class="relative z-10 border-t-2 border-[#0B0D14] bg-[#121521] py-6 text-xs text-[#9FA8C7]">
            <div class="feline-container flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-3">
                    <x-pixel-icon name="cat-logo" class="h-5 w-5" />
                    <span class="font-display text-xs tracking-[0.18em] text-[#F3F5FC]">FELINE</span>
                </div>
                <span class="flex items-center gap-2 text-xs">
                    <x-pixel-icon name="heart" class="h-3.5 w-3.5" />
                    <span>Galeri kucing santai.</span>
                </span>
            </div>
        </footer>

        @if (auth()->user()?->isAdmin())
            <x-delete-modal />
        @endif
    </body>
</html>

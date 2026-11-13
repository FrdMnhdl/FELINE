<x-layouts.guest title="Akses Dibatasi">
    <div class="pixel-box mx-auto w-full max-w-lg overflow-hidden">
        <div class="pixel-titlebar-accent">
            <span class="flex items-center gap-2 text-[#FF5D73]">
                <x-pixel-icon name="lock" class="h-4 w-4" />
                <span>ERROR 403</span>
            </span>
        </div>

        <div class="p-7 sm:p-10">
            <div class="mb-5 flex h-14 w-14 items-center justify-center border-2 border-[#0B0D14] bg-[#3C1D29] shadow-[3px_3px_0_#090B12]">
                <x-pixel-icon name="lock" class="h-8 w-8" />
            </div>

            <h1 class="font-display text-xl leading-snug tracking-tight text-[#F3F5FC] sm:text-2xl">
                Waduh, aksesnya dibatasi nih
            </h1>

            <p class="mt-3 text-sm leading-relaxed text-[#9FA8C7]">
                Akun kamu nggak punya izin buat buka halaman khusus kurator ini.
            </p>

            <div class="mt-7 flex flex-wrap items-center gap-3 border-t-2 border-[#2E3654] pt-6">
                @auth
                    <a href="{{ route('cats.index') }}" class="feline-btn-primary">
                        Balik ke Koleksi Kucing
                    </a>
                @else
                    <a href="{{ route('login') }}" class="feline-btn-primary">
                        Ke Halaman Login
                    </a>
                @endauth
            </div>
        </div>
    </div>
</x-layouts.guest>

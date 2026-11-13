<x-layouts.guest title="Halaman Nggak Ketemu">
    <div class="pixel-box mx-auto w-full max-w-lg overflow-hidden">
        <div class="pixel-titlebar-accent">
            <span class="flex items-center gap-2 text-[#FFD166]">
                <x-pixel-icon name="star" class="h-4 w-4" />
                <span>ERROR 404</span>
            </span>
        </div>

        <div class="p-7 sm:p-10">
            <div class="mb-5 flex h-16 w-16 items-center justify-center border-2 border-[#0B0D14] bg-[#121521] shadow-[3px_3px_0_#090B12]">
                <x-pixel-icon name="cat-confused" class="h-10 w-10" />
            </div>

            <h1 class="font-display text-xl leading-snug tracking-tight text-[#F3F5FC] sm:text-2xl">
                Halaman nggak ketemu
            </h1>

            <p class="mt-3 text-sm leading-relaxed text-[#9FA8C7]">
                Halaman galeri atau profil kucing yang kamu cari kayaknya udah pindah atau nggak ada nih.
            </p>

            <div class="mt-7 flex flex-wrap items-center gap-3 border-t-2 border-[#2E3654] pt-6">
                @auth
                    <a
                        href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('cats.index') }}"
                        class="feline-btn-primary"
                    >
                        Balik ke Galeri
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

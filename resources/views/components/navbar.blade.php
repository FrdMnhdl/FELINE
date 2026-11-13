@php
    $user = auth()->user();
    $isAdmin = $user?->isAdmin() ?? false;
    $homeRoute = $isAdmin ? route('admin.dashboard') : route('cats.index');
@endphp

<header class="sticky top-0 z-30 border-b-2 border-[#0B0D14] bg-[#191E30]/95 shadow-[0_4px_0_#090B12] backdrop-blur-xs">
    <div class="feline-container flex h-[68px] items-center justify-between gap-4">
        <a
            href="{{ $homeRoute }}"
            class="group inline-flex items-center gap-3 text-[#F3F5FC] focus-visible:outline-none"
        >
            <span class="inline-flex h-10 w-10 items-center justify-center border-2 border-[#0B0D14] bg-[#282F48] shadow-[inset_2px_2px_0_#4B5785,2px_2px_0_#090B12] transition-transform duration-150 group-hover:-translate-x-0.5 group-hover:-translate-y-0.5 group-hover:border-[#5CE1E6]">
                <x-pixel-icon name="cat-logo" class="h-6 w-6" />
            </span>

            <span class="font-display text-sm tracking-[0.14em] text-[#F3F5FC] transition-colors group-hover:text-[#5CE1E6]">FELINE</span>
        </a>

        <nav aria-label="Navigasi utama" class="hidden items-center gap-5 lg:gap-6 sm:flex">
            @if ($isAdmin)
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center gap-2 border-b-2 py-1.5 font-pixel text-xs tracking-wider uppercase transition-colors {{ request()->routeIs('admin.dashboard') ? 'border-[#3CD070] text-[#3CD070]' : 'border-transparent text-[#9FA8C7] hover:text-[#5CE1E6]' }}"
                >
                    <x-pixel-icon name="console" class="h-4 w-4 shrink-0" />
                    <span>Beranda</span>
                </a>
            @endif

            <a
                href="{{ route('cats.index') }}"
                class="inline-flex items-center gap-2 border-b-2 py-1.5 font-pixel text-xs tracking-wider uppercase transition-colors {{ request()->routeIs('cats.*') ? 'border-[#5CE1E6] text-[#5CE1E6]' : 'border-transparent text-[#9FA8C7] hover:text-[#5CE1E6]' }}"
            >
                <x-pixel-icon name="gallery" class="h-4 w-4 shrink-0" />
                <span>Koleksi Kucing</span>
            </a>

            @if ($isAdmin)
                <a
                    href="{{ route('admin.cats.create') }}"
                    data-press-feedback
                    class="inline-flex items-center gap-1.5 border-2 border-[#0B0D14] px-3.5 py-1.5 font-pixel text-xs font-bold tracking-wider uppercase shadow-[2px_2px_0_#090B12] transition-[background-color,box-shadow] duration-150 hover:-translate-x-0.5 hover:-translate-y-0.5 {{ request()->routeIs('admin.cats.create') ? 'bg-[#5CE1E6] text-[#0B0D14]' : 'bg-[#3CD070] text-[#0B0D14] hover:bg-[#52E585]' }}"
                >
                    <x-pixel-icon name="plus-cart" class="h-3.5 w-3.5" />
                    <span>Tambah</span>
                </a>
            @endif

            <div class="flex items-center gap-3 border-l-2 border-[#2E3654] pl-5">
                @if ($isAdmin)
                    <span class="pixel-tag-gold">
                        <x-pixel-icon name="crown" class="h-3.5 w-3.5" />
                        <span>KURATOR</span>
                    </span>
                @else
                    <span class="pixel-tag">
                        <x-pixel-icon name="heart" class="h-3.5 w-3.5" />
                        <span>PENGUNJUNG</span>
                    </span>
                @endif

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button
                        type="submit"
                        class="inline-flex cursor-pointer items-center gap-1.5 font-pixel text-xs tracking-wider text-[#9FA8C7] uppercase transition-colors hover:text-[#FF5D73]"
                    >
                        <x-pixel-icon name="logout" class="h-3.5 w-3.5" />
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </nav>

        <button
            type="button"
            data-mobile-nav-toggle
            aria-expanded="false"
            aria-controls="mobile-nav-drawer"
            aria-label="Buka menu navigasi"
            class="inline-flex h-10 w-10 cursor-pointer items-center justify-center border-2 border-[#0B0D14] bg-[#282F48] text-[#F3F5FC] shadow-[2px_2px_0_#090B12] sm:hidden"
        >
            <x-pixel-icon name="menu" class="h-5 w-5" />
        </button>
    </div>

    <div
        id="mobile-nav-drawer"
        data-mobile-nav-drawer
        class="hidden border-t-2 border-[#0B0D14] bg-[#1E2336] px-5 py-4 sm:hidden"
    >
        <nav aria-label="Navigasi mobile" class="flex flex-col gap-3">
            @if ($isAdmin)
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center gap-2 py-1 font-pixel text-xs tracking-wider uppercase {{ request()->routeIs('admin.dashboard') ? 'text-[#3CD070]' : 'text-[#F3F5FC]' }}"
                >
                    <x-pixel-icon name="console" class="h-4 w-4" />
                    <span>Beranda</span>
                </a>
            @endif

            <a
                href="{{ route('cats.index') }}"
                class="inline-flex items-center gap-2 py-1 font-pixel text-xs tracking-wider uppercase {{ request()->routeIs('cats.*') ? 'text-[#5CE1E6]' : 'text-[#F3F5FC]' }}"
            >
                <x-pixel-icon name="gallery" class="h-4 w-4" />
                <span>Koleksi Kucing</span>
            </a>

            @if ($isAdmin)
                <a
                    href="{{ route('admin.cats.create') }}"
                    class="inline-flex items-center gap-2 py-1 font-pixel text-xs tracking-wider uppercase {{ request()->routeIs('admin.cats.create') ? 'text-[#3CD070]' : 'text-[#FFD166]' }}"
                >
                    <x-pixel-icon name="plus-cart" class="h-4 w-4" />
                    <span>Tambah Kucing</span>
                </a>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="mt-1 border-t-2 border-[#2E3654] pt-3">
                @csrf
                <button
                    type="submit"
                    class="inline-flex w-full cursor-pointer items-center gap-2 py-1 text-left font-pixel text-xs tracking-wider text-[#FF5D73] uppercase"
                >
                    <x-pixel-icon name="logout" class="h-4 w-4" />
                    <span>Keluar Akun</span>
                </button>
            </form>
        </nav>
    </div>
</header>

@php
    $isAdmin = auth()->user()?->isAdmin() ?? false;
@endphp

<x-layouts.app title="Koleksi Kucing">
    <div
        data-animate="hero"
        class="pixel-box mb-10 flex flex-col justify-between gap-6 p-6 sm:flex-row sm:items-center sm:p-8"
    >
        <div>
            <h1 class="font-display text-2xl leading-snug tracking-tight text-[#F3F5FC] sm:text-3xl">
                Koleksi Kucing
            </h1>
            <p class="mt-2 text-sm text-[#9FA8C7]">
                @if ($cats->total() > 0)
                    {{ $cats->total() }} kucing yang lagi tampil di galeri.
                @else
                    Belum ada kucing yang dipajang saat ini.
                @endif
            </p>
        </div>

        @if ($isAdmin)
            <a
                href="{{ route('admin.cats.create') }}"
                data-press-feedback
                class="feline-btn-primary self-start sm:self-auto"
            >
                <x-pixel-icon name="plus-cart" class="h-3.5 w-3.5" />
                <span>Tambah Kucing</span>
            </a>
        @endif
    </div>

    @if ($cats->isEmpty())
        <x-empty-state :is-admin="$isAdmin" />
    @else
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($cats as $cat)
                <x-cat-card :cat="$cat" :is-admin="$isAdmin" return-to="gallery" />
            @endforeach
        </div>

        @if ($cats->hasPages())
            <nav aria-label="Halaman koleksi" class="mt-12 border-t-2 border-[#2E3654] pt-8">
                {{ $cats->links('vendor.pagination.feline') }}
            </nav>
        @endif
    @endif
</x-layouts.app>

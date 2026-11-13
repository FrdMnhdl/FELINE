<x-layouts.app title="Beranda Kurator">
    <section
        data-animate="hero"
        class="pixel-box-hero overflow-hidden px-6 py-8 sm:px-9 sm:py-10"
    >
        <div class="flex flex-col justify-between gap-8 lg:flex-row lg:items-center">
            <div class="flex items-center gap-5">
                <div class="hidden h-20 w-20 shrink-0 items-center justify-center border-2 border-[#0B0D14] bg-[#121521] shadow-[inset_2px_2px_0_#3E486E,4px_4px_0_#090B12] sm:flex">
                    <x-pixel-icon name="cat-hero" class="h-14 w-14" />
                </div>

                <div>
                    <h1 class="font-display text-2xl leading-snug tracking-tight text-[#F3F5FC] sm:text-3xl">
                        Arsip FELINE
                    </h1>
                    <p class="mt-2.5 max-w-md text-sm leading-relaxed text-[#9FA8C7]">
                        Kelola koleksi kucing yang tampil di galeri.
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-4 border-t-2 border-[#2E3654] pt-6 lg:border-t-0 lg:pt-0">
                <div class="border-2 border-[#FFD166] bg-[#121521] px-5 py-3 shadow-[4px_4px_0_#090B12]">
                    <span class="flex items-center gap-1.5 font-pixel text-[10px] tracking-[0.16em] text-[#9FA8C7] uppercase">
                        <x-pixel-icon name="star" class="h-3 w-3" />
                        <span>Total Kucing</span>
                    </span>
                    <span class="mt-1.5 block font-display text-3xl leading-none text-[#FFD166]">
                        {{ str_pad((string) $totalCats, 2, '0', STR_PAD_LEFT) }}
                    </span>
                </div>

                <a
                    href="{{ route('admin.cats.create') }}"
                    data-press-feedback
                    class="feline-btn-primary"
                >
                    <x-pixel-icon name="plus-cart" class="h-3.5 w-3.5" />
                    <span>Tambah Kucing</span>
                </a>
            </div>
        </div>
    </section>

    <div class="pixel-divider my-10" aria-hidden="true"></div>

    <section>
        <div data-animate="fade" class="mb-7 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <h2 class="font-display text-lg text-[#F3F5FC] sm:text-xl">
                Terbaru
            </h2>

            @if ($totalCats > 0)
                <a
                    href="{{ route('cats.index') }}"
                    class="feline-btn-ghost self-start sm:self-auto"
                >
                    Lihat Semua &rarr;
                </a>
            @endif
        </div>

        @if ($recentCats->isEmpty())
            <x-empty-state :is-admin="true" />
        @else
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($recentCats as $cat)
                    <x-cat-card :cat="$cat" :is-admin="true" return-to="dashboard" />
                @endforeach
            </div>
        @endif
    </section>
</x-layouts.app>

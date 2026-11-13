@props([
    'cat',
    'isAdmin' => false,
    'returnTo' => 'gallery',
])

@php
    $isMale = $cat->gender === 'Jantan';
@endphp

<article
    data-animate="gallery-card"
    class="pixel-card group flex flex-col overflow-hidden"
>
    <div class="pixel-titlebar">
        <span class="flex items-center gap-2 text-[#5CE1E6]">
            <x-pixel-icon name="paw" class="h-3.5 w-3.5 text-[#3CD070]" />
            <span>#{{ str_pad((string) $cat->id, 2, '0', STR_PAD_LEFT) }}</span>
        </span>
        <span class="inline-flex items-center gap-1 border px-1.5 py-0.5 text-[10px] {{ $isMale ? 'border-[#5CE1E6]/60 bg-[#183146] text-[#5CE1E6]' : 'border-[#FF5D73]/60 bg-[#3C1D29] text-[#FF5D73]' }}">
            <x-pixel-icon :name="$isMale ? 'male' : 'female'" class="h-3 w-3" />
            <span>{{ $cat->gender }}</span>
        </span>
    </div>

    <a
        href="{{ route('cats.show', $cat) }}"
        class="block flex-1 focus-visible:outline-none"
    >
        <div class="relative aspect-[4/5] w-full overflow-hidden border-b-2 border-[#0B0D14] bg-[#121521]">
            <img
                src="{{ $cat->thumbnailUrl() }}"
                alt="{{ $cat->name }}, {{ $cat->breed }}"
                width="720"
                height="900"
                loading="lazy"
                decoding="async"
                data-animate="gallery-image"
                class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.03]"
            >
            <span
                aria-hidden="true"
                class="absolute right-3 bottom-3 border border-[#0B0D14] bg-[#151824]/90 px-2 py-0.5 font-pixel text-[10px] text-[#FFD166] opacity-0 transition-opacity duration-150 group-hover:opacity-100"
            >
                ▶ LIHAT
            </span>
        </div>

        <div class="p-5 sm:p-6">
            <div class="flex items-baseline justify-between gap-3">
                <h2 class="font-pixel text-xl font-bold tracking-tight text-[#F3F5FC] transition-colors duration-150 group-hover:text-[#5CE1E6]">
                    {{ $cat->name }}
                </h2>
                <span class="inline-flex items-center gap-1 font-pixel text-[11px] text-[#FFD166] uppercase">
                    <x-pixel-icon name="hourglass" class="h-3 w-3" />
                    <span>{{ $cat->age }}</span>
                </span>
            </div>

            <p class="mt-2.5 flex items-center gap-2 text-xs leading-relaxed text-[#9FA8C7]">
                <x-pixel-icon name="tag" class="h-3.5 w-3.5 shrink-0" />
                <span>{{ $cat->breed }}</span>
            </p>
        </div>
    </a>

    @if ($isAdmin)
        <div class="flex items-center justify-between border-t-2 border-[#0B0D14] bg-[#161A29] px-5 py-3 text-xs sm:px-6">
            <a
                href="{{ route('admin.cats.edit', $cat) }}"
                class="inline-flex items-center gap-1.5 border border-[#46507A] bg-[#242A42] px-2.5 py-1 font-pixel text-[11px] tracking-wider text-[#FFD166] uppercase shadow-[2px_2px_0_#090B12] transition-colors hover:border-[#FFD166] hover:bg-[#352B19]"
            >
                <x-pixel-icon name="pencil" class="h-3 w-3" />
                <span>Edit</span>
            </a>

            <button
                type="button"
                data-delete-trigger
                data-delete-url="{{ route('admin.cats.destroy', $cat) }}"
                data-cat-name="{{ $cat->name }}"
                data-return-to="{{ $returnTo }}"
                class="inline-flex cursor-pointer items-center gap-1.5 border border-[#46507A] bg-[#242A42] px-2.5 py-1 font-pixel text-[11px] tracking-wider text-[#FF5D73] uppercase shadow-[2px_2px_0_#090B12] transition-colors hover:border-[#FF5D73] hover:bg-[#3C1D29]"
            >
                <x-pixel-icon name="trash" class="h-3 w-3" />
                <span>Hapus</span>
            </button>
        </div>
    @endif
</article>

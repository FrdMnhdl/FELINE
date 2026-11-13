@php
    $isAdmin = auth()->user()?->isAdmin() ?? false;
    $isMale = $cat->gender === 'Jantan';
@endphp

<x-layouts.app title="{{ $cat->name }}">
    <div data-animate="hero" class="mb-8 flex items-center justify-between gap-4">
        <a
            href="{{ route('cats.index') }}"
            class="feline-btn-ghost inline-flex px-3.5 py-1.5"
        >
            <span aria-hidden="true">&larr;</span>
            <span>Balik ke Koleksi</span>
        </a>

        <span class="pixel-tag-gold">
            <x-pixel-icon name="paw" class="h-3 w-3" />
            <span>#{{ str_pad((string) $cat->id, 2, '0', STR_PAD_LEFT) }}</span>
        </span>
    </div>

    <article class="grid grid-cols-1 items-start gap-8 lg:grid-cols-12 lg:gap-10">
        <div class="lg:col-span-6">
            <div
                data-animate="detail-image"
                class="pixel-box overflow-hidden bg-[#121521]"
            >
                <img
                    src="{{ $cat->imageUrl() }}"
                    alt="{{ $cat->name }}, {{ $cat->breed }}"
                    width="900"
                    height="1125"
                    decoding="async"
                    class="aspect-[4/5] w-full object-cover"
                >
            </div>
        </div>

        <div class="lg:col-span-6">
            <div class="pixel-box overflow-hidden p-6 sm:p-8">
                <h1 data-animate="detail-item" class="font-display text-2xl leading-snug tracking-tight text-[#F3F5FC] sm:text-3xl">
                    {{ $cat->name }}
                </h1>

                <dl data-animate="detail-item" class="mt-6 divide-y-2 divide-[#2E3654] border-y-2 border-[#2E3654]">
                    <div class="flex items-center justify-between gap-4 py-3.5">
                        <dt class="flex items-center gap-2 font-pixel text-xs tracking-wider text-[#9FA8C7] uppercase">
                            <x-pixel-icon name="tag" class="h-3.5 w-3.5" />
                            <span>Ras</span>
                        </dt>
                        <dd class="text-sm font-bold text-[#F3F5FC]">{{ $cat->breed }}</dd>
                    </div>

                    <div class="flex items-center justify-between gap-4 py-3.5">
                        <dt class="flex items-center gap-2 font-pixel text-xs tracking-wider text-[#9FA8C7] uppercase">
                            <x-pixel-icon name="hourglass" class="h-3.5 w-3.5" />
                            <span>Umur</span>
                        </dt>
                        <dd class="text-sm font-bold text-[#FFD166]">{{ $cat->age }}</dd>
                    </div>

                    <div class="flex items-center justify-between gap-4 py-3.5">
                        <dt class="flex items-center gap-2 font-pixel text-xs tracking-wider text-[#9FA8C7] uppercase">
                            <x-pixel-icon name="heart" class="h-3.5 w-3.5" />
                            <span>Jenis Kelamin</span>
                        </dt>
                        <dd class="inline-flex items-center gap-1.5 text-sm font-bold {{ $isMale ? 'text-[#5CE1E6]' : 'text-[#FF5D73]' }}">
                            <x-pixel-icon :name="$isMale ? 'male' : 'female'" class="h-3.5 w-3.5" />
                            <span>{{ $cat->gender }}</span>
                        </dd>
                    </div>
                </dl>

                <div data-animate="detail-item" class="mt-6">
                    <h2 class="flex items-center gap-2 font-pixel text-xs tracking-wider text-[#5CE1E6] uppercase">
                        <x-pixel-icon name="chat" class="h-3.5 w-3.5" />
                        <span>Catatan</span>
                    </h2>
                    <p class="mt-3 text-sm leading-relaxed text-[#F3F5FC]/90">
                        {{ $cat->description }}
                    </p>
                </div>

                @if ($isAdmin)
                    <div data-animate="detail-item" class="mt-8 flex flex-wrap items-center gap-3 border-t-2 border-[#2E3654] pt-6">
                        <a
                            href="{{ route('admin.cats.edit', $cat) }}"
                            data-press-feedback
                            class="feline-btn-primary"
                        >
                            <x-pixel-icon name="pencil" class="h-3.5 w-3.5" />
                            <span>Edit Profil</span>
                        </a>

                        <button
                            type="button"
                            data-delete-trigger
                            data-delete-url="{{ route('admin.cats.destroy', $cat) }}"
                            data-cat-name="{{ $cat->name }}"
                            data-return-to="gallery"
                            class="feline-btn-danger cursor-pointer"
                        >
                            <x-pixel-icon name="trash" class="h-3.5 w-3.5" />
                            <span>Hapus</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </article>
</x-layouts.app>

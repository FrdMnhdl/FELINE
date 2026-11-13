<x-layouts.app title="Edit {{ $cat->name }}">
    <div data-animate="hero" class="mb-8 flex flex-col justify-between gap-4 border-b-2 border-[#2E3654] pb-6 sm:flex-row sm:items-end">
        <div>
            <a
                href="{{ route('cats.show', $cat) }}"
                class="feline-btn-ghost inline-flex px-3.5 py-1.5"
            >
                <span aria-hidden="true">&larr;</span>
                <span>Balik ke {{ $cat->name }}</span>
            </a>

            <h1 class="mt-5 font-display text-2xl leading-snug tracking-tight text-[#F3F5FC] sm:text-3xl">
                Edit {{ $cat->name }}
            </h1>
            <p class="mt-2 text-sm text-[#9FA8C7]">
                Ubah info profilnya atau ganti foto kucing yang sekarang tampil.
            </p>
        </div>

        <button
            type="button"
            data-delete-trigger
            data-delete-url="{{ route('admin.cats.destroy', $cat) }}"
            data-cat-name="{{ $cat->name }}"
            data-return-to="gallery"
            class="feline-btn-danger cursor-pointer self-start sm:self-auto"
        >
            <x-pixel-icon name="trash" class="h-3.5 w-3.5" />
            <span>Hapus Kucing</span>
        </button>
    </div>

    <div data-animate="fade">
        <x-cat-form
            :cat="$cat"
            :genders="$genders"
            :action="route('admin.cats.update', $cat)"
            method="PUT"
            submit-label="Simpan Perubahan"
            :cancel-url="route('cats.show', $cat)"
        />
    </div>
</x-layouts.app>

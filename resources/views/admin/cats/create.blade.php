<x-layouts.app title="Tambah Kucing">
    <div data-animate="hero" class="mb-8 border-b-2 border-[#2E3654] pb-6">
        <a
            href="{{ route('admin.dashboard') }}"
            class="feline-btn-ghost inline-flex px-3.5 py-1.5"
        >
            <span aria-hidden="true">&larr;</span>
            <span>Balik ke Beranda</span>
        </a>

        <h1 class="mt-5 font-display text-2xl leading-snug tracking-tight text-[#F3F5FC] sm:text-3xl">
            Tambah Kucing Baru
        </h1>
        <p class="mt-2 text-sm text-[#9FA8C7]">
            Upload foto terbaiknya lalu isi profil lengkap si anabul buat dipajang di galeri.
        </p>
    </div>

    <div data-animate="fade">
        <x-cat-form
            :genders="$genders"
            :action="route('admin.cats.store')"
            method="POST"
            submit-label="Simpan Kucing"
            :cancel-url="route('admin.dashboard')"
        />
    </div>
</x-layouts.app>

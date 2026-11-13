@props([
    'isAdmin' => false,
])

<div
    data-animate="fade"
    class="pixel-box overflow-hidden px-6 py-14 text-center sm:px-12"
>
    <div class="mx-auto mb-5 flex h-20 w-20 items-center justify-center border-2 border-[#0B0D14] bg-[#121521] shadow-[4px_4px_0_#090B12]">
        <x-pixel-icon name="cat-sleep" class="h-12 w-12" />
    </div>

    <h2 class="font-pixel text-xl font-bold text-[#F3F5FC]">
        Galerinya masih sepi nih
    </h2>

    <p class="mx-auto mt-2.5 max-w-md text-sm leading-relaxed text-[#9FA8C7]">
        @if ($isAdmin)
            Yuk mulai isi koleksinya dengan tambah foto dan profil kucing pertamamu.
        @else
            Belum ada foto kucing yang dipajang saat ini. Cek lagi nanti ya!
        @endif
    </p>

    @if ($isAdmin)
        <div class="mt-6">
            <a href="{{ route('admin.cats.create') }}" data-press-feedback class="feline-btn-primary">
                <x-pixel-icon name="plus-cart" class="h-3.5 w-3.5" />
                <span>Tambah Kucing</span>
            </a>
        </div>
    @endif
</div>

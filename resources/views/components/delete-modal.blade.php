<div
    data-delete-modal
    role="dialog"
    aria-modal="true"
    aria-labelledby="delete-modal-title"
    class="fixed inset-0 z-50 hidden flex items-center justify-center p-4"
>
    <div
        data-modal-backdrop
        class="fixed inset-0 bg-[#090B12]/80 backdrop-blur-[2px]"
    ></div>

    <div
        data-modal-panel
        class="pixel-box relative z-10 w-full max-w-md overflow-hidden"
    >
        <div class="pixel-titlebar-accent">
            <span class="flex items-center gap-2 text-[#FF5D73]">
                <x-pixel-icon name="trash" class="h-3.5 w-3.5" />
                <span>KONFIRMASI HAPUS</span>
            </span>
            <button
                type="button"
                data-modal-close
                aria-label="Tutup dialog"
                class="cursor-pointer text-[#9FA8C7] hover:text-[#FF5D73]"
            >
                [X]
            </button>
        </div>

        <div class="p-6 sm:p-7">
            <h2 id="delete-modal-title" class="font-pixel text-lg font-bold text-[#F3F5FC]">
                Yakin mau hapus <span class="text-[#FFD166]" data-modal-cat-name>kucing ini</span>?
            </h2>

            <p class="mt-3 text-sm leading-relaxed text-[#9FA8C7]">
                Profil kucing ini beserta file fotonya bakal dihapus permanen dari galeri FELINE lho.
            </p>

            <form method="POST" action="" data-modal-form class="mt-6 flex items-center justify-end gap-3 border-t-2 border-[#2E3654] pt-5">
                @csrf
                @method('DELETE')
                <input type="hidden" name="return_to" value="gallery" data-modal-return-to>

                <button
                    type="button"
                    data-modal-close
                    class="feline-btn-ghost cursor-pointer"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    data-modal-confirm
                    data-press-feedback
                    class="feline-btn-danger cursor-pointer"
                >
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

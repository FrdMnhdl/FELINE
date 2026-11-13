@if (session('status'))
    <div
        data-flash-banner
        role="status"
        class="mb-8 flex items-center justify-between gap-4 border-2 border-[#3CD070] bg-[#162E2A] px-4 py-3 text-sm text-[#F3F5FC] shadow-[4px_4px_0_#090B12]"
    >
        <div class="flex items-center gap-3">
            <span class="inline-flex h-6 w-6 shrink-0 items-center justify-center border border-[#0B0D14] bg-[#3CD070] text-[#0B0D14]" aria-hidden="true">
                <x-pixel-icon name="star" class="h-3.5 w-3.5" />
            </span>
            <span>{{ session('status') }}</span>
        </div>

        <button
            type="button"
            data-flash-dismiss
            aria-label="Tutup notifikasi"
            class="cursor-pointer border border-transparent px-2 py-1 font-pixel text-xs text-[#9FA8C7] transition-colors hover:border-[#3CD070] hover:bg-[#1E2336] hover:text-[#3CD070]"
        >
            [X]
        </button>
    </div>
@endif

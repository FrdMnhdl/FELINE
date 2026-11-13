@if ($paginator->hasPages())
    <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
        <p class="font-pixel text-xs tracking-wide text-[#9FA8C7]">
            Nampilin
            <span class="font-bold text-[#F3F5FC]">{{ $paginator->firstItem() }}</span>
            &ndash;
            <span class="font-bold text-[#F3F5FC]">{{ $paginator->lastItem() }}</span>
            dari
            <span class="font-bold text-[#5CE1E6]">{{ $paginator->total() }}</span>
            kucing
        </p>

        <div class="flex flex-wrap items-center gap-2">
            @if ($paginator->onFirstPage())
                <span class="inline-flex h-9 items-center border-2 border-[#2E3654] bg-[#191E30] px-3 font-pixel text-xs text-[#9FA8C7]/45 uppercase">
                    &lt; Sebelumnya
                </span>
            @else
                <a
                    href="{{ $paginator->previousPageUrl() }}"
                    rel="prev"
                    class="inline-flex h-9 items-center border-2 border-[#0B0D14] bg-[#242A42] px-3 font-pixel text-xs text-[#F3F5FC] uppercase shadow-[2px_2px_0_#090B12] transition-colors hover:border-[#5CE1E6] hover:text-[#5CE1E6]"
                >
                    &lt; Sebelumnya
                </a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="inline-flex h-9 w-9 items-center justify-center font-pixel text-xs text-[#9FA8C7]">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                aria-current="page"
                                class="inline-flex h-9 w-9 items-center justify-center border-2 border-[#0B0D14] bg-[#3CD070] font-pixel text-xs font-bold text-[#0B0D14] shadow-[2px_2px_0_#090B12]"
                            >
                                {{ $page }}
                            </span>
                        @else
                            <a
                                href="{{ $url }}"
                                class="inline-flex h-9 w-9 items-center justify-center border-2 border-[#0B0D14] bg-[#242A42] font-pixel text-xs text-[#F3F5FC] shadow-[2px_2px_0_#090B12] transition-colors hover:border-[#5CE1E6] hover:text-[#5CE1E6]"
                            >
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a
                    href="{{ $paginator->nextPageUrl() }}"
                    rel="next"
                    class="inline-flex h-9 items-center border-2 border-[#0B0D14] bg-[#242A42] px-3 font-pixel text-xs text-[#F3F5FC] uppercase shadow-[2px_2px_0_#090B12] transition-colors hover:border-[#5CE1E6] hover:text-[#5CE1E6]"
                >
                    Berikutnya &gt;
                </a>
            @else
                <span class="inline-flex h-9 items-center border-2 border-[#2E3654] bg-[#191E30] px-3 font-pixel text-xs text-[#9FA8C7]/45 uppercase">
                    Berikutnya &gt;
                </span>
            @endif
        </div>
    </div>
@endif

@props(['name'])

@switch($name)
    @case('cat-logo')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'none', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="2" y="1" width="2" height="4" fill="#0B0D14" />
            <rect x="12" y="1" width="2" height="4" fill="#0B0D14" />
            <rect x="4" y="3" width="2" height="2" fill="#0B0D14" />
            <rect x="10" y="3" width="2" height="2" fill="#0B0D14" />
            <rect x="6" y="4" width="4" height="1" fill="#0B0D14" />
            <rect x="3" y="2" width="1" height="3" fill="#FF5D73" />
            <rect x="12" y="2" width="1" height="3" fill="#FF5D73" />
            <rect x="2" y="5" width="12" height="7" fill="#F3F5FC" />
            <rect x="1" y="6" width="1" height="5" fill="#0B0D14" />
            <rect x="14" y="6" width="1" height="5" fill="#0B0D14" />
            <rect x="2" y="12" width="12" height="1" fill="#F3F5FC" />
            <rect x="3" y="13" width="10" height="1" fill="#0B0D14" />
            <rect x="2" y="5" width="3" height="2" fill="#3CD070" />
            <rect x="11" y="5" width="3" height="2" fill="#3CD070" />
            <rect x="4" y="8" width="2" height="2" fill="#5CE1E6" />
            <rect x="5" y="8" width="1" height="2" fill="#0B0D14" />
            <rect x="10" y="8" width="2" height="2" fill="#5CE1E6" />
            <rect x="10" y="8" width="1" height="2" fill="#0B0D14" />
            <rect x="7" y="10" width="2" height="1" fill="#FF5D73" />
            <rect x="5" y="11" width="6" height="1" fill="#FFD166" />
        </svg>
        @break

    @case('cat-hero')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            {{-- Ears --}}
            <rect x="5" y="2" width="2" height="4" fill="#0B0D14" />
            <rect x="13" y="2" width="2" height="4" fill="#0B0D14" />
            <rect x="6" y="3" width="2" height="3" fill="#FF5D73" />
            <rect x="12" y="3" width="2" height="3" fill="#FF5D73" />
            <rect x="7" y="4" width="6" height="1" fill="#0B0D14" />
            {{-- Head --}}
            <rect x="4" y="6" width="1" height="5" fill="#0B0D14" />
            <rect x="15" y="6" width="1" height="5" fill="#0B0D14" />
            <rect x="5" y="5" width="10" height="7" fill="#F3F5FC" />
            <rect x="7" y="5" width="6" height="2" fill="#9FA8C7" />
            <rect x="6" y="8" width="2" height="2" fill="#0B0D14" />
            <rect x="12" y="8" width="2" height="2" fill="#0B0D14" />
            <rect x="6" y="8" width="1" height="1" fill="#5CE1E6" />
            <rect x="12" y="8" width="1" height="1" fill="#5CE1E6" />
            <rect x="9" y="10" width="2" height="1" fill="#FF5D73" />
            {{-- Collar & Bell --}}
            <rect x="5" y="12" width="10" height="1" fill="#5CE1E6" />
            <rect x="9" y="13" width="2" height="2" fill="#FFD166" />
            {{-- Body --}}
            <rect x="4" y="13" width="1" height="7" fill="#0B0D14" />
            <rect x="15" y="13" width="1" height="7" fill="#0B0D14" />
            <rect x="5" y="13" width="10" height="7" fill="#F3F5FC" />
            <rect x="9" y="15" width="2" height="5" fill="#DCE2F5" />
            <rect x="5" y="20" width="10" height="1" fill="#0B0D14" />
            {{-- Tail --}}
            <rect x="16" y="17" width="3" height="2" fill="#F3F5FC" />
            <rect x="18" y="13" width="2" height="5" fill="#F3F5FC" />
            <rect x="17" y="11" width="2" height="2" fill="#3CD070" />
            {{-- Spark --}}
            <rect x="19" y="5" width="1" height="3" fill="#FFD166" />
            <rect x="18" y="6" width="3" height="1" fill="#FFD166" />
        </svg>
        @break

    @case('cat-sleep')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            {{-- Zzz --}}
            <rect x="15" y="3" width="4" height="1" fill="#5CE1E6" />
            <rect x="17" y="4" width="1" height="1" fill="#5CE1E6" />
            <rect x="16" y="5" width="1" height="1" fill="#5CE1E6" />
            <rect x="15" y="6" width="4" height="1" fill="#5CE1E6" />
            <rect x="19" y="7" width="3" height="1" fill="#FFD166" />
            <rect x="20" y="8" width="1" height="1" fill="#FFD166" />
            <rect x="19" y="9" width="3" height="1" fill="#FFD166" />
            {{-- Sleeping Loaf --}}
            <rect x="4" y="10" width="2" height="3" fill="#0B0D14" />
            <rect x="12" y="10" width="2" height="3" fill="#0B0D14" />
            <rect x="5" y="11" width="1" height="2" fill="#FF5D73" />
            <rect x="12" y="11" width="1" height="2" fill="#FF5D73" />
            <rect x="4" y="13" width="14" height="6" fill="#F3F5FC" />
            <rect x="3" y="14" width="1" height="4" fill="#0B0D14" />
            <rect x="18" y="14" width="1" height="4" fill="#0B0D14" />
            <rect x="4" y="19" width="14" height="1" fill="#0B0D14" />
            <rect x="6" y="15" width="2" height="1" fill="#0B0D14" />
            <rect x="10" y="15" width="2" height="1" fill="#0B0D14" />
            <rect x="8" y="16" width="2" height="1" fill="#FF5D73" />
            <rect x="14" y="17" width="4" height="2" fill="#5CE1E6" />
        </svg>
        @break

    @case('cat-confused')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            {{-- Question mark --}}
            <rect x="16" y="2" width="4" height="1" fill="#FFD166" />
            <rect x="19" y="3" width="1" height="2" fill="#FFD166" />
            <rect x="17" y="5" width="2" height="2" fill="#FFD166" />
            <rect x="17" y="8" width="2" height="1" fill="#FFD166" />
            {{-- Cat face --}}
            <rect x="4" y="7" width="2" height="3" fill="#0B0D14" />
            <rect x="12" y="7" width="2" height="3" fill="#0B0D14" />
            <rect x="5" y="8" width="1" height="2" fill="#FF5D73" />
            <rect x="12" y="8" width="1" height="2" fill="#FF5D73" />
            <rect x="4" y="10" width="10" height="8" fill="#F3F5FC" />
            <rect x="3" y="11" width="1" height="6" fill="#0B0D14" />
            <rect x="14" y="11" width="1" height="6" fill="#0B0D14" />
            <rect x="4" y="18" width="10" height="1" fill="#0B0D14" />
            <rect x="6" y="13" width="2" height="2" fill="#5CE1E6" />
            <rect x="10" y="13" width="2" height="2" fill="#5CE1E6" />
            <rect x="8" y="15" width="2" height="1" fill="#FF5D73" />
            <rect x="7" y="17" width="4" height="1" fill="#3CD070" />
        </svg>
        @break

    @case('console')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'currentColor', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="2" y="4" width="12" height="8" fill="#282F48" />
            <rect x="1" y="5" width="1" height="6" />
            <rect x="14" y="5" width="1" height="6" />
            <rect x="2" y="3" width="12" height="1" />
            <rect x="2" y="12" width="12" height="1" />
            <rect x="4" y="6" width="1" height="4" fill="#F3F5FC" />
            <rect x="3" y="7" width="3" height="2" fill="#F3F5FC" />
            <rect x="10" y="8" width="2" height="2" fill="#3CD070" />
            <rect x="12" y="6" width="2" height="2" fill="#FF5D73" />
            <rect x="7" y="9" width="2" height="1" fill="#FFD166" />
        </svg>
        @break

    @case('gallery')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'none', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="2" y="2" width="5" height="5" fill="#5CE1E6" />
            <rect x="9" y="2" width="5" height="5" fill="#3CD070" />
            <rect x="2" y="9" width="5" height="5" fill="#FFD166" />
            <rect x="9" y="9" width="5" height="5" fill="#FF5D73" />
            <rect x="3" y="3" width="3" height="3" fill="#1E2336" />
            <rect x="10" y="3" width="3" height="3" fill="#1E2336" />
            <rect x="3" y="10" width="3" height="3" fill="#1E2336" />
            <rect x="10" y="10" width="3" height="3" fill="#1E2336" />
        </svg>
        @break

    @case('paw')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'currentColor', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="3" y="4" width="2" height="3" />
            <rect x="6" y="2" width="2" height="3" />
            <rect x="9" y="2" width="2" height="3" />
            <rect x="12" y="4" width="2" height="3" />
            <rect x="5" y="7" width="7" height="5" />
            <rect x="4" y="8" width="9" height="3" />
            <rect x="6" y="12" width="5" height="1" />
        </svg>
        @break

    @case('plus-cart')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'currentColor', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="7" y="3" width="2" height="10" />
            <rect x="3" y="7" width="10" height="2" />
        </svg>
        @break

    @case('crown')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'none', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="2" y="4" width="2" height="6" fill="#FFD166" />
            <rect x="7" y="2" width="2" height="8" fill="#FFD166" />
            <rect x="12" y="4" width="2" height="6" fill="#FFD166" />
            <rect x="4" y="6" width="3" height="4" fill="#FFD166" />
            <rect x="9" y="6" width="3" height="4" fill="#FFD166" />
            <rect x="2" y="10" width="12" height="2" fill="#FFD166" />
            <rect x="2" y="12" width="12" height="1" fill="#0B0D14" />
            <rect x="7" y="8" width="2" height="2" fill="#FF5D73" />
        </svg>
        @break

    @case('heart')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'none', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="3" y="3" width="3" height="2" fill="#FF5D73" />
            <rect x="10" y="3" width="3" height="2" fill="#FF5D73" />
            <rect x="2" y="4" width="5" height="4" fill="#FF5D73" />
            <rect x="9" y="4" width="5" height="4" fill="#FF5D73" />
            <rect x="7" y="5" width="2" height="6" fill="#FF5D73" />
            <rect x="3" y="8" width="10" height="2" fill="#FF5D73" />
            <rect x="5" y="10" width="6" height="2" fill="#FF5D73" />
            <rect x="7" y="12" width="2" height="1" fill="#FF5D73" />
            <rect x="4" y="5" width="1" height="2" fill="#F3F5FC" />
        </svg>
        @break

    @case('star')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'none', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="7" y="1" width="2" height="14" fill="#FFD166" />
            <rect x="5" y="4" width="6" height="6" fill="#FFD166" />
            <rect x="2" y="5" width="12" height="3" fill="#FFD166" />
            <rect x="4" y="10" width="3" height="3" fill="#FFD166" />
            <rect x="9" y="10" width="3" height="3" fill="#FFD166" />
            <rect x="7" y="5" width="1" height="2" fill="#F3F5FC" />
        </svg>
        @break

    @case('logout')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'currentColor', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="2" y="2" width="6" height="1" />
            <rect x="2" y="13" width="6" height="1" />
            <rect x="2" y="2" width="1" height="12" />
            <rect x="6" y="7" width="6" height="2" />
            <rect x="10" y="5" width="2" height="2" />
            <rect x="12" y="7" width="2" height="2" />
            <rect x="10" y="9" width="2" height="2" />
        </svg>
        @break

    @case('mail')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'none', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="1" y="3" width="14" height="10" fill="#282F48" />
            <rect x="1" y="3" width="14" height="1" fill="#5CE1E6" />
            <rect x="1" y="12" width="14" height="1" fill="#5CE1E6" />
            <rect x="1" y="3" width="1" height="10" fill="#5CE1E6" />
            <rect x="14" y="3" width="1" height="10" fill="#5CE1E6" />
            <rect x="2" y="5" width="2" height="1" fill="#5CE1E6" />
            <rect x="12" y="5" width="2" height="1" fill="#5CE1E6" />
            <rect x="4" y="6" width="2" height="1" fill="#5CE1E6" />
            <rect x="10" y="6" width="2" height="1" fill="#5CE1E6" />
            <rect x="6" y="7" width="4" height="1" fill="#5CE1E6" />
        </svg>
        @break

    @case('key')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'none', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="2" y="5" width="5" height="5" fill="#FFD166" />
            <rect x="3" y="6" width="3" height="3" fill="#1E2336" />
            <rect x="7" y="7" width="7" height="2" fill="#FFD166" />
            <rect x="10" y="9" width="1" height="2" fill="#FFD166" />
            <rect x="12" y="9" width="2" height="3" fill="#FFD166" />
        </svg>
        @break

    @case('lock')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'none', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="5" y="2" width="6" height="1" fill="#9FA8C7" />
            <rect x="4" y="3" width="2" height="4" fill="#9FA8C7" />
            <rect x="10" y="3" width="2" height="4" fill="#9FA8C7" />
            <rect x="3" y="7" width="10" height="7" fill="#FF5D73" />
            <rect x="7" y="9" width="2" height="3" fill="#0B0D14" />
        </svg>
        @break

    @case('eye-open')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'currentColor', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="4" y="4" width="8" height="1" />
            <rect x="2" y="5" width="2" height="1" />
            <rect x="12" y="5" width="2" height="1" />
            <rect x="1" y="6" width="1" height="4" />
            <rect x="14" y="6" width="1" height="4" />
            <rect x="2" y="10" width="2" height="1" />
            <rect x="12" y="10" width="2" height="1" />
            <rect x="4" y="11" width="8" height="1" />
            <rect x="6" y="6" width="4" height="4" fill="#5CE1E6" />
            <rect x="7" y="7" width="2" height="2" fill="#0B0D14" />
        </svg>
        @break

    @case('eye-closed')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'currentColor', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="2" y="7" width="3" height="2" />
            <rect x="5" y="9" width="6" height="2" />
            <rect x="11" y="7" width="3" height="2" />
            <rect x="3" y="11" width="1" height="2" />
            <rect x="7" y="11" width="2" height="2" />
            <rect x="12" y="11" width="1" height="2" />
        </svg>
        @break

    @case('camera')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'none', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="5" y="3" width="6" height="2" fill="#3CD070" />
            <rect x="2" y="5" width="12" height="8" fill="#F3F5FC" />
            <rect x="1" y="6" width="1" height="6" fill="#0B0D14" />
            <rect x="14" y="6" width="1" height="6" fill="#0B0D14" />
            <rect x="2" y="13" width="12" height="1" fill="#0B0D14" />
            <rect x="6" y="7" width="4" height="4" fill="#0B0D14" />
            <rect x="7" y="8" width="2" height="2" fill="#5CE1E6" />
            <rect x="11" y="6" width="2" height="1" fill="#FF5D73" />
        </svg>
        @break

    @case('pencil')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'none', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="11" y="2" width="3" height="3" fill="#FF5D73" />
            <rect x="9" y="4" width="3" height="3" fill="#FFD166" />
            <rect x="7" y="6" width="3" height="3" fill="#FFD166" />
            <rect x="5" y="8" width="3" height="3" fill="#FFD166" />
            <rect x="3" y="10" width="3" height="3" fill="#F3F5FC" />
            <rect x="2" y="12" width="2" height="2" fill="#5CE1E6" />
        </svg>
        @break

    @case('trash')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'none', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="5" y="2" width="6" height="1" fill="#FF5D73" />
            <rect x="3" y="3" width="10" height="2" fill="#FF5D73" />
            <rect x="4" y="6" width="8" height="8" fill="#9FA8C7" />
            <rect x="5" y="7" width="1" height="5" fill="#1E2336" />
            <rect x="7" y="7" width="2" height="5" fill="#1E2336" />
            <rect x="10" y="7" width="1" height="5" fill="#1E2336" />
        </svg>
        @break

    @case('tag')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'none', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="2" y="3" width="6" height="2" fill="#3CD070" />
            <rect x="2" y="5" width="8" height="2" fill="#3CD070" />
            <rect x="4" y="7" width="8" height="2" fill="#3CD070" />
            <rect x="6" y="9" width="8" height="2" fill="#3CD070" />
            <rect x="8" y="11" width="5" height="2" fill="#3CD070" />
            <rect x="4" y="4" width="2" height="2" fill="#1E2336" />
        </svg>
        @break

    @case('hourglass')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'none', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="3" y="2" width="10" height="1" fill="#FFD166" />
            <rect x="4" y="3" width="8" height="2" fill="#5CE1E6" />
            <rect x="5" y="5" width="6" height="2" fill="#FFD166" />
            <rect x="7" y="7" width="2" height="2" fill="#FFD166" />
            <rect x="5" y="9" width="6" height="2" fill="#5CE1E6" />
            <rect x="4" y="11" width="8" height="2" fill="#FFD166" />
            <rect x="3" y="13" width="10" height="1" fill="#FFD166" />
        </svg>
        @break

    @case('male')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'none', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="9" y="2" width="5" height="2" fill="#5CE1E6" />
            <rect x="12" y="4" width="2" height="3" fill="#5CE1E6" />
            <rect x="9" y="5" width="2" height="2" fill="#5CE1E6" />
            <rect x="4" y="6" width="5" height="2" fill="#5CE1E6" />
            <rect x="3" y="8" width="2" height="4" fill="#5CE1E6" />
            <rect x="8" y="8" width="2" height="4" fill="#5CE1E6" />
            <rect x="4" y="12" width="5" height="2" fill="#5CE1E6" />
        </svg>
        @break

    @case('female')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'none', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="5" y="2" width="6" height="2" fill="#FF5D73" />
            <rect x="4" y="4" width="2" height="3" fill="#FF5D73" />
            <rect x="10" y="4" width="2" height="3" fill="#FF5D73" />
            <rect x="5" y="7" width="6" height="2" fill="#FF5D73" />
            <rect x="7" y="9" width="2" height="5" fill="#FF5D73" />
            <rect x="5" y="11" width="6" height="2" fill="#FF5D73" />
        </svg>
        @break

    @case('chat')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'none', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="2" y="3" width="12" height="8" fill="#5CE1E6" />
            <rect x="3" y="4" width="10" height="6" fill="#1E2336" />
            <rect x="5" y="6" width="2" height="2" fill="#FFD166" />
            <rect x="8" y="6" width="2" height="2" fill="#3CD070" />
            <rect x="11" y="6" width="1" height="2" fill="#FF5D73" />
            <rect x="4" y="11" width="3" height="2" fill="#5CE1E6" />
            <rect x="4" y="13" width="2" height="1" fill="#5CE1E6" />
        </svg>
        @break

    @case('menu')
        <svg {{ $attributes->merge(['viewBox' => '0 0 16 16', 'fill' => 'currentColor', 'shape-rendering' => 'crispEdges', 'aria-hidden' => 'true']) }}>
            <rect x="2" y="3" width="12" height="2" />
            <rect x="2" y="7" width="12" height="2" fill="#5CE1E6" />
            <rect x="2" y="11" width="12" height="2" />
        </svg>
        @break
@endswitch


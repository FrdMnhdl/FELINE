<x-layouts.guest title="Masuk" :with-vanta="true">
    <div class="mx-auto w-full max-w-[440px]">
        <div
            data-animate="hero"
            class="pixel-box overflow-hidden bg-[#1E2336]/95 backdrop-blur-xs"
        >
            <div class="pixel-titlebar-accent">
                <div class="flex items-center gap-2">
                    <span class="inline-block h-2.5 w-2.5 bg-[#3CD070]" aria-hidden="true"></span>
                    <span class="inline-block h-2.5 w-2.5 bg-[#5CE1E6]" aria-hidden="true"></span>
                    <span class="inline-block h-2.5 w-2.5 bg-[#FFD166]" aria-hidden="true"></span>
                    <span class="ml-1 text-[#F3F5FC]">FELINE</span>
                </div>
            </div>

            <div class="p-7 sm:p-9">
                <div class="mb-7">
                    <span class="inline-flex h-14 w-14 items-center justify-center border-2 border-[#0B0D14] bg-[#121521] shadow-[inset_2px_2px_0_#3E486E,3px_3px_0_#090B12]">
                        <x-pixel-icon name="cat-hero" class="h-10 w-10" />
                    </span>

                    <h1 class="mt-5 font-display text-xl leading-snug tracking-tight text-[#F3F5FC] sm:text-2xl">
                        Masuk ke Galeri
                    </h1>
                    <p class="mt-2 text-xs leading-relaxed text-[#9FA8C7]">
                        Masuk pakai akun kamu buat lanjut.
                    </p>
                </div>

                @if ($errors->any())
                    <div
                        data-validation-alert
                        role="alert"
                        class="mb-6 border-2 border-[#FF5D73] bg-[#3C1D29] px-4 py-3 text-xs leading-relaxed text-[#FFD2D9] shadow-[3px_3px_0_#090B12]"
                    >
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.store') }}" data-login-form class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="mb-2 flex items-center gap-2 font-pixel text-xs tracking-[0.12em] text-[#5CE1E6] uppercase">
                            <x-pixel-icon name="mail" class="h-3.5 w-3.5" />
                            <span>Email</span>
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            autofocus
                            required
                            placeholder="kamu@contoh.com"
                            class="feline-input @error('email') feline-input-error @enderror"
                        >
                    </div>

                    <div>
                        <label for="password" class="mb-2 flex items-center gap-2 font-pixel text-xs tracking-[0.12em] text-[#FFD166] uppercase">
                            <x-pixel-icon name="key" class="h-3.5 w-3.5" />
                            <span>Password</span>
                        </label>
                        <div class="relative">
                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                required
                                data-password-input
                                placeholder="Masukkan password kamu"
                                class="feline-input pr-12 @error('password') feline-input-error @enderror"
                            >
                            <button
                                type="button"
                                data-password-toggle
                                aria-label="Lihat password"
                                aria-pressed="false"
                                class="absolute inset-y-0 right-0 flex cursor-pointer items-center px-3.5 text-[#9FA8C7] transition-colors hover:text-[#5CE1E6]"
                            >
                                <span data-eye-show>
                                    <x-pixel-icon name="eye-open" class="h-4 w-4" />
                                </span>
                                <span data-eye-hide class="hidden">
                                    <x-pixel-icon name="eye-closed" class="h-4 w-4" />
                                </span>
                            </button>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button
                            type="submit"
                            data-submit-btn
                            data-press-feedback
                            class="feline-btn-primary w-full cursor-pointer py-3"
                        >
                            <svg
                                data-submit-spinner
                                class="hidden h-4 w-4 animate-spin"
                                viewBox="0 0 24 24"
                                fill="none"
                                aria-hidden="true"
                            >
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"></circle>
                                <path class="opacity-90" fill="currentColor" d="M4 12a8 8 0 018-8v3a5 5 0 00-5 5H4z"></path>
                            </svg>
                            <span data-submit-label>Masuk</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.guest>

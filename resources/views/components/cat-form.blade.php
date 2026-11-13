@props([
    'cat' => null,
    'genders' => ['Jantan', 'Betina'],
    'action',
    'method' => 'POST',
    'submitLabel' => 'Simpan Kucing',
    'cancelUrl' => null,
])

@php
    $isEditing = $cat !== null;
    $cancelHref = $cancelUrl ?? ($isEditing ? route('cats.show', $cat) : route('admin.dashboard'));
    $selectedGender = old('gender', $cat?->gender ?? $genders[0]);
@endphp

<form
    method="POST"
    action="{{ $action }}"
    enctype="multipart/form-data"
    class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:gap-10"
>
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="lg:col-span-5" data-upload-root>
        <div class="pixel-box overflow-hidden p-4">
                <label for="cat-image" class="sr-only">
                    Foto kucing {{ $isEditing ? '(opsional kalau mau ganti)' : '' }}
                </label>

                <div
                    data-upload-dropzone
                    class="relative aspect-[4/5] w-full overflow-hidden border-2 border-dashed {{ $errors->has('image') ? 'border-[#FF5D73]' : 'border-[#46507A]' }} bg-[#121521] transition-colors duration-150"
                >
                    <img
                        src="{{ $isEditing ? $cat->imageUrl() : '' }}"
                        alt="{{ $isEditing ? 'Foto '.$cat->name.' saat ini' : 'Preview foto kucing yang dipilih' }}"
                        data-upload-preview
                        class="{{ $isEditing ? '' : 'hidden' }} h-full w-full object-cover"
                    >

                    <div
                        data-upload-placeholder
                        class="{{ $isEditing ? 'hidden' : 'flex' }} h-full w-full flex-col items-center justify-center px-6 text-center"
                    >
                        <div class="mb-4 flex h-16 w-16 items-center justify-center border-2 border-[#0B0D14] bg-[#282F48] shadow-[inset_2px_2px_0_#4B5785,3px_3px_0_#090B12]">
                            <x-pixel-icon name="camera" class="h-8 w-8" />
                        </div>
                        <p class="font-pixel text-xs font-bold tracking-wider text-[#F3F5FC] uppercase">
                            Taruh foto di sini aja
                        </p>
                        <p class="mt-2 text-xs leading-relaxed text-[#9FA8C7]">
                            Format JPEG, PNG, atau WebP &middot; Maks 2 MB &middot; Min 200&times;200px
                        </p>
                    </div>

                    <label
                        for="cat-image"
                        class="absolute inset-x-3 bottom-3 flex cursor-pointer items-center justify-center gap-2 border-2 border-[#0B0D14] bg-[#242A42] px-4 py-2.5 font-pixel text-xs tracking-wider text-[#F3F5FC] uppercase shadow-[3px_3px_0_#090B12] transition-colors hover:border-[#5CE1E6] hover:bg-[#183146] hover:text-[#5CE1E6]"
                    >
                        <x-pixel-icon name="camera" class="h-3.5 w-3.5" />
                        <span>{{ $isEditing ? 'Ganti Foto' : 'Pilih Foto' }}</span>
                    </label>

                    <input
                        id="cat-image"
                        name="image"
                        type="file"
                        accept="image/jpeg,image/png,image/webp"
                        data-upload-input
                        class="sr-only"
                        {{ $isEditing ? '' : 'required' }}
                    >
                </div>

                <p data-upload-meta class="mt-3 text-xs leading-relaxed text-[#9FA8C7]">
                    {{ $isEditing ? 'Kosongin aja kalau masih mau pakai foto yang lama.' : 'Foto rasio potret (4:5) paling pas dipajang di galeri.' }}
                </p>

                <p data-upload-client-error role="alert" class="mt-2 hidden text-xs text-[#FF5D73]"></p>

            @error('image')
                <p role="alert" class="mt-2 text-xs text-[#FF5D73]">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="lg:col-span-7">
        <div class="pixel-box space-y-5 overflow-hidden p-6 sm:p-7">
                @if ($errors->any())
                    <div
                        data-validation-alert
                        role="alert"
                        class="border-2 border-[#FF5D73] bg-[#3C1D29] px-4 py-3 text-xs leading-relaxed text-[#FFD2D9]"
                    >
                        Cek lagi ya, masih ada isian yang belum beres sebelum disimpan.
                    </div>
                @endif

                <div>
                    <label for="cat-name" class="mb-2 flex items-center gap-2 font-pixel text-xs tracking-[0.12em] text-[#F3F5FC] uppercase">
                        <x-pixel-icon name="star" class="h-3.5 w-3.5" />
                        <span>Nama Kucing</span>
                    </label>
                    <input
                        id="cat-name"
                        name="name"
                        type="text"
                        value="{{ old('name', $cat?->name) }}"
                        placeholder="contoh: Miso"
                        maxlength="100"
                        required
                        class="feline-input @error('name') feline-input-error @enderror"
                    >
                    @error('name')
                        <p class="mt-1.5 text-xs text-[#FF5D73]">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="cat-breed" class="mb-2 flex items-center gap-2 font-pixel text-xs tracking-[0.12em] text-[#F3F5FC] uppercase">
                        <x-pixel-icon name="tag" class="h-3.5 w-3.5" />
                        <span>Ras</span>
                    </label>
                    <input
                        id="cat-breed"
                        name="breed"
                        type="text"
                        value="{{ old('breed', $cat?->breed) }}"
                        placeholder="contoh: Tabby Oren"
                        maxlength="100"
                        required
                        class="feline-input @error('breed') feline-input-error @enderror"
                    >
                    @error('breed')
                        <p class="mt-1.5 text-xs text-[#FF5D73]">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <div>
                        <label for="cat-age" class="mb-2 flex items-center gap-2 font-pixel text-xs tracking-[0.12em] text-[#F3F5FC] uppercase">
                            <x-pixel-icon name="hourglass" class="h-3.5 w-3.5" />
                            <span>Umur</span>
                        </label>
                        <input
                            id="cat-age"
                            name="age"
                            type="text"
                            value="{{ old('age', $cat?->age) }}"
                            placeholder="contoh: 2 tahun atau 8 bulan"
                            maxlength="50"
                            required
                            class="feline-input @error('age') feline-input-error @enderror"
                        >
                        @error('age')
                            <p class="mt-1.5 text-xs text-[#FF5D73]">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <span class="mb-2 flex items-center gap-2 font-pixel text-xs tracking-[0.12em] text-[#F3F5FC] uppercase">
                            <x-pixel-icon name="heart" class="h-3.5 w-3.5" />
                            <span>Jenis Kelamin</span>
                        </span>
                        <div class="grid grid-cols-2 gap-3">
                            @foreach ($genders as $genderOption)
                                @php $isMaleOption = $genderOption === 'Jantan'; @endphp
                                <label class="relative cursor-pointer">
                                    <input
                                        type="radio"
                                        name="gender"
                                        value="{{ $genderOption }}"
                                        {{ $selectedGender === $genderOption ? 'checked' : '' }}
                                        class="peer sr-only"
                                    >
                                    <span class="flex w-full items-center justify-center gap-1.5 border-2 border-[#0B0D14] bg-[#121521] px-4 py-2.5 font-pixel text-xs tracking-wider text-[#9FA8C7] uppercase shadow-[2px_2px_0_#2E3654] transition-all duration-150 peer-checked:border-[#5CE1E6] peer-checked:bg-[#183146] peer-checked:font-bold peer-checked:text-[#F3F5FC] peer-checked:shadow-[3px_3px_0_#5CE1E6] peer-focus-visible:ring-2 peer-focus-visible:ring-[#FFD166]">
                                        <x-pixel-icon :name="$isMaleOption ? 'male' : 'female'" class="h-3.5 w-3.5" />
                                        <span>{{ $genderOption }}</span>
                                    </span>
                                </label>
                            @endforeach
                        </div>
                        @error('gender')
                            <p class="mt-1.5 text-xs text-[#FF5D73]">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="cat-description" class="mb-2 flex items-center gap-2 font-pixel text-xs tracking-[0.12em] text-[#F3F5FC] uppercase">
                        <x-pixel-icon name="chat" class="h-3.5 w-3.5" />
                        <span>Cerita / Catatan</span>
                    </label>
                    <textarea
                        id="cat-description"
                        name="description"
                        rows="5"
                        maxlength="2000"
                        required
                        placeholder="Ceritain sifat lucunya, spot tidur favorit, atau kebiasaan unik si anabul..."
                        class="feline-input resize-y @error('description') feline-input-error @enderror"
                    >{{ old('description', $cat?->description) }}</textarea>
                    @error('description')
                        <p class="mt-1.5 text-xs text-[#FF5D73]">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-wrap items-center gap-3 border-t-2 border-[#2E3654] pt-5">
                    <button
                        type="submit"
                        data-cat-submit
                        data-press-feedback
                        class="feline-btn-primary cursor-pointer"
                    >
                        <span data-cat-submit-label>{{ $submitLabel }}</span>
                    </button>

                <a href="{{ $cancelHref }}" class="feline-btn-ghost">
                    Batal
                </a>
            </div>
        </div>
    </div>
</form>

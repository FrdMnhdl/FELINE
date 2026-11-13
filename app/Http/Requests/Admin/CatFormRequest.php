<?php

namespace App\Http\Requests\Admin;

use App\Models\Cat;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

abstract class CatFormRequest extends FormRequest
{
    /**
     * Determine if the authenticated user is authorized to submit this form request.
     */
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    /**
     * Get the shared cat validation rules with subclass-specific photograph constraints.
     *
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'breed' => ['required', 'string', 'max:100'],
            'age' => ['required', 'string', 'max:50'],
            'gender' => ['required', 'string', Rule::in(Cat::GENDERS)],
            'description' => ['required', 'string', 'max:2000'],
            'image' => $this->imageRules(),
        ];
    }

    /**
     * Get custom validation error messages for cat attributes.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama kucingnya belum diisi nih.',
            'name.max' => 'Nama kucingnya kepanjangan, maksimal 100 karakter ya.',
            'breed.required' => 'Ras kucingnya diisi dulu ya.',
            'breed.max' => 'Nama rasnya maksimal 100 karakter ya.',
            'age.required' => 'Umurnya jangan lupa diisi ya.',
            'age.max' => 'Keterangan umurnya maksimal 50 karakter ya.',
            'gender.required' => 'Pilih jenis kelamin kucingnya dulu ya.',
            'gender.in' => 'Pilihan jenis kelaminnya cuma Jantan atau Betina ya.',
            'description.required' => 'Cerita atau deskripsi kucingnya belum diisi nih.',
            'description.max' => 'Deskripsinya kepanjangan, maksimal 2000 karakter ya.',
            'image.required' => 'Pilih foto kucingnya dulu buat di-upload ya.',
            'image.image' => 'File yang di-upload harus berupa gambar yang valid ya.',
            'image.mimes' => 'Format fotonya harus JPEG, PNG, atau WebP ya.',
            'image.mimetypes' => 'Format fotonya harus JPEG, PNG, atau WebP ya.',
            'image.max' => 'Ukuran fotonya kegedean nih, maksimal 2 MB ya.',
            'image.dimensions' => 'Resolusi fotonya harus antara 200×200 sampai 6000×6000 piksel ya.',
        ];
    }

    /**
     * Define validation rules for the photograph upload field.
     *
     * @return array<int, mixed>
     */
    protected function baseImageRules(bool $required): array
    {
        return [
            $required ? 'required' : 'nullable',
            'file',
            'image',
            'mimes:jpeg,jpg,png,webp',
            'mimetypes:image/jpeg,image/png,image/webp',
            'max:2048',
            Rule::dimensions()->minWidth(200)->minHeight(200)->maxWidth(6000)->maxHeight(6000),
        ];
    }

    /**
     * Provide subclass-specific validation rules for the photograph upload.
     *
     * @return array<int, mixed>
     */
    abstract protected function imageRules(): array;
}

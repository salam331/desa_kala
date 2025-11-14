<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGaleriRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image_descriptions' => 'nullable|array',
            'image_descriptions.*' => 'nullable|string',
            'deskfoto_descriptions' => 'nullable|array',
            'deskfoto_descriptions.*' => 'nullable|string',
            'deskripsi_gambar' => 'nullable|array',
            'deskripsi_gambar.*' => 'nullable|string',
            'gambar' => 'nullable|array',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori' => 'required|in:kegiatan,pembangunan,event,panorama',
            'album' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'judul.required' => 'Judul galeri wajib diisi.',
            'judul.max' => 'Judul galeri maksimal 255 karakter.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'kategori.in' => 'Kategori tidak valid.',
            'album.required' => 'Album wajib diisi.',
            'album.max' => 'Album maksimal 255 karakter.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
        ];
    }
}

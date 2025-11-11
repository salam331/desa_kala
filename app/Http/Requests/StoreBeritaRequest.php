<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBeritaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
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
            'kategori' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'ringkasan' => 'required|string|max:500',
            'konten' => 'required|string',
            'gambar' => 'nullable|url',
            'gambar_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'judul.required' => 'Judul berita wajib diisi.',
            'judul.max' => 'Judul berita maksimal 255 karakter.',
            'kategori.required' => 'Kategori berita wajib diisi.',
            'tanggal.required' => 'Tanggal berita wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'ringkasan.required' => 'Ringkasan berita wajib diisi.',
            'ringkasan.max' => 'Ringkasan berita maksimal 500 karakter.',
            'konten.required' => 'Konten berita wajib diisi.',
            'gambar.max' => 'URL gambar maksimal 500 karakter.',
        ];
    }
}

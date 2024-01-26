<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BukuRequest extends FormRequest
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
            'kategori_id' => 'required',
            'penerbit_id' => 'required',
            'rak_id' => 'required',
            'judul' => 'required',
            'pengarang' => 'required',
            'stok' => 'required',
            // 'gambar' => 'required',
        ];
    }

    public function messages(){
        return [
            'kategori_id.required' => 'Kategori tidak boleh kosong',
            'penerbit_id.required' => 'Penerbit tidak boleh kosong',
            'rak_id.required' => 'Rak tidak boleh kosong',
            'judul.required' => 'Judul tidak boleh kosong',
            'pengarang.required' => 'Pengarang tidak boleh kosong',
            'stok.required' => 'Stok tidak boleh kosong',
            // 'gambar.required' => 'Gambar tidak boleh kosong',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KategoriRequest extends FormRequest
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
            'kode' => 'required|max:8',
            'nama' => 'required|max:15'
        ];
    }

    public function messages()
    {
        return [
            'kode.required' => 'Kode tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
            'kode.max' => 'Maksimal huruf atau angka kode adalah 8',
            'nama.max' => 'Maksimal huruf atau angka nama adalah 15'
        ];
    }
}

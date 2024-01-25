<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
            'username' => 'required|min:6|max:16',
            'nama' => 'required',
            'password' => 'required',
            'alamat' => 'required',
            'hp' => 'required',
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'hp.required' => 'HP tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
        ];
    }
}

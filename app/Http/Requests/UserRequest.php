<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ci' => 'required|numeric',
            'name' => 'required|string',
            'username' => 'required|string',
            'description' => 'required|string',
            'email' => 'required',
            'phone' => 'required|numeric',
            'password' => 'required|min:8|confirmed',
            'address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'password.confirmed' => 'Los campos de contraseña no coinciden.'
        ];
    }
}

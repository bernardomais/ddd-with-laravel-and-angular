<?php

namespace App\Application\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required| string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8'
        ];
    }
}

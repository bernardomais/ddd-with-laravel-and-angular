<?php

namespace App\Infrastructure\Validation;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class UserValidator
{
    public function validate(array $data): bool
    {
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8']
        ]);

        return $validator->passes();
    }
}

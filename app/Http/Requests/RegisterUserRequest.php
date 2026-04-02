<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' 		=> ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' 		=> ['required', 'confirmed', Password::defaults()],
            'firstname'    => ['required', 'string', 'max:30'],
            'lastname'     => ['required', 'string', 'max:30'],
        ];
    }
}

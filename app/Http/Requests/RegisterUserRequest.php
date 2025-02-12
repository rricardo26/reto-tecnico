<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5',
            'role' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!in_array($value, ['Super Admin', 'Vendedor'])) {
                        $fail("El rol solo puede ser Vendedor o Super Admin");
                    }
                }
            ]
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => "El :attribute es obligatorio",
            'email.email' => "El email tiene formato incorrecto",
            'password.min' => "Em password debe tener mínimo :min caracteres"
        ];
    }
}

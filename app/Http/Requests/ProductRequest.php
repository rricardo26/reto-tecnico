<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $method = Request::method();
        if ($method == 'POST') {
            $rules = [
                'sku' => 'required|unique:products,sku',
                'name' => 'required',
                'unit_price' => 'required|numeric|min:0',
                'stock' => 'required|numeric|min:0'
            ];
        } else {
            $rules = [
                'sku' => 'nullable|unique:products,sku',
                'name' => 'nullable',
                'unit_price' => 'nullable|numeric|min:0',
                'stock' => 'nullable|numeric|min:0'
            ];
        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            '*.required' => "El :attribute es obligatorio",
            'sku.unique' => "El sku debe ser único"
        ];
    }
}

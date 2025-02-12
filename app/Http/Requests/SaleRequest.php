<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
        // $request = $this->request->all();
        $productRepository = new ProductRepository;
        return [
            'client_id' => 'required|exists:clients,id',
            'datetime' => 'required',
            'products.*.quantity' => 'required|numeric',
            'products.*.product_id' => [
                'required',
                'exists:products,id',
                function ($attribute, $value, $fail) use ($productRepository) {
                    $index = explode('.', $attribute)[1];
                    $quantity = $this->request->all()["products"][$index]["quantity"];
                    $product = $productRepository->findById($value);
                    if ($product->stock - $quantity < 0) {
                        $fail("No hay suficiente stock de $product->name");
                    }
                }
            ]
        ];
    }
}

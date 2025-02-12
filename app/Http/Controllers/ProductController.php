<?php

namespace App\Http\Controllers;

use App\Traits\Responses;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    use Responses;
    
    public function __construct(private ProductRepository $productRepository) { }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productRepository->getAll();
        return $this->dataResponse($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = $this->productRepository->create($request->only(['sku', 'name', 'unit_price', 'stock']));
        return $this->successResponse('Exito al crear el producto', $product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $product = $this->productRepository->findById($id);
        return $this->dataResponse($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->productRepository->update($id, $request->all());
        return $this->successResponse('Exito al actualizar el producto');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->productRepository->deleteById($id);
        return $this->successResponse('Exito al eliminar el producto');
    }
}

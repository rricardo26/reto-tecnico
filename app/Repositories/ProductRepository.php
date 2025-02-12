<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Collection;
use App\Repositories\Interfaces\CRUDInterface;

class ProductRepository implements CRUDInterface
{
    public function getAll(): Collection
    {
        return Product::orderBy('created_at', 'desc')->get();
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $product = $this->findById($id);
        return $product->update($data);
    }

    public function findById(int $id): Product
    {
        return Product::find($id);
    }

    public function deleteById(int $id)
    {
        Product::destroy($id);
    }
}

<?php

namespace App\Repositories;

use App\Models\Sale;
use App\Models\SaleProduct;

class SaleProductRepository
{
    public function __construct(private Sale $sale) { }

    public function create(array $data): SaleProduct
    {
        $data['sale_id'] = $this->sale->id;
        return SaleProduct::create($data);
    }
}

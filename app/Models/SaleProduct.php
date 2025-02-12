<?php

namespace App\Models;

use App\Observers\SaleProductObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([SaleProductObserver::class])]
class SaleProduct extends Model
{
    protected $table = 'sales_products';
    protected $fillable = [
        'product_id',
        'sale_id',
        'product_quantity',
    ];
}

<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\SaleProduct;

class SaleProductObserver
{
    /**
     * Handle the SaleProduct "created" event.
     */
    public function created(SaleProduct $saleProduct): void
    { 
        $product = Product::find($saleProduct->product_id);
        $product->stock -= $saleProduct->product_quantity;
        $product->save();
    }

    /**
     * Handle the SaleProduct "updated" event.
     */
    public function updated(SaleProduct $saleProduct): void
    {
        //
    }

    /**
     * Handle the SaleProduct "deleted" event.
     */
    public function deleted(SaleProduct $saleProduct): void
    {
        //
    }

    /**
     * Handle the SaleProduct "restored" event.
     */
    public function restored(SaleProduct $saleProduct): void
    {
        //
    }

    /**
     * Handle the SaleProduct "force deleted" event.
     */
    public function forceDeleted(SaleProduct $saleProduct): void
    {
        //
    }
}

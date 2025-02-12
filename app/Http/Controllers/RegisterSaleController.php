<?php

namespace App\Http\Controllers;

use App\Traits\Responses;
use App\Http\Requests\SaleRequest;
use Illuminate\Support\Facades\Log;
use App\Repositories\SaleRepository;
use App\Repositories\SaleProductRepository;

class RegisterSaleController extends Controller
{
    use Responses;

    public function __invoke(SaleRequest $request)
    {
        try {
            \DB::beginTransaction();
            $saleRepository = new SaleRepository;
            $sale = $saleRepository->create([
                'datetime' => $request->datetime,
                'total_amount' => collect($request->products)->sum('quantity'),
                'client_id' => $request->client_id
            ]);
            $saleProductRepository = new SaleProductRepository($sale);
            foreach ($request->products as $product) {
                $saleProductRepository->create([
                    'product_id' => $product['product_id'],
                    'product_quantity' => $product['quantity']
                ]);
            }
            \DB::commit();
            return $this->successResponse('Venta registrada con éxito');
        } catch (\Exception $ex) {
            \DB::rollback();
            Log::error($ex);
            return $this->errorResponse('Error al registrar la venta');
        }
    }
}

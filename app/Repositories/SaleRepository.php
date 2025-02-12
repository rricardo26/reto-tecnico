<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Sale;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class SaleRepository
{
    public function create($data): Sale
    {
        $data['user_id'] = Auth::id();
        $data['code'] = Carbon::now()->format('YmsHis');
        logger($data);
        return Sale::create($data);
    }

    public function report(string $filterFrom, string|null $filterTo): Collection
    {
        return Sale::whereDate('datetime', '>=', $filterFrom)
            ->when($filterTo, function ($sale) use ($filterTo) {
                $sale->whereDate('datetime', '<=', $filterTo);
            })
            ->with(['client', 'saleProducts'])
            ->get()
            ->map(function ($sale) {
                $document = $sale->client->document_type == 1 ? 'DNI' : 'RUC';
                return collect([
                    'code' => $sale->code,
                    'client_name' => $sale->client->name,
                    'client_document' => "$document {$sale->client->document_number}",
                    'client_email' => $sale->client->email,
                    'products_quantity' => $sale->saleProducts->sum('product_quantity'),
                    'total_amount' => $sale->total_amount,
                    'date_time' => $sale->datetime
                ]);
            });
    }
}

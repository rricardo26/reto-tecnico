<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Exports\SalesExport;
use Illuminate\Http\Request;
use App\Repositories\SaleRepository;
use Maatwebsite\Excel\Facades\Excel;

class SalesExportJsonController extends Controller
{
    public function __invoke(Request $request)
    {
        $filterFrom = $request->filter_from ?? Carbon::startOfWeek()->subWeeks(4)->format('Y-m-d');
        $filterTo = $request->filter_to ?? null;

        $sales = (new SaleRepository)->report($filterFrom, $filterTo)->toArray();        
        file_put_contents(storage_path('sales.json'), json_encode($sales));

        return response()->download(storage_path('sales.json'));
    }
}

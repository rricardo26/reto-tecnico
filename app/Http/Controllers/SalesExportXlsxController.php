<?php

namespace App\Http\Controllers;

use App\Repositories\SaleRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;

class SalesExportXlsxController extends Controller
{
    public function __invoke(Request $request)
    {
        $filterFrom = $request->filter_from ?? Carbon::startOfWeek()->subWeeks(4)->format('Y-m-d');
        $filterTo = $request->filter_to ?? null;

        $sales = (new SaleRepository)->report($filterFrom, $filterTo);

        return Excel::download(new SalesExport($sales), 'sales.xlsx');
    }
}

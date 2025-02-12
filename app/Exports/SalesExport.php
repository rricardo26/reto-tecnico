<?php

namespace App\Exports;

use App\Models\Sale;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SalesExport implements FromCollection, WithHeadings
{
    public function __construct(private Collection $data) { }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'Código',
            'Nombre cliente',
            'Identificación Cliente',
            'Correo Cliente',
            'Cantidad productos',
            'Monto total',
            'Fecha y hora',
        ];
    }

}

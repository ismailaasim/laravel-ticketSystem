<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultipleContainerImport implements WithMultipleSheets
{
    /**
    * @param Collection $collection
    */  

    public function sheets(): array
    {
        return [
            'Shipments' => new MultipleShipmentImport(),
            'MarksAndNumbers' => new MarksAndNumbersImport(),
            'Packages' => new PackagesImport(),
            'Containers' => new ContainersImport(),
        ];
        // exit;
    }
}

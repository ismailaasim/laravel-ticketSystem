<?php

namespace App\Imports;

use App\Models\ShipContainer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Validation\ValidationException;

class ContainersImport implements ToCollection, WithHeadingRow, WithStartRow
{

    const EXPECTED_CONTAINERS = [
        'sno',
        'container_containernumber',
        'container_containertype_isocode',
        'container_containertype_uscontainercode',
        'container_containertype_containercode',
        'container_seal',
        'container_packingmode',
        'container_isarrivingatctobyrail',
        'container_isemptycontainer',
        'container_isdamaged',
    ];
    /**
     * @param Collection $collection
     */

    public function headingRow(): int
    {
        return 1; // Assuming the headers are in the first row
    }

    public function startRow(): int
    {
        return 2;
    }



    public function collection(Collection $rows)
    {
        $insertedIds = App::make('inserted_ids');
        $serialIds = App::make('serial_ids');

        if (count($insertedIds) > 0) {
            $headerRow = $rows->first()->keys()->toArray();
            foreach ($headerRow as $index => $value) {
                $headerRow[$index] = trim($value);
            }

            $errors = [];

            foreach (self::EXPECTED_CONTAINERS as $index => $expectedHeader) {
                if (!isset($headerRow[$index]) || $headerRow[$index] !== $expectedHeader) {
                    $length = strlen(trim($headerRow[$index]));
                    if ($length <= 1) {
                        $err = 'Invalid Or Empty title';
                        $errors[] = "Expected header '{$expectedHeader}' but found '{$err}' at position " . ($index + 1);
                    } else {
                        $errors[] = "Expected header '{$expectedHeader}' but found '{$headerRow[$index]}' at position " . ($index + 1);
                    }
                }
            }

            if (!empty($errors)) {
                session()->flash('errors', $errors);
                throw ValidationException::withMessages($errors);
            }

            foreach ($rows as $row) {

                echo " This is rows : " . $row['sno'];
                $shipment_id = '';
                $current_sno = $row['sno'];
                foreach ($serialIds as $s_key => $s_id) {
                    if ($s_id == $current_sno) {
                        $shipment_id = $insertedIds[$s_key];
                    }
                }

                if ($shipment_id != '' & $shipment_id != null) {
                    ShipContainer::create([
                        'shipment_id' => $shipment_id,
                        'Container_ContainerNumber' => $row['container_containernumber'],
                        'Container_ContainerType_ISOCode' => $row['container_containertype_isocode'],
                        'Container_ContainerType_USContainerCode' => $row['container_containertype_uscontainercode'],
                        'Container_ContainerType_ContainerCode' => $row['container_containertype_containercode'],
                        'Container_Seal' => $row['container_seal'],
                        'Container_PackingMode' => strtoupper($row['container_packingmode']),
                        'Container_IsArrivingAtCTOByRail' => ($row['container_isarrivingatctobyrail'] === 'TRUE' || $row['container_isarrivingatctobyrail'] === true) ? 'true' : 'false',

                        'Container_IsEmptyContainer' => ($row['container_isemptycontainer'] === 'TRUE' || $row['container_isemptycontainer'] === true) ? 'true' : 'false',

                        'Container_IsDamaged' => ($row['container_isdamaged'] === 'TRUE' || $row['container_isdamaged'] === true) ? 'true' : 'false',
                    ]);
                }
            }
        }
    }
}

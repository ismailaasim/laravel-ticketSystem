<?php

namespace App\Imports;

use App\Models\ShipPackages;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Validation\ValidationException;

class PackagesImport implements ToCollection, WithHeadingRow, WithStartRow
{

    const EXPECTED_PACKAGES = [
        'sno',
        'shipment_packtype',
        'shipment_numberofpacks',
        'shipment_package_weight',
        'shipment_package_weight_dimensiontype',
        'shipment_package_volume',
        'shipment_package_volume_dimensiontype',
        'shipment_package_containernumber',
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

            foreach (self::EXPECTED_PACKAGES as $index => $expectedHeader) {
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
                    ShipPackages::create([
                        'shipment_id' => $shipment_id,
                        'Shipment_PackType' => $row['shipment_packtype'],
                        'Shipment_NumberOfPacks' => $row['shipment_numberofpacks'],
                        'Shipment_Package_Weight' => $row['shipment_package_weight'],
                        'Shipment_Package_Weight_DimensionType' => $row['shipment_package_weight_dimensiontype'],
                        'Shipment_Package_Volume' => $row['shipment_package_volume'],
                        'Shipment_Package_Volume_DimensionType' => $row['shipment_package_volume_dimensiontype'],
                        'Shipment_Package_ContainerNumber' => $row['shipment_package_containernumber'],
                    ]);
                }
            }
        }
    }
}

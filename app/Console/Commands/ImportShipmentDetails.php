<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ShipmentDetail;
use Illuminate\Support\Facades\DB;

class ImportShipmentDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:shipment-details';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import shipment details from EXNOM.mdb into the shipment_details table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $rows = DB::connection('ms_access')->select('SELECT TOP 10 * SHIPMENT_DETAILS');

        $batchSize = 1000; // Size of each batch
        $batch = [];

        foreach ($rows as $row) {
            $batch[] = (array) $row;

            if (count($batch) >= $batchSize) {
                ShipmentDetail::insert($batch);
                $batch = [];
            }
        }

        if (count($batch) > 0) {
            ShipmentDetail::insert($batch);
        }

        $this->info('Shipment details imported successfully.');
    }
}

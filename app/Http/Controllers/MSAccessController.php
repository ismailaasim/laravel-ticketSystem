<?php

namespace App\Http\Controllers;

use App\Models\ShipmentBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use PDOException;
use App\Models\SDetails;
use App\Models\ShipmentDetail;

class DataSanitizer
{
    /**
     * Sanitize an array of data by applying htmlspecialchars to all string values.
     *
     * @param array $data
     * @return array
     */
    // public static function sanitizeData(array $data): array
    // {
    //     $sanitizedData = [];

    //     foreach ($data as $key => $value) {
    //         // Check if value is a string
    //         if (is_string($value)) {
    //             // Escape special characters for HTML output
    //             $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    //         }

    //         // Add sanitized value to result array
    //         $sanitizedData[$key] = $value;
    //     }

    //     return $sanitizedData;
    // }
    public static function sanitizeData($data)
    {
        return array_map('htmlspecialchars', $data);
    }
}

class MSAccessController extends Controller
{
    public function getColumnNames()
    {
        try {
            ini_set('memory_limit', '512M');
            ini_set('max_execution_time', 300);

            // Fetch data from MS Access
            $accessResults = DB::connection('ms_access')->select('SELECT * FROM DETAILS');

            $batchSize = 500; // Optimal batch size
            $batch = [];

            foreach ($accessResults as $row) {
                // Convert stdClass to associative array
                $rowArray = (array) $row;

                // Sanitize data
                $sanitizedRow = DataSanitizer::sanitizeData($rowArray);

                $batch[] = $sanitizedRow;

                if (count($batch) >= $batchSize) {
                    // Insert batch of data into the shipment_details table
                    ShipmentDetail::insert($batch);
                    $batch = []; // Clear the batch array
                }
            }

            // Insert any remaining records in the last batch
            if (count($batch) > 0) {
                ShipmentDetail::insert($batch);
            }
        } catch (\Exception $e) {
            // Log the exception message
            Log::error('Error inserting data: ' . $e->getMessage());
        }
    }
    public function createStudentTable()
    {
        $query = "
            CREATE TABLE Departments (
                id COUNTER PRIMARY KEY,
                dept_name TEXT(255),
                Location TEXT               
            );
        ";

        try {
            DB::connection('ms_access')->statement($query);
            return "Table 'student' created successfully.";
        } catch (\Exception $e) {
            return "Error creating table: " . $e->getMessage();
        }
    }

    // public function getODBCDetails()
    // {
    //     // Fetch data from MS Access
    //     $accessResults = DB::connection('ms_access')->select('SELECT TOP 500 * FROM DETAILS ');

    //     // dd($accessResults);
    //     $batchSize = 100; // Adjust batch size as needed for performance
    //     $batch = [];

    //         foreach ($accessResults as $row) {
    //             // Convert stdClass to associative array
    //             $batch[] = (array) $row;

    //             if (count($batch) >= $batchSize) {
    //                 // Insert batch of data into the shipment_details table
    //                 ShipmentDetail::insert($batch);
    //                 $batch = []; // Clear the batch array
    //             }
    //         }

    //         // Insert any remaining records in the last batch
    //         if (count($batch) > 0) {
    //             ShipmentDetail::insert($batch);
    //         }


    // }
    public function getODBCDetails() // this is working
    {
        ini_set('memory_limit', '1024M'); // Adjust as needed
        ini_set('max_execution_time', 300); // Adjust as needed
        // Fetch data from MS Access
        // Fetch data from MS Access
        $accessResults = DB::connection('ms_access')->select('SELECT * FROM DETAILS');
        // dd($accessResults);
        $batchSize = 20; // Adjust batch size for performance
        $batch = [];

        foreach ($accessResults as $row) {
            // Convert stdClass to associative array
            $batch[] = (array) $row;

            if (count($batch) >= $batchSize) {
                // Insert batch of data into the shipment_details table
                ShipmentDetail::insert($batch);
                $batch = []; // Clear the batch array
            }
        }

        // // Insert any remaining records in the last batch
        // if (count($batch) > 0) {
        //     ShipmentDetail::insert($batch);
        // }

        echo "Inserted Successfully";
    }

    public function checkLiveDB() // this is for live server
    {
        $accessResults = DB::connection('ms_access')->select('SELECT * FROM details');
        dd($accessResults);
        // $dsn = "odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=\\\\192.168.2.249\\Testdb\\EXNOM.mdb;";
        // $username = 'Testdb';
        // $password = '$Test@2024&';

        // try {
        //     $dbh = new PDO($dsn, $username, $password);
        //     echo "Connected to ODBC successfully!";
        // } catch (PDOException $e) {
        //     echo "Connection failed: " . $e->getMessage();
        // }
    }


    public function checkMS()
    {
        $accessResults = DB::connection('ms_access')->select('SELECT * FROM details');
        if (count($accessResults) > 0) {
            $detailsArray = [];
            foreach ($accessResults as $value) {
                // Sanitize each value
                $branch = isset($value->BRANCH) ? preg_replace('/[^\x20-\x7E]/', '', $value->BRANCH) : 'default_branch';
                $bkg_no = isset($value->BKGNO) ? preg_replace('/[^\x20-\x7E]/', '', $value->BKGNO) : 'default_bkg_no';
                $bkg_date = isset($value->BKGDT) ? \Carbon\Carbon::parse($value->BKGDT)->format('Y-m-d H:i:s') : now();
                $agt_name = isset($value->AGTNAME) ? preg_replace('/[^\x20-\x7E]/', '', $value->AGTNAME) : 'default_agt_name';
                $customer = isset($value->CUSTOMER) ? preg_replace('/[^\x20-\x7E]/', '', $value->CUSTOMER) : 'default_customer';
                $shipper = isset($value->SHIPPER) ? preg_replace('/[^\x20-\x7E]/', '', $value->SHIPPER) : 'default_shipper';
                $consignee = isset($value->CONSIGNEE) ? preg_replace('/[^\x20-\x7E]/', '', $value->CONSIGNEE) : 'default_consignee';
                $user = isset($value->USER) ? preg_replace('/[^\x20-\x7E]/', '', $value->USER) : 'default_user';

                $detailsArray[] = [
                    'branch' => $branch,
                    'bkg_no' => $bkg_no,
                    'bkg_date' => $bkg_date,
                    'agt_name' => $agt_name,
                    'customer' => $customer,
                    'shipper' => $shipper,
                    'consignee' => $consignee,
                    'user' => $user,
                ];
            }

            if (!empty($detailsArray)) {
                DB::beginTransaction();
                try {
                    ShipmentBooking::insert($detailsArray);
                    DB::commit();
                    echo "Data inserted successfully";
                } catch (\Exception $e) {
                    DB::rollBack();
                    \Log::error('Error inserting data: ' . $e->getMessage());
                    \Log::error('Exception trace: ' . $e->getTraceAsString());

                    // Optional: Process and insert records one-by-one to find problematic record
                    foreach ($detailsArray as $details) {
                        try {
                            ShipmentBooking::create($details);
                        } catch (\Exception $e) {
                            \Log::error('Error inserting record: ' . json_encode($details) . ' - ' . $e->getMessage());
                        }
                    }

                    echo "Error inserting data: " . $e->getMessage();
                }
            } else {
                echo "No data";
            }
        } else {
            echo "No data";
        }
    }

    public function insertStudent()
    {
        // Assuming data to be inserted
        $data = [
            ['ID' => '10', 'StudentName' => 'New Student', 'Address' => 'New Address', 'Email' => 'newstudent@gmail.com'],
        ];

        // Insert data into MS Access database
        try {
            foreach ($data as $student) {
                DB::connection('ms_access')->table('students')->insert($student);
            }
            return "Data inserted successfully!";
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function loadBookingDetails()
    {
        // $shipments = ShipmentBooking::all();
        $shipments = ShipmentDetail::limit(10)->get();
        return view('booking', compact('shipments'));
    }

    // ***************** New functions Start ************
    public function syncData()
    {
        try {
            ini_set('memory_limit', '512M');
            ini_set('max_execution_time', 300);

            // Fetch data from MS Access
            $accessResults = DB::connection('ms_access')->select('SELECT * FROM DETAILS');

            // Prepare an array of existing BKGNOs
            $existingBKGNOs = ShipmentDetail::pluck('BKGNO')->toArray();

            // Initialize batch processing
            $batchSize = 500;
            $batch = [];

            foreach ($accessResults as $row) {
                $rowArray = (array) $row;
                $sanitizedRow = DataSanitizer::sanitizeData($rowArray);

                // Check if BKGNO exists in the database
                if (in_array($sanitizedRow['BKGNO'], $existingBKGNOs)) {
                    // Check if there is any modification needed
                    $existingRecord = ShipmentDetail::where('BKGNO', $sanitizedRow['BKGNO'])->first();
                    if ($this->hasChanged($existingRecord, $sanitizedRow)) {
                        // Update the record
                        ShipmentDetail::where('BKGNO', $sanitizedRow['BKGNO'])->update($sanitizedRow);
                    }
                } else {
                    // Insert new record
                    $batch[] = $sanitizedRow;
                    if (count($batch) >= $batchSize) {
                        ShipmentDetail::insert($batch);
                        $batch = [];
                    }
                }
            }

            // Insert any remaining records
            if (count($batch) > 0) {
                ShipmentDetail::insert($batch);
            }
        } catch (\Exception $e) {
            // Log the exception message
            Log::error('Error synchronizing data: ' . $e->getMessage());
        }
    }

    private function hasChanged($existingRecord, $newRecord)
    {
        foreach ($newRecord as $key => $value) {
            if ($existingRecord->$key != $value) {
                return true;
            }
        }
        return false;
    }
    // ***************** New functions Start End ********
}

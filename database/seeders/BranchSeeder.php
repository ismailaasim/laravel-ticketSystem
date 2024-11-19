<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branchNames = [
           'AHMEDABAD', 'BANGALORE', 'BARODA', 
            'CHENNAI', 'COCHIN', 'DELHI', 'HYDERABAD', 'JAIPUR', 
            'JODHPUR', 'KANPUR', 'KOLKATA', 'LUDHIANA', 'MUMBAI', 
            'PUNE', 'TUTICORIN'
        ];
        foreach($branchNames as $branchName){
            Branch::create([
                'branch_name' => $branchName,
                'branch_status' => 'active', 
                'filter_status' => 'active', 
            ]);
        }
    }
}

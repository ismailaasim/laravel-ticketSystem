<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SDetails extends Model
{
    use HasFactory;
    protected $connection = 'ms_access'; // Use the ODBC connection
    // protected $connection = 'odbc'; // Use the ODBC connection
    protected $table = 'DETAILS';   // Table name in the MS Access database
    public $timestamps = false;     // If your table doesn't have `created_at` and `updated_at` columns
}

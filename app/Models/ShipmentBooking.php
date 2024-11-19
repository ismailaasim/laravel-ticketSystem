<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch',
        'bkg_no',
        'bkg_date',
        'agt_name',
        'customer',
        'shipper',
        'consignee',
        'user',
    ];
}

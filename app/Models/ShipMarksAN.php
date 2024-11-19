<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipMarksAN extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipment_id',
        'marks_and_numbers',
    ];

    public function ShipmentMain2()
    {
        return $this->belongsTo(ShipmentMain2::class, 'shipment_id');
    }
}

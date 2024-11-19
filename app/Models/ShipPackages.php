<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipPackages extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipment_id',
        'Shipment_PackType',
        'Shipment_NumberOfPacks',
        'Shipment_Package_Weight',
        'Shipment_Package_Weight_DimensionType',
        'Shipment_Package_Volume',
        'Shipment_Package_Volume_DimensionType',
        'Shipment_Package_ContainerNumber',
    ];

    public function ShipmentMain2()
    {
        return $this->belongsTo(ShipmentMain2::class, 'shipment_id');
    }
}

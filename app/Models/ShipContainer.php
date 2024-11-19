<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipContainer extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipment_id',
        'Container_ContainerNumber',
        'Container_ContainerType_ISOCode',
        'Container_ContainerType_USContainerCode',
        'Container_ContainerType_ContainerCode',
        'Container_Seal',
        'Container_PackingMode',
        'Container_IsArrivingAtCTOByRail',
        'Container_IsEmptyContainer',
        'Container_IsDamaged',
    ];

    public function ShipmentMain2()
    {
        return $this->belongsTo(ShipmentMain2::class, 'shipment_id');
    }
}

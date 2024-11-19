<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentDetail extends Model
{
    use HasFactory;
    protected $table = 'shipment_details';
    public $timestamps = false; // Set to false if you don't have created_at and updated_at columns

    // Define the fillable fields
    protected $fillable = [
        'BRANCH',
        'BKGNO',
        'BKGDT',
        'FOLLOWUPDT',
        'AGTNAME',
        'AGTRONO',
        'CUSTOMER',
        'SHIPPER',
        'CONSIGNEE',
        'SHPRFEE',
        'CTC',
        'EMAIL',
        'TERMS',
        'PLR',
        'POL',
        'POD',
        'FDEST',
        'COMMODITY',
        'COMMTYPE',
        'REQUIREMENTS',
        'VESSEL',
        'ETDPOL',
        'ETAPOD',
        'WEIGHT',
        'CBM',
        'PKG',
        'SHPBILLNO',
        'HBLNO',
        'RORCVDDT',
        'CARGOREADYDT',
        'PICKUPDT',
        'CLRDT',
        'DOCHODT',
        'BLRLSDT',
        'CARTINGDT',
        'DRAFTBLDT',
        'COMMENTS',
        'USER',
        'SNO',
        'AGENTID',
        'SUBJECT',
        'QUOTNO',
        'STATUS',
        'MODDATE',
        'CARRIER',
        'CONTRACTNO',
        'BOOKINGNO',
        'EQUIPMENTTYPE',
        'CONTAINERNO',
        'SEALNO',
        'DETENTION',
        'BOOKINGDT',
        'BOOKINGRCVDDT',
        'PICKUPDTFCL',
        'GATEINDT',
        'CUTOFF',
        'SICUTOFF',
        'FORM13CUTOFF',
        'GATEINCUTOFF',
        'FREIGHTTERM',
        'EMAILSTOTAL',
        'RR',
        'CR',
        'CP',
        'CC',
        'DBL',
        'DHO',
        'BL',
        'mail_count',
        'mail_read_status',
    ];
}

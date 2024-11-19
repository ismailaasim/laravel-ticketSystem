<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTracking extends Model
{
    use HasFactory;

    protected $fillable = [
    'id',
    'message_id',
    'subject',
    'from',	
    'cc',
    'to',
    'bcc',
    'body',
    'received_at',
    'created_at',
    'updated_at',
    'shipment_id',    
   ];
}

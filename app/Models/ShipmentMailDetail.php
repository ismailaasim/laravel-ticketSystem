<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentMailDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject',
        'body',
        'uid',
        'to',
        'from',
        'date',
        'cc',
        'bcc',
        'sender',
        'attach_count',
        'attachment_paths',
        'bkg_no',
        'unique_mail_id',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Email extends Model
{
    use Searchable;
    use HasFactory;

    protected $fillable = [
        'uid',
        'subject',
        'body',
        'from',
        'to',
        'received_at'
    ];

    public function searchableAs()
    {
        return 'emails_index';
    }

    public function toSearchableArray()
    {
        return $this->toArray();
    }
}

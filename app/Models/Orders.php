<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'first_name',
        'last_name',
        'company_name',
        'email',
        'phone',
        'model',
        'message',
        'date',
        'time',
        'is_delete',
        'service_id',
        'pesubox_id',
        'duration',
    ];
}

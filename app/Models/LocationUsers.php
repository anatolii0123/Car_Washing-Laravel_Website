<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationUsers extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'user_id',
        'status',
    ];
}

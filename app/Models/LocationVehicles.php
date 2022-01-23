<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationVehicles extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'vehicle_id',
    ];
}

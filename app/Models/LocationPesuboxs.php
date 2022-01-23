<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationPesuboxs extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'name',
        'description',
        'status',
    ];
}

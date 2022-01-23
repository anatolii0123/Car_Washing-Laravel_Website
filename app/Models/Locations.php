<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'Mon_start',
        'Mon_end',
        'Tue_start',
        'Tue_end',
        'Wed_start',        
        'Wed_end',
        'Thu_start',
        'Thu_end',
        'Fri_start',
        'Fri_end',
        'Sat_start',
        'Sat_end',
        'Sun_start',
        'Sun_end',
        'interval',
        'address',
        'street',
        'city',
    ];
}

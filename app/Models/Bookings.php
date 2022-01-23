<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;
    protected $fillable = [
        'location_id',
        "email",
        "phone",
        "started_at",
        "driver",
        "number",
        "summary",
        "mark_id",
        "model_id",
        'is_delete',
        "service_id",
        "pesubox_id",
        "vehicle_id",
        'date',
        'time',
        "duration",
    ];
}

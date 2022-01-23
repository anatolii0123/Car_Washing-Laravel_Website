<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'mark_id',
        'model',
    ];
}

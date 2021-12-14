<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'day_id',
        'start_at',
        'end_at',
        'break_start_at',
        'break_end_at',
        'is_offday',
    ];
}

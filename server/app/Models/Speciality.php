<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Speciality extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function doctors() {
        return $this->belongsToMany(User::class);
    }
}

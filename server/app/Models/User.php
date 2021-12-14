<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'gender',
        'birth_date',
        'phone_no',
        'blood_group_id',
        'gap',
        'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'specialities'      => 'array',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public static function doctors()
    {
        return User::where('role_id', 2);
    }

    public static function patients()
    {
        return User::where('role_id', 3);
    }

    public function specialities()
    {
        return $this->belongsToMany(Speciality::class)
            ->whereNull('deleted_at')
            ->withTimestamps()
            ->withPivot(['deleted_at']);
    }

    public function blood_group()
    {
        return $this->hasOne(BloodGroup::class);
    }

    public function schedules()
    {
        return $this->hasMany('App\Models\Schedule');
    }


}

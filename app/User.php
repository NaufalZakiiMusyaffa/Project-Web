<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'karyawan_id', 'email', 'password', 'username', 'level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function karyawan()
    {
       return $this->belongsTo(Karyawan::class);
    }

    public function pemeliharaan()
    {
       return $this->hasMany(Pemeliharaan::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
	protected $table = 'karyawan';
    protected $fillable = ['user_id', 'nik', 'nama', 'jk', 'jabatan'];


    /**
     * Method One To One 
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    /**
     * Method One To Many 
     */
    public function transaksi()
    {
    	return $this->hasMany(Transaksi::class);
    }

    public function history()
    {
        return $this->hasMany(History::class);
    }

    public function aset()
    {
        return $this->hasMany(Aset::class);
    }

    public function asetac()
    {
        return $this->hasMany(Autocare::class);
    }
}

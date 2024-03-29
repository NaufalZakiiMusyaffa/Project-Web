<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
	protected $table = 'karyawan';
    protected $fillable = ['nik', 'nama', 'jk', 'jabatan', 'gambar', 'telepon', 'tanda_tangan'];


    /**
     * Method One To One 
     */

    /**
     * Method One To Many 
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

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

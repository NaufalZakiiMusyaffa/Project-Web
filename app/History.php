<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';
    protected $fillable = ['tgl_history', 'aset_id', 'tindakan', 'karyawan_id'];


    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function aset()
    {
        return $this->belongsTo(Aset::class);
    }

    public function transaksi()
    {
    	return $this->hasMany(Transaksi::class);
    }

}

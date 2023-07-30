<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autocare extends Model
{
    protected $table = 'asetac';
    protected $fillable = ['kode_aset', 'nama_kendaraan', 'nopol', 'masaberlaku_stnk', 'status_kendaraan', 'karyawan_id','send_notif'];

    /**
     * Method One To Many 
     */
    public function transaksiac()
    {
    	return $this->hasMany(TransaksiAutocare::class);
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function pemeliharaanac()
    {
        return $this->belongsTo(PemeliharaanAutocare::class);
    }
}

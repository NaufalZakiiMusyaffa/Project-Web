<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiAutocare extends Model
{
    protected $table = 'transaksiac';
    protected $fillable = ['kode_peminjaman', 'karyawan_id', 'asetac_id', 'supir_id', 'tgl_pinjam', 'tgl_kembali', 'ket', 'status'];

    public function karyawan()
    {
    	return $this->belongsTo(Karyawan::class);
    }

    public function asetac()
    {
    	return $this->belongsTo(Autocare::class);
    }

    public function supir()
    {
        return $this->belongsTo(Driver::class);
    }
}

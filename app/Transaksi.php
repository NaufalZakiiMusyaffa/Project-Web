<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = ['kode_transaksi', 'karyawan_id', 'aset_id', 'tgl_pinjam', 'tgl_kembali', 'status', 'ket'];

    public function karyawan()
    {
    	return $this->belongsTo(Karyawan::class);
    }

    public function aset()
    {
    	return $this->belongsTo(Aset::class);
    }

    public function history()
    {
        return $this->belongsTo(History::class);
    }
}

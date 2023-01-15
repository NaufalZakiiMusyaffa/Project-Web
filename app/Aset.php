<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    protected $table = 'aset';
    protected $fillable = ['kode_aset', 'nama_aset', 'kategori_id', 'karyawan_id', 'merk', 'jumlah_aset', 'spesifikasi', 'garansi', 'tgl_beli', 'harga_beli', 'toko_beli', 'alamat', 'gambar'];


    /**
     * Method One To Many 
     */
    public function transaksi()
    {
    	return $this->hasMany(Transaksi::class);
    }

    public function kategori()
    {
    	return $this->belongsTo(Kategori::class);
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function history()
    {
        return $this->hasMany(History::class);
    }

    public function pemeliharaan()
    {
        return $this->belongsTo(Pemeliharaan::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemeliharaan extends Model
{
    protected $table = 'pemeliharaan';
    protected $fillable = ['kode_pemeliharaan', 'aset_id', 'keterangan', 'biaya', 'status', 'yang_mengajukan', 'keputusan_oleh', 'gambar'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function aset()
    {
    	return $this->belongsTo(Aset::class);
    }
}

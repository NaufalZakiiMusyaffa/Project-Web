<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemeliharaanAutocare extends Model
{
    protected $table = 'pemeliharaanac';
    protected $fillable = ['kode_pemeliharaan', 'asetac_id', 'keterangan', 'biaya', 'status', 'yang_mengajukan', 'keputusan_oleh', 'gambar'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function asetac()
    {
    	return $this->belongsTo(Autocare::class);
    }
}

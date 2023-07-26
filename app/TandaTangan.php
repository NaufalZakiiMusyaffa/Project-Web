<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TandaTangan extends Model
{
    protected $table = 'tanda_tangan';
    protected $fillable = ['karyawan_id', 'gambar'];

    // public function karyawan()
    // {
    //    return $this->belongsTo(Karyawan::class);
    // }
}
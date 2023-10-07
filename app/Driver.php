<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'supir';
    protected $fillable = ['kode_supir', 'nama_supir', 'kontak', 'status_supir'];


    /**
     * Method One To Many 
     */
    public function transaksiac()
    {
    	return $this->hasMany(TransaksiAutocare::class);
    }

}

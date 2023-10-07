<?php

use Illuminate\Database\Seeder;

class KaryawansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Karyawan::insert([
            [
              'id'  			    => 1,
              'nik'				    => 000000000,
              'nama' 			    => 'Dhani Ernadi S',
              'jk'				    => 'L',
              'jabatan'			  => 'HR&GA Senior Manager',
              'gambar'        => NULL,
              'telepon'       => '080100011122',
              'tanda_tangan'  => NULL,
              'created_at'    => \Carbon\Carbon::now(),
              'updated_at'    => \Carbon\Carbon::now()
            ]
        ]);
    }
}

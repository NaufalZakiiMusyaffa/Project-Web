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
              'nik'				    => 100003,
              'nama' 			    => 'Naufal Zaki',
              'jk'				    => 'L',
              'jabatan'			  => 'Manajer',
              'gambar'        => NULL,
              'telepon'       => '080100011122',
              'tanda_tangan'  => NULL,
              'created_at'    => \Carbon\Carbon::now(),
              'updated_at'    => \Carbon\Carbon::now()
            ],
            [
              'id'  			    => 2,
              'nik'				    => 100001,
              'nama' 			    => 'Elkan Baggot',
              'jk'				    => 'L',
              'jabatan'			  => 'Admin',
              'gambar'        => NULL,
              'telepon'       => '087799634502',
              'tanda_tangan'  => NULL,
              'created_at'    => \Carbon\Carbon::now(),
              'updated_at'    => \Carbon\Carbon::now()
            ],
            [
              'id'  			    => 3,
              'nik'				    => 100002,
              'nama' 			    => 'Windi Barsudari',
              'jk'				    => 'P',
              'jabatan'			  => 'Sekretaris',
              'gambar'        => NULL,
              'telepon'       => NULL,
              'tanda_tangan'  => NULL,
              'created_at'    => \Carbon\Carbon::now(),
              'updated_at'    => \Carbon\Carbon::now()
            ],
        ]);
    }
}

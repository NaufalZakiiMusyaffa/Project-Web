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
              'id'  			=> 1,
              'user_id'  		=> 1,
              'nik'				=> 100003,
              'nama' 			=> 'Admin XX',
              'jk'				=> 'L',
              'jabatan'			=> 'Accounting',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 2,
              'user_id'  		=> 2,
              'nik'				=> 100003,
              'nama' 			=> 'User XX',
              'jk'				=> 'L',
              'jabatan'			=> 'Marketing',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
        ]);
    }
}

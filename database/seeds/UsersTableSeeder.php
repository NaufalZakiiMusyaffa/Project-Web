<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\User::insert([
            [
              'id'  			      => 1,
              'karyawan_id'  		=> 1,
              'username'		    => 'hrd123',
              'email' 			    => '123@gmail.com',
              'password'		    => bcrypt('hrd123'),
              'level'			      => 'manager',
              'remember_token'	=> NULL,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			      => 2,
              'karyawan_id'  		=> 2,
              'username'		    => 'it123',
              'email' 			    => '654321@gmail.com',
              'password'		    => bcrypt('it123'),
              'level'			      => 'it',
              'remember_token'	=> NULL,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			      => 3,
              'karyawan_id'  		=> 3,
              'username'		    => 'bocil',
              'email' 			    => 'bobocil69@gmail.com',
              'password'		    => bcrypt('kematian'),
              'level'			      => 'autocare',
              'remember_token'	=> NULL,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ]
        ]);
    }
}

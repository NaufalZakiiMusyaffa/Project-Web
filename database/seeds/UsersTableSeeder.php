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
              'username'		    => 'manager',
              'email' 			    => 'dhaniernadis@gmail.com',
              'password'		    => bcrypt('manager'),
              'level'			      => 'manager',
              'remember_token'	=> NULL,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ]
        ]);
    }
}

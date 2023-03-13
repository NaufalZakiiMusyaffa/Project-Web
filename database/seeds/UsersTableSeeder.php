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
              'id'  			=> 1,
              'name'  			=> 'Naufal Zaki',
              'username'		=> 'hrd123',
              'email' 			=> '123@gmail.com',
              'password'		=> bcrypt('hrd123'),
              'gambar'			=> NULL,
              'level'			=> 'manager',
              'remember_token'	=> NULL,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 2,
              'name'  			=> 'Naufal X',
              'username'		=> 'it123',
              'email' 			=> '654321@gmail.com',
              'password'		=> bcrypt('it123'),
              'gambar'			=> NULL,
              'level'			=> 'it',
              'remember_token'	=> NULL,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ]
        ]);
    }
}

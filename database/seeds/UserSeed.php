<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        DB::table('users')->insert([
            'name' => 'Corretor',
            'type' =>  'B',
            'email' => 'corretor@fkmail.com',
            'password' => Hash::make('123456'),
        ]);

        DB::table('users')->insert([
            'name' => 'Usuário',
            'type' =>  'C',
            'email' => 'usuario@fkmail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}

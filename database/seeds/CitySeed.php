<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('city')->insert([
            'name' => 'Niteroi',
            'state_id' =>  1
        ]);

        DB::table('city')->insert([
            'name' => 'Rio de Janeiro',
            'state_id' =>  1
        ]);

        DB::table('city')->insert([
            'name' => 'Cabo Frio',
            'state_id' =>  1
        ]);

        DB::table('city')->insert([
            'name' => 'São Gonçalo',
            'state_id' =>  1
        ]);

        DB::table('city')->insert([
            'name' => 'São Paulo',
            'state_id' =>  2
        ]);

        DB::table('city')->insert([
            'name' => 'Santos',
            'state_id' =>  2
        ]);
    }
}

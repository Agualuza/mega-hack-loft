<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('state')->insert([
            "country_id" => 1,
            'name' => 'Rio de Janeiro',
            "abbreviation" => "RJ"
        ]);

        DB::table('state')->insert([
            "country_id" => 1,
            'name' => 'São Paulo',
            "abbreviation" => "SP"
        ]);
    }
}

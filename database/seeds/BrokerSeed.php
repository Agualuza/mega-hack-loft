<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrokerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('broker')->insert([
            'user_id' => 1,
            'state_id' =>  1,
            'city_id' => 1,
            'photo' => "https://media-exp1.licdn.com/dms/image/C4E03AQF6_Y5xP6pd7w/profile-displayphoto-shrink_200_200/0?e=1586995200&v=beta&t=rclt_JwVYeiz4k2uaPj_RLDpd3Su3SnuslJHn0OkGtA",
            'creci' => '000321',
            'level' => 'G',
            'status' => 'A',
            'total_score' => 5500
        ]);
    }
}

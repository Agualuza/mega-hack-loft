<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ApiService extends Model
{
    public function httpRequest($url){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $content = curl_exec($ch);
        curl_close($ch);

        return $content;
    }

    public function getCityId($name){
        $city_id = DB::table('city')
        ->select(DB::raw('id as cid'))
        ->whereRaw("name = ?",[$name])
        ->get();

        foreach ($city_id as $c) {
            if($c->cid == null){
                return 1;
            }
            return $c->cid;
        }
    }

}

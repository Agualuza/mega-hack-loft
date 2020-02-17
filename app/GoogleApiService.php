<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ApiService;

class GoogleApiService extends Model
{
    private $key = "&key=AIzaSyBVKjHMzN-gncXoFcOhL45VxYq7-XG1HsA";
    
    public function reverseGeocode($coords) {
        $service = new ApiService();
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$coords.$this->key;
        return json_decode($service->httpRequest($url));
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Property;
use App\City;
use App\State;
use App\CallProperty;
use Illuminate\Support\Facades\DB;

class BuyController extends Controller
{
    public function index(){
        $user = Auth::user();
        $allProperties = Property::where('status','S')->get();

        $data = array(
            "user" => $user,
            "properties" => $allProperties
        );
        
        return view("buy.index",$data);
    }

    public function property (Request $request) {
        $property = Property::where('id',$request->input("pid"))->get()->first();
        
        return response()->json([
            'status' => 'OK',
            'response' => array('property' => $property, 'photo' => $property->property_photo , 'city' => $property->city->name)
        ]);
    }

    public function filter(Request $request){
        $city_name = null;
        $city = null;
        $n_name = null;
        $garage = null;
        $room = null;
        $type = null;
        $query = "";
        $params = array();

        if($request->input('filter_city')){
            $city_name = '%' . $request->input('filter_city') . '%';
            $city = City::where('name','LIKE',$city_name)->get()->first();
            $query .= "city_id = ?";
            $params[] = $city->id;
        }
        if($request->input('filter_neighborhood')){
            $n_name = '%' . $request->input('filter_neighborhood') . '%';
            if(strlen($query) > 0){
                $query .= " and ";
            }
            $query .= "neighborhood LIKE ?";
            $params[] = $n_name;
        }
        if($request->input('garage')){
            $garage = $request->input('garage');
            if(strlen($query) > 0){
                $query .= " and ";
            }
            $query .= "garage ?";
            $params[] = $garage;
        }
        if($request->input('room')){
            $room = $request->input('room');
            if(strlen($query) > 0){
                $query .= " and ";
            }
            $query .= "room ?";
            $params[] = $room;
        }
        if($request->input('type')){
            $type = $request->input('type');
            if(strlen($query) > 0){
                $query .= " and ";
            }
            $query .= "type = '?'";
            $params[] = $type;
        }

        if(strlen($query) > 0){
            $response = array();
            $prop = DB::table('property')
            ->select()
            ->whereRaw($query,$params)
            ->get();

            if(!$prop) {
                return response()->json([
                    'status' => 'NOK',
                    'message' => 'Não possuimos imóveis cadastrados com esses filtros'
                ]);
    
            }

            foreach ($prop as $p) {
                $response[] = $p;
            }

            return response()->json([
                'status' => 'OK',
                'response' => $response,
            ]);

        }
    }
}

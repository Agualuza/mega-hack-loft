<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Field;
use App\Broker;
use App\GoogleApiService;
use App\ApiService;
use App\Vertex;

class FieldController extends Controller
{
    public function index() {
        $user = Auth::user();
        $broker = Broker::where('id',$user->id)->get()->first();

        $data = array(
            "broker" => $broker
        );

        return view('field.index',$data); 
    }

    public function create() {
        return view('field.create'); 
    }

    public function save(Request $request) {
        if($request->all() != null){
            $field = new Field();
            $user = Auth::user();
            $broker = Broker::where('id',$user->id)->get()->first();
            $service = new ApiService();
            $c = $request->input('city_name');

            $city_id = $service->getCityId($c);

            $field->broker_id = $broker->id;
            $field->city_id = $city_id;
            $field->status = 'A';
            $field->name = 'Praia da Boa Viagem';
            $field->border_color = $request->input('border');
            $field->fill_color = $request->input('fill');
            $field->save();
            
            $size = count($request->all())-4;
            for ($i=0; $i < $size; $i++) { 
                $param = 'coord'.$i;
                $c = $request->input($param);
                $coord = explode(',',$c);
                $vertex = new Vertex();
                $vertex->field_id = $field->id;
                $vertex->lat = $coord[0];
                $vertex->lng = $coord[1];
                $vertex->order = $i;
                $vertex->save();
            }    

        }
       
       return redirect('field'); 
    }
}

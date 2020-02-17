<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Property;
use App\PropertyPhoto;
use App\City;
use Illuminate\Support\Facades\Input;

class SellController extends Controller
{
    public function index(){
        $user = Auth::user();
        $p = Property::where('user_id',$user->id)->get();

        $data = array(
            "property" => $p
        );

        return view("sell.index",$data);
    }

    public function create(){
       
        return view("sell.create");
    }

    public function new(Request $request){
        $user = Auth::user();
        $p = new Property();
       
        $c = City::where('name','LIKE',$request->input('city'))->first();
        $p->user_id = $user->id;
        $p->city_id = $c->id;
        $p->address = $request->input('address');
        $p->lat = $request->input('lat');
        $p->lng = $request->input('lng');
        $p->neighborhood = $request->input('nb');
        
        if($request->input('room')){
            $p->room = $request->input('room');
        }

        if($request->input('type')){
            $p->type = $request->input('type');
        }

        if($request->input('garage')){
            $p->garage = $request->input('garage');
        }

        if($request->input('furnished')){
            $p->furnished = $request->input('furnished');
        }

        $p->status = "S";
        
        $p->save();

        $target_dir = getcwd()."/assets/properties/";

        for ($i=0; $i < count($request->file()); $i++) { 
            $photo = new PropertyPhoto();
            $photo->property_id = $p->id;
            $f = 'file'.$i;
            $file = $request->file($f);
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = md5(time().rand(0,9999).rand(0,9999).rand(0,99999).rand(0,99999)).'.'.$extension;
            $file->move($target_dir, $filename);
            $photo->photo = $filename;
            $photo->save();
        }
       
        
        return redirect("/sell");
    }
}

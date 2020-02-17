<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Broker;
use App\BrokerEvaluation;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        $broker = Broker::where('id',$user->id)->get()->first();

        $data = array(
            "broker" => $broker
        );

        return view("profile.index",$data);
    }

    public function level(){
        $user = Auth::user();
        $broker = Broker::where('id',$user->id)->get()->first();

        $data = array(
            "broker" => $broker
        );

        return view("profile.level",$data);
    }

    public function user(){
        $user = Auth::user();

        $data = array(
            'user' => $user
        );

        return view("profile.user",$data);
    }
}

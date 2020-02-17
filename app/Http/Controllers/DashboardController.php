<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Broker;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $broker = Broker::where('user_id',$user->id)->get()->first();

        $data = array(
            "broker" => $broker
        );
        
        return view("dashboard.index",$data);
    }
}

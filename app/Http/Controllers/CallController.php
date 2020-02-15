<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Broker;
use App\Call;

class CallController extends Controller
{   

    public function index(){
        $user = Auth::user();
        $broker = Broker::where('user_id',$user->id)->get()->first();
        $calls = Call::where('broker_id',$broker->id)->orderBy('id','desc')->paginate(10);;
        
        $data = array(
            "broker" => $broker,
            "calls" => $calls
        );
        
        return view("call.index",$data);
    }

    public function refresh(Request $request){
        if($request->input("broker_id")){
            $broker_id = $request->input("broker_id");
            $broker = Broker::where('id',$broker_id)->get()->first();
            $arrayDispatch = array();

            if($broker){
                $index = 0;
                foreach ($broker->dispatch as $d) {
                    if($index <=  5){
                        if($d->call->status == 'W'){
                            $a = array(
                                "dispatch" => $d,
                                "date" => $d->getDate(),
                                "neighborhood" => $d->call->callProperty[0]->property->neighborhood
                            );
                            $arrayDispatch[] = $a;
                            $index++;
                        }
                    }
                }

                return response()->json([
                    'dispatch' => $arrayDispatch,
                ]);
            }

            return response()->json([
                'error' => 'Broker id is invalid'
            ]);
    
        } 
       
    }

    public function acept(Request $request) {
        if($request->input("broker_id") && $request->input("call_id") ){
            $bid = $request->input("broker_id");
            $cid = $request->input("call_id");

            $call = Call::where('id',$cid)->get()->first();
            if($call->broker_id == null){
                $call->broker_id = $bid;
                $call->status = "O";
                $call->save();
                return response()->json([
                    'status' => 'OK',
                    'message' => 'Parabéns essa chamada agora é sua. Acreditamos no seu potencial!',
                    'call_id' => $cid
                ]);
            } 
            return response()->json([
                'status' => 'NOK',
                'message' => 'Que pena alguém foi mais rápido que você'
            ]);
        }        
    }

    public function call(Request $request){
        $user = Auth::user();
        $cid = $request->input("call_id");
        $broker = Broker::where('user_id',$user->id)->get()->first();
        $call = Call::where('id',$cid)->first();;
        
        $data = array(
            "broker" => $broker,
            "call" => $call
        );
        
        return view("call.call",$data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class HomeController extends Controller
{
  
    public function login(Request $request){
        $credentials = $request->only(['email','password']);
        // if (!Auth::attempt($credentials)) {
        //     return redirect()
        //         ->back()
        //         ->withErrors('Usuário e/ou senha incorretos');
        // } 
        if(Auth::attempt($credentials)){
            if(Auth::user()->type == "B"){
                return redirect("/dashboard");
            } else if(Auth::user()->type == "C"){
                return redirect("/buy");
            } else if(Auth::user()->type == "A"){
                return redirect("/adm");
            }
        }

        return redirect()
                ->back()
                ->withErrors('Usuário e/ou senha incorretos');
    }

    public function index()
    {   
        if(Auth::user()){
            $user = Auth::user();
            $type = $user->type;
            if($type == "B"){
                return redirect("/dashboard");
            } else if($type == "C"){
                return redirect("/buy");
            } else if($type == "A"){
                return redirect("/adm");
            }
        }
        return view('home.index');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }



}

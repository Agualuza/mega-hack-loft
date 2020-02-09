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
        if (!Auth::attempt($credentials)) {
            return redirect()
                ->back()
                ->withErrors('Usuário e/ou senha incorretos');
        } 

        return redirect("/dashboard");
    }

    public function index()
    {   
        return view('home.index');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }



}

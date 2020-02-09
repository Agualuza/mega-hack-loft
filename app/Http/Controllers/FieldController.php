<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function index() {
        return view('field.index'); 
    }

    public function create() {
        return view('field.create'); 
    }
}

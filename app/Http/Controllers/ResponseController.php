<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseController extends Controller
{
    //
    public function index(Request $request, $key)
    {
        dd($key);
        return view('welcome');
    }
}

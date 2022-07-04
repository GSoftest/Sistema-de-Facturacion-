<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CajaController extends Controller
{

    public function index()
    {
        return view('caja.index');
        
    }    
    

}
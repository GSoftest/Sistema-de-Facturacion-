<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ClientesController extends Controller
{

    public function create(Request $request)
    {
        $clientes = new Clientes();
        $clientes->name = $request->name;
        $clientes->identificacion = $request->identificacion;
        $clientes->telefono = $request->telefono;
        $clientes->direccion = $request->direccion;

        $clientes->save();
         return Redirect::route('clientes');
    }

    public function show($id){

        $data = Clientes::find($id);
        return view('clientes.edit',compact('data'));
    }


    public function editar(Request $request){

        $data = Clientes::find($request->id);
        $data->name = $request->name;
        $data->identificacion = $request->identificacion;
        $data->telefono = $request->telefono;
        $data->direccion = $request->direccion;
        
            $data->save();
            return Redirect::route('clientes');
    }

}
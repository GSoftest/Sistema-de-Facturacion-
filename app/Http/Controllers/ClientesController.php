<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ClientesController extends Controller
{

    public function create(ClienteRequest $request)
    {
        $clientes = new Clientes();
        $clientes->name = $request->name;
        $clientes->identificacion = $request->identificacion;
        $clientes->telefono = $request->telefono;
        $clientes->direccion = $request->direccion;
        $clientes->correo = $request->correo;
        $clientes->estatus = 1;
        $clientes->save();
         return Redirect::route('clientes');
    }

    public function show($id){

        $data = Clientes::find($id);
        return view('clientes.edit',compact('data'));
    }


    public function editar(ClienteRequest $request){

        $data = Clientes::find($request->id);
        $data->name = $request->name;
        $data->identificacion = $request->identificacion;
        $data->telefono = $request->telefono;
        $data->direccion = $request->direccion;
        $data->correo = $request->correo;
        $data->estatus = 1;

            $data->save();
            return Redirect::route('clientes');
    }

}
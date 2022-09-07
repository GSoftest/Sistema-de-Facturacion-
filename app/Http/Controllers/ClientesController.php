<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Clientes;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ClientesController extends Controller
{

    public function create(ClienteRequest $request)
    {
        try{
        $clientes = new Clientes();
        $clientes->name = $request->name;
        $clientes->identificacion = $request->identificacion;
        $clientes->telefono = $request->telefono;
        $clientes->direccion = $request->direccion;
        $clientes->correo = $request->correo;
        $clientes->estatus = 1;
        $clientes->save();
        Session::flash('notificacion', '¡El Cliente '.$clientes->name.' Ha Sido Registrado Exitosamente!');
        }catch(\Illuminate\Database\QueryException $e){
            Session::flash('advertencia', '¡El CLiente No Puede Ser Registrado!');
        }
         return Redirect::route('clientes');
    }

    public function show($id){

        $data = Clientes::find($id);
        return view('clientes.edit',compact('data'));
    }


    public function editar(ClienteRequest $request){

        try{
        $data = Clientes::find($request->id);
        $data->name = $request->name;
        $data->identificacion = $request->identificacion;
        $data->telefono = $request->telefono;
        $data->direccion = $request->direccion;
        $data->correo = $request->correo;
        $data->estatus = $data->estatus;
            $data->save();
            Session::flash('notificacion', '¡El Cliente '.$data->name.' Ha Sido Actualizado Exitosamente!');
        }catch(\Illuminate\Database\QueryException $e){
            Session::flash('advertencia', '¡El CLiente No Puede Ser Editado!');
        }
            return Redirect::route('clientes');
    }

}
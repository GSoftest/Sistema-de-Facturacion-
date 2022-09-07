<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProveedoresRequest;
use App\Models\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProveedoresController extends Controller
{
    public function create(ProveedoresRequest $request)
    {
        try {
        $clientes = new Proveedores();
        $clientes->name = $request->name;
        $clientes->phone_number = $request->phone_number;
        $clientes->email = $request->email;
        $clientes->status = 1;
        $clientes->save();
        Session::flash('message', 'Proveedor Registrado Exitosamente.');
        }catch(\Illuminate\Database\QueryException $e){
            Session::flash('message2', 'Proveedor No Puede Registrarse.');
        }
        return Redirect::route('proveedores');
    }

    public function show($id){

        $data = Proveedores::find($id);
        return view('proveedores.edit',compact('data'));
    }

    public function editar(ProveedoresRequest $request){

        try {
            $data = Proveedores::find($request->id);
            $data->name = $request->name;
            $data->phone_number = $request->phone_number;
            $data->email = $request->email;
            $data->status = $data->status;
            $data->save();
            Session::flash('message', 'Proveedor Actualizado Exitosamente.');
        }catch(\Illuminate\Database\QueryException $e){
            Session::flash('message2', 'Proveedor No Se Puede Editar.');
        }
            return Redirect::route('proveedores');
    }

}

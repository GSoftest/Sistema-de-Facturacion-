<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProveedoresRequest;
use App\Models\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProveedoresController extends Controller
{
    public function create(ProveedoresRequest $request)
    {
        $clientes = new Proveedores();
        $clientes->name = $request->name;
        $clientes->phone_number = $request->phone_number;
        $clientes->email = $request->email;
        $clientes->status = 1;
        $clientes->save();
         return Redirect::route('proveedores');
    }

    public function show($id){

        $data = Proveedores::find($id);
        return view('proveedores.edit',compact('data'));
    }

    public function editar(ProveedoresRequest $request){

        $data = Proveedores::find($request->id);
        $data->name = $request->name;
        $data->phone_number = $request->phone_number;
        $data->email = $request->email;
        $data->status = $data->status;

            $data->save();
            return Redirect::route('proveedores');
    }

}

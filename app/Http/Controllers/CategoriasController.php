<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class CategoriasController extends Controller
{
     public function create(CategoriaRequest $request)
     {
      try{
       $categorias = new Categorias();
       $categorias->name = $request->name;
       $categorias->descripcion = $request->descripcion;
       $categorias->save();
       Session::flash('notificacion', '¡Categoría Registrada Exitosamente!');
      }catch(\Illuminate\Database\QueryException $e){
        Session::flash('advertencia', '¡Categoría No Puede Ser Registrada!');
      }
       return Redirect::route('categorias');

     }

     public function show($id){

          $data = Categorias::find($id);
          return view('categorias.edit',compact('data'));
      }
     

      public function editar(CategoriaRequest $request){

        try{
        $data = Categorias::find($request->id);
        $data->name = $request->name;
        $data->descripcion = $request->descripcion;
        $data->save();
        Session::flash('notificacion', '¡Categoría Actualizada Exitosamente!');
      }catch(\Illuminate\Database\QueryException $e){
        Session::flash('advertencia', '¡Categoría No Puede Ser Editada!');
      }
            return Redirect::route('categorias');
    }
}
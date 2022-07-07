<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class CategoriasController extends Controller
{
     public function create(CategoriaRequest $request)
     {
        
       $categorias = new Categorias();
       $categorias->name = $request->name;
       $categorias->descripcion = $request->descripcion;
       
       // script para subir la imagen
     /*  if($request->hasFile("imagen")){

           $imagen = $request->file("imagen");
           $nombreimagen =  $imagen->getClientOriginalName();
           $ruta = public_path("app/archivos/categorias/");

           $imagen->move($ruta,$nombreimagen);
           $categorias->imagen = $nombreimagen;            
           
       }
*/
       $categorias->save();
       return Redirect::route('categorias');

     }

     public function show($id){

          $data = Categorias::find($id);
          return view('categorias.edit',compact('data'));
      }
     

      public function editar(CategoriaRequest $request){

        $data = Categorias::find($request->id);
        $data->name = $request->name;
        $data->descripcion = $request->descripcion;
      /*  if($request->hasFile("imagen")){
            /*****eliminar la img anterior */ 
         /*   unlink(public_path('app/archivos/categorias/'.$data->imagen));
            $imagen = $request->file("imagen");
            $nombreimagen =  $imagen->getClientOriginalName();
            $ruta = public_path("app/archivos/categorias/");
            $imagen->move($ruta,$nombreimagen);
            $data->imagen = $nombreimagen;       
        }*/
            $data->save();
            return Redirect::route('categorias');
    }
}
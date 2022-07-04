<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\Ivas;

class ProductosController extends Controller
{


    public function index()
    {
        $categorias = Categorias::all();
        $ivas = Ivas::all();

        $data = [
            'ivas' => $ivas,
            'categorias' => $categorias,
       ];

        return view('productos.create')->with($data);     
    }

    public function create(Request $request)
    {
        $productos = new Productos();
        $productos->name = $request->name;
        $productos->precio_sin_iva = $request->precio_sin_iva;
        $productos->costo_unitario = $request->costo_unitario;
        $productos->contenido_neto = $request->contenido_neto;
        $productos->unidad = $request->unidad;
        $productos->peso = $request->peso;
        $productos->altura = $request->altura;
        $productos->ancho = $request->ancho;
        $productos->longitud = $request->longitud;
        $productos->description = $request->description;
        $productos->upc = $request->upc;
        $productos->id_categoria = $request->id_categoria;
        $productos->exento = $request->exento;

        if($request->hasFile("imagen_url")){

           $imagen = $request->file("imagen_url");
           $nombreimagen =  $imagen->getClientOriginalName();
           $ruta = public_path("app/archivos/productos/");

           $imagen->move($ruta,$nombreimagen);
           $productos->imagen_url = $nombreimagen;
        }

        $productos->save();
         return Redirect::route('productos');
    }


    public function show($id){

       
        $categorias = Categorias::all();
        $ivas = Ivas::all();
        $producto = Productos::find($id);

        $data = [
            'ivas' => $ivas,
            'categorias' => $categorias,
            'producto' => $producto
       ];

        return view('productos.edit')->with($data);
    }


    public function editar(Request $request){

       
        $producto = Productos::find($request->id);
        $producto->name = $request->name;

        $producto->precio_sin_iva = $request->precio_sin_iva;
        $producto->costo_unitario = $request->costo_unitario;
        $producto->contenido_neto = $request->contenido_neto;
        $producto->unidad = $request->unidad;
        $producto->peso = $request->peso;
        $producto->altura = $request->altura;
        $producto->ancho = $request->ancho;
        $producto->longitud = $request->longitud;
        $producto->description = $request->description;
        $producto->upc = $request->upc;
        $producto->id_categoria = $request->id_categoria;
        $producto->exento = $request->exento;

        if($request->hasFile("imagen_url")){
            /*****eliminar la img anterior */ 
            unlink(public_path('app/archivos/productos/'.$producto->imagen));
            $imagen = $request->file("imagen_url");
            $nombreimagen =  $imagen->getClientOriginalName();
            $ruta = public_path("app/archivos/productos/");
            $imagen->move($ruta,$nombreimagen);
            $producto->imagen = $nombreimagen;
        }
            $producto->save();
            return Redirect::route('productos');



    }
    

}
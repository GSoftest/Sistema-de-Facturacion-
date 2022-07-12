<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Models\Productos;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\Ivas;
use App\Models\Medidas;

class ProductosController extends Controller
{


    public function index()
    {
        $categorias = Categorias::all();
        $medidas = Medidas::all();
        $ivas = Ivas::all();

        $data = [
            'ivas' => $ivas,
            'categorias' => $categorias,
            'medidas' => $medidas,
       ];

        return view('productos.create')->with($data);     
    }

    public function create(ProductoRequest $request)
    {
      
        $productos = new Productos();
        $productos->name = $request->name;

        $productos->contenido_neto = $request->contenido_neto;
        $productos->unidad = $request->unidad;
        $productos->altura = $request->altura;
        $productos->ancho = $request->ancho;
        $productos->description = $request->description;
        $productos->upc = $request->upc;
        $productos->id_categoria = $request->id_categoria;
        $productos->id_medida = $request->medida;
        $productos->exento = $request->exento;



        $productos->precio_sin_iva = str_replace(",",".",$request->precio_sin_iva);
        $productos->costo_unitario = str_replace(",",".",$request->costo_unitario);

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
        $medidas = Medidas::all();
        $producto = Productos::find($id);

        $producto->precio_sin_iva = number_format($producto->precio_sin_iva, 2);
        $producto->precio_sin_iva = str_replace(",","",$producto->precio_sin_iva);
        $producto->precio_sin_iva = str_replace(".",",",$producto->precio_sin_iva);


        $producto->costo_unitario = number_format($producto->costo_unitario, 2);
        $producto->costo_unitario = str_replace(",","",$producto->costo_unitario);
        $producto->costo_unitario = str_replace(".",",",$producto->costo_unitario);

        $data = [
            'ivas' => $ivas,
            'categorias' => $categorias,
            'medidas' => $medidas,
            'producto' => $producto
       ];

        return view('productos.edit')->with($data);
    }


    public function editar(ProductoRequest $request){

       
        $producto = Productos::find($request->id);
        $producto->name = $request->name;

        $producto->contenido_neto = $request->contenido_neto;
        $producto->unidad = $request->unidad;
        $producto->altura = $request->altura;
        $producto->ancho = $request->ancho;
        $producto->description = $request->description;
        $producto->upc = $request->upc;
        $producto->id_categoria = $request->id_categoria;
        $producto->exento = $request->exento;
        $producto->id_medida = $request->medida;


        $producto->precio_sin_iva = str_replace(",",".",$request->precio_sin_iva);
        $producto->costo_unitario = str_replace(",",".",$request->costo_unitario);

        if($request->hasFile("imagen_url")){
            /*****eliminar la img anterior */ 

            if($producto->imagen!= null){
            unlink(public_path('app/archivos/productos/'.$producto->imagen));
            }
            $imagen = $request->file("imagen_url");
            $nombreimagen =  $imagen->getClientOriginalName();
            $ruta = public_path("app/archivos/productos/");
            $imagen->move($ruta,$nombreimagen);
            $producto->imagen_url = $nombreimagen;
            
        }
            $producto->save();
            return Redirect::route('productos');



    }
    

}
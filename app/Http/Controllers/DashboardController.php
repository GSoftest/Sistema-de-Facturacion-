<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Ivas;
use App\Models\Productos;
use App\Models\Clientes;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $ivas = Ivas::count();
        $categorias = Categorias::count();
        $productos = Productos::count();
        $clientes = Clientes::count();



       $data = [
            'ivas' => $ivas,
            'categorias' => $categorias,
            'productos' => $productos,
            'clientes' => $clientes,
       ];

        return view('dashboard')->with($data);

    }


    

}

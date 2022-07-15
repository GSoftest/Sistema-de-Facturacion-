<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Ivas;
use App\Models\Productos;
use App\Models\Clientes;
use Illuminate\Http\Request;
use Goutte\Client;
use App\Models\Tasa_BCV;

class DashboardController extends Controller
{
    public function index(Request $request){

        $ivas = Ivas::count();
        $categorias = Categorias::count();
        $productos = Productos::count();
        $clientes = Clientes::count();


       $url_to_traverse = 'http://www.bcv.org.ve/';
       $client = new Client();
       $crawler = $client->request('GET', $url_to_traverse);
       $tasa = $crawler->filter('#dolar')->first()->text();
       $request->tasa = $tasa;
        $tasadeldia = Tasa_BCV::all();
        if(count($tasadeldia) == 0){
            $Tasa_BCV = new Tasa_BCV();
            $Tasa_BCV->tasa = $request->tasa ;
            $Tasa_BCV->save();
        }else{
           $data = Tasa_BCV::find($tasadeldia[0]->id);
           $data->tasa = $request->tasa;
           $data->save();
        }



       $data = [
            'ivas' => $ivas,
            'categorias' => $categorias,
            'productos' => $productos,
            'clientes' => $clientes,
            'tasadeldia' => $tasadeldia,
       ];

        return view('dashboard')->with($data);

    }


    

}

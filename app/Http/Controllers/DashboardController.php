<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Ivas;
use App\Models\Productos;
use App\Models\Clientes;
use Illuminate\Http\Request;
use Goutte\Client;
use App\Models\Tasa_BCV;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index(Request $request){

        $ivas = Ivas::count();
        $categorias = Categorias::count();
        $productos = Productos::count();
        $clientes = Clientes::count();


       $url_to_traverse = 'http://www.bcv.org.ve/';


       $file_headers = @get_headers($url_to_traverse ); 
  
if($file_headers !=  false){ 
    
    if($file_headers[0] ==  "HTTP/1.1 200 OK"){ 
       $client = new Client();

       $crawler = $client->request('GET', $url_to_traverse);



       $tasa = $crawler->filter('#dolar')->first()->text();
       $fecha = $crawler->filter('div.pull-right.dinpro.center span.date-display-single')->first()->attr('content');
       $fecha = explode('T',$fecha);
       $fechaActual = explode('T',date(DATE_ATOM));

        $request->tasa = $tasa;
        $tasadeldia = Tasa_BCV::all();
    
        if($fecha[0] == $fechaActual[0]){
            

        if(count($tasadeldia) == 0){
            $Tasa_BCV = new Tasa_BCV();
            $Tasa_BCV->tasa = $request->tasa ;
            $Tasa_BCV->save();
        }else{
           $data = Tasa_BCV::find($tasadeldia[0]->id);
           $data->tasa = $request->tasa;
           $data->save();
        }
      }

    }else{
        $tasadeldia = '';
    }

}else{
    $tasadeldia = '';
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

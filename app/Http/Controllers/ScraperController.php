<?php

namespace App\Http\Controllers;

use Goutte\Client;
use App\Models\Tasa_BCV;
use Illuminate\Support\Facades\Redirect;

class ScraperController extends Controller
{
    public $teste;

    public function scraper(){

        
       $url_to_traverse = 'http://www.bcv.org.ve/';
       $client = new Client();
       $crawler = $client->request('GET', $url_to_traverse);
       $tasa = $crawler->filter('#dolar')->first()->text();
      // $fecha = $crawler->filter('.view-content .views-row .pull-right')->first()->text();
        dd($tasa);

        $tasadeldia = Tasa_BCV::all();
        if(count($tasadeldia) == 0){
            $Tasa_BCV = new Tasa_BCV();
            $Tasa_BCV->tasa = $tasa;
          //  $Tasa_BCV->fecha = $fecha;
            $Tasa_BCV->save();
        }else{
           
        }

        return Redirect::route('dashboard');
        
    }
}

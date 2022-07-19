<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Tasa_BCV;
use App\Models\Tasa_Otros;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $tasadeldiaBCV = Tasa_BCV::all();
        $tasadeldiaotros = Tasa_Otros::where('estatus',1)->first();

        

        if($tasadeldiaotros){
            View::share('tasa_del_dia', $tasadeldiaotros->tasa);
        }else{
            $tasadia = str_replace("USD ","",$tasadeldiaBCV[0]->tasa);
            $tasadia = str_replace(",",".",$tasadia);
            $tasadia =(float)$tasadia;
            View::share('tasa_del_dia', $tasadia);
        }
        
        View::share('tasa_BCV', $tasadeldiaBCV[0]->tasa);
        
    }
}

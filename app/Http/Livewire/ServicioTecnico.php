<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Clientes;
use App\Models\Ivas;
use App\Models\Tasa_BCV;
use App\Models\Tasa_Otros;
use App\Models\Servicio_Tecnico;
use App\Models\Facturas_servicios;
use App\Models\Recibo;
use App\Http\Livewire\App;
use Illuminate\Support\Facades\App as FacadesApp;
use Symfony\Component\Console\Output\NullOutput;

class ServicioTecnico extends Component
{

    public $identificacion,
    $name,
    $cliente,
    $id_iva,
    $id_cliente,
    $monto_sin_iva,
    $monto_con_iva,
    $monto,
    $abono,
    $monto_pendiente,
    $monto_pendiente_dolar,
    $recibo,
    $descripcion_equipo,
    $fecha,
    $item,
    $factura,
    $monto_con_iva_dolar,
    $abono_dolar,
    $idrecibo,
    $urlpdf,
    $abonodolarbs,
    $habilitarAbono,
    $habilitarAbonoDolar,
    $botoncliente,
    $Nombrepdf;

    public $confirmingUserDeletion = false;

    public function render()
    {

        $habilitarAbono = true;
        $habilitarAbonoDolar = true;


        $data = Ivas::All();

        /*************selección de iva********* */
        if($this->monto_sin_iva != null && $this->id_iva != null){
            foreach($data as $item){
                if($this->id_iva==$item['id']){
                    $iva = $item['iva'];
                   
                }
            }

       //     $existe = strrpos($this->monto_sin_iva, '.');
    //dd($this->monto_sin_iva);
         //   if($existe == false){
            $this->MontoConIva($iva);
            $this->resetValidation();
          /* }else{
            $this->monto_con_iva =  '';
           }*/
        }


         /*************Campo Abono********* */
  
        /* if($this->abono != null  && $this->abono_dolar != null){

            $this->abono =  '';
            $this->abono_dolar =  '';
            $this->monto_pendiente =  '0,00';
            $this->monto_pendiente_dolar =  '0,00';

         }else if($this->abono == null  && $this->abono_dolar == null){

            $this->abono =  '';
            $this->abono_dolar =  '';
            $this->monto_pendiente =  '0,00';
            $this->monto_pendiente_dolar =  '0,00';

         }else*/ if($this->abono == $this->monto_con_iva){

            $this->monto_pendiente =  '0,00';
            $this->monto_pendiente_dolar =  '0,00';

         }else if($this->abono_dolar == $this->monto_con_iva_dolar){

            $this->monto_pendiente =  '0,00';
            $this->monto_pendiente_dolar =  '0,00';

         }
         

         if($this->abono_dolar != null){
            $habilitarAbono = false;
            $habilitarAbonoDolar = true;
            $this->abono = '';
         }else if($this->abono != null){
            $habilitarAbono = true;
            $habilitarAbonoDolar = false;
            $this->abono_dolar = '';
         }
         
         

      
         if($this->abono != null || $this->abono_dolar != null){
            $this->montoPendiente();
         }



         /*************Botón de factura***************** */
       /*  if($this->monto_con_iva != null){

            $existe =  str_replace(","," ",$this->abono);
            $existe = str_replace(".","",$this->abono);
            $existe = (float) str_replace(" ",".",$existe);

            $existeiva = str_replace(","," ",$this->monto_con_iva);
            $existeiva = str_replace(".","",$this->monto_con_iva);
            $existeiva = (float) str_replace(" ",".",$existeiva);

            $existe2 = str_replace(","," ",$this->abono_dolar);
            $existe2 = str_replace(".","",$this->abono_dolar);
            $existe2 = (float) str_replace(" ",".",$existe2);

            $existeiva2 = str_replace(","," ",$this->monto_con_iva_dolar);
            $existeiva2 = str_replace(".","",$this->monto_con_iva_dolar);
            $existeiva2 = (float) str_replace(" ",".",$existeiva2);
           
            //$existeP = strrpos($this->monto_pendiente, "-");
    
            if($existe == $existeiva || $existe2 == $existeiva2){
                $factura = 'true';

            }/*else if($existe > $existeiva || $existe2 > $existeiva2){
                $factura = 'ninguno';

            }else if($existe == null || $existe2 == null){
                $factura = 'ninguno';
                
            }*//*else{
                $factura = 'false';
            }*/

       /* }else{
            $factura = 'ninguno';
        }*/

        
           // $this->factura = 'ninguno';
            $this->habilitarAbono = $habilitarAbono;
            $this->habilitarAbonoDolar = $habilitarAbonoDolar;
            date_default_timezone_set('America/Caracas');

        return view('livewire.servicio-tecnico',
        ['ivas'  => $data,
        'monto_con_iva' => 0,
        'fecha_servicio' =>  date('d/m/Y'),
    ]);

    }



    public function Buscar()
    {
     $cliente = Clientes::where('identificacion',$this->identificacion)
                         ->get();

     if (isset($cliente[0])) {

        if($cliente[0]->estatus == 1){

    $this->id_cliente=  $cliente[0]->id;
    $this->name=  $cliente[0]->name;
    $this->telefono =  $cliente[0]->telefono;
    $this->direccion =  $cliente[0]->direccion;
    $this->correo =  $cliente[0]->correo;

     $this->view = 'livewire.servicio-tecnico';

    }else{
        session()->flash('message', 'El cliente se encuentra desactivado');
        $this->botoncliente = 'false';
        $this->view = 'livewire.servicio-tecnico';
    }

    }else{
        session()->flash('message', 'No se encuentra registrado debe registrar el cliente');
        $this->botoncliente = 'true';
        $this->view = 'livewire.servicio-tecnico';
    }
    
    }
    
    public function change(){
        if ($this->id_iva != '') {
        $rules = ['monto_sin_iva' => 'required',];
        $messages = [
            'monto_sin_iva.required' =>'Obligatorio',
        ];

        $this->validate($rules, $messages);
       
        $iva = Ivas::find($this->id_iva);
      
            if ($this->monto_sin_iva != '' && $this->monto_sin_iva != 0 ) {

                //$existe = strrpos($this->monto_sin_iva, '.');
              //  dd( $existe);
               // if($existe == false){
                $this->MontoConIva($iva->iva);
              /* }else{
                $this->monto_con_iva =  '';
               }*/

            }else{
                $this->monto_con_iva =  '';
            }
        }else{
            $this->monto_con_iva =  '';
        }

    }

    public function MontoConIva($iva){

       
        $monto = $this->monto_sin_iva;
      
        $monto = str_replace(".","",$monto);
        $monto = str_replace(",",".",$monto);

        $monto_con_iva = ($iva*$monto)/100;


      //  dd( $this->monto_sin_iva);

        $this->monto_con_iva = bcdiv($monto+$monto_con_iva, '1', 2);
       
        $existe = strrpos($this->monto_con_iva, ',');

        $tasadeldiaBCV = Tasa_BCV::all();
        $tasadeldiaotros = Tasa_Otros::where('estatus',1)->first();

        if($tasadeldiaotros){
            $tasadia =   $tasadeldiaotros->tasa; 
        }else{
            $tasadia = str_replace("USD ","",$tasadeldiaBCV[0]->tasa);
            $tasadia = str_replace(",",".",$tasadia);
           
        }

        $tasadia = $tasadia;

        $this->monto_con_iva_dolar = ($this->monto_con_iva*1)/$tasadia;
        
     //  dd($this->monto_con_iva);
       /*if($existe != false){
        $this->monto_con_iva = str_replace(",","",$this->monto_con_iva);
       }*/

       $this->monto_con_iva = number_format($this->monto_con_iva, 2);
       $this->monto_con_iva = str_replace(","," ",$this->monto_con_iva);
       $this->monto_con_iva = str_replace(".",",",$this->monto_con_iva);
       $this->monto_con_iva = str_replace(" ",".",$this->monto_con_iva);

      // $this->monto_con_iva = str_replace(".",",",$this->monto_con_iva);
      $this->monto_con_iva_dolar = number_format($this->monto_con_iva_dolar, 2);
      $this->monto_con_iva_dolar = str_replace(","," ",$this->monto_con_iva_dolar);
      $this->monto_con_iva_dolar = str_replace(".",",",$this->monto_con_iva_dolar);
      $this->monto_con_iva_dolar = str_replace(" ",".",$this->monto_con_iva_dolar);
      // $this->monto_con_iva_dolar =   bcdiv($this->monto_con_iva_dolar, '1', 2);
      // $this->monto_con_iva_dolar = str_replace(".",",",$this->monto_con_iva_dolar);

    }




public function montoPendiente(){
   if($this->monto_con_iva != null){


        $mont = str_replace(".","",$this->monto_con_iva);
        $mont = str_replace(",",".",$mont);

        $montDolar = str_replace(".","",$this->monto_con_iva_dolar);
        $montDolar = str_replace(",",".",$montDolar);
       // $mont = str_replace(",",".",$this->monto_con_iva);
       // $montDolar = str_replace(",",".",$this->monto_con_iva_dolar);

       $montAbono = str_replace(".","",$this->abono);
       $montAbono = str_replace(",",".",$montAbono);

       $montAbonodolar = str_replace(".","",$this->abono_dolar);
       $montAbonodolar = str_replace(",",".",$montAbonodolar);

      //  $montAbono = str_replace(",",".",$this->abono);
      //  $montAbonodolar = str_replace(",",".",$this->abono_dolar);

        $tasadeldiaBCV = Tasa_BCV::all();
        $tasadeldiaotros = Tasa_Otros::where('estatus',1)->first();

        if($tasadeldiaotros){
            $tasadia = $tasadeldiaotros->tasa; 
        }else{
            $tasadia = str_replace("USD ","",$tasadeldiaBCV[0]->tasa);
            $tasadia = str_replace(",",".",$tasadia);
        }


        if($montAbono != null){
            
            $pendiente = $mont-$montAbono;
            $this->monto_pendiente_dolar = ($pendiente*1)/$tasadia;

            $this->monto_pendiente = number_format($pendiente, 2);
            $this->monto_pendiente = str_replace("."," ",$this->monto_pendiente);
            $this->monto_pendiente = str_replace(",",".",$this->monto_pendiente);
            $this->monto_pendiente = str_replace(" ",",",$this->monto_pendiente);

            $this->monto_pendiente_dolar = number_format($this->monto_pendiente_dolar,2) ;
            $this->monto_pendiente_dolar = str_replace("."," ",$this->monto_pendiente_dolar);
            $this->monto_pendiente_dolar = str_replace(",",".",$this->monto_pendiente_dolar);
            $this->monto_pendiente_dolar = str_replace(" ",",",$this->monto_pendiente_dolar);

        }else if($montAbonodolar != null){

            $pendiente = $montDolar-$montAbonodolar;
        
            $this->monto_pendiente_dolar =  number_format($pendiente, 2);
            
            $this->monto_pendiente_dolar = str_replace("."," ",$this->monto_pendiente_dolar);
            $this->monto_pendiente_dolar = str_replace(",",".",$this->monto_pendiente_dolar);
            $this->monto_pendiente_dolar = str_replace(" ",",",$this->monto_pendiente_dolar);
           

            /********************* */

            $abonodolarbs = ($montAbonodolar*$tasadia)/1;
            
            $this->abonodolarbs =  $abonodolarbs;
            $this->monto_pendiente = ($mont-$abonodolarbs);
            $this->monto_pendiente =  number_format($this->monto_pendiente, 2);
            $this->monto_pendiente = str_replace("."," ",$this->monto_pendiente);
            $this->monto_pendiente = str_replace(",",".",$this->monto_pendiente);
            $this->monto_pendiente = str_replace(" ",",",$this->monto_pendiente);

            $this->abonodolarbs =  number_format($this->abonodolarbs, 2);
            $this->abonodolarbs = str_replace("."," ",$this->abonodolarbs);
            $this->abonodolarbs = str_replace(",",".",$this->abonodolarbs);
            $this->abonodolarbs = str_replace(" ",",",$this->abonodolarbs);

        }


        if($this->monto_pendiente == '0,00'){

            $this->monto_pendiente_dolar = '0,00';
            $this->factura = 'true';

        }else if($this->monto_pendiente_dolar == '0,00'){

            $this->monto_pendiente = '0,00';
            $this->factura = 'true';

        }else if($montAbono > $mont){
            $this->factura = 'ninguno';

        }else if($montAbonodolar > $montDolar){
            $this->factura = 'ninguno';
        }else{
            $this->factura = 'false';
        }

//dd(strrpos($this->monto_pendiente, '-'));

      /*  $existependiente = strrpos($this->monto_pendiente, '-');

       /* if($existependiente == false){
            $this->factura = 'false';
        }else if($existependiente == true){
            $this->factura = 'ninguno';
        }*/
    
    }
}
     public function default()
{


    $this->identificacion = '';
    $this->name = '';
    $this->telefono = '';
    $this->recibo = '';
    $this->id_cliente = '';
    $this->id_iva = '';
    $this->correo = '';
    $this->direccion = '';
    $this->descripcion_equipo = '';
    $this->monto_sin_iva = '';
    $this->monto_con_iva = '';
    $this->monto_con_iva_dolar = '';
    $this->abono = '';
    $this->abono_dolar = '';
    $this->monto_pendiente = '';
    $this->monto_pendiente_dolar = '';
    $this->view = 'livewire.servicio-tecnico';
}

public function submit(){



if($this->identificacion != null){
    /**********se guarda el registro en la tabla factura************** */
        if($this->factura === 'true'){
            $ultimaFactura = Facturas_servicios::orderBy('numero_factura', 'desc')->first();
            $Factura = new Facturas_servicios();
            if($ultimaFactura == null){
                $Factura->numero_factura = 1;
                $Factura->pdf = 'Factura'.$Factura->numero_factura.'.pdf';
            }else{
                $Factura->numero_factura = $ultimaFactura->numero_factura+1;
                $Factura->pdf = 'Factura'.$Factura->numero_factura.'.pdf';
            }
            
            $Factura->save();
            $facturanu = Facturas_servicios::selectRaw('numero_factura, lpad(numero_factura, 15, 0), id')->where('pdf',$Factura->pdf)->first();
            $facturanumero = $facturanu['lpad(numero_factura, 15, 0)'];
            $idfactura = $facturanu['id'];
            $this->idrecibo = '0';
            $recibonumero = '';
    
         }else{
    
            /**********se guarda el registro en la tabla recibo************** */
            $ultimaRecibo = Recibo::orderBy('recibo', 'desc')->first();
            $Recibo = new Recibo();
    
           if($ultimaRecibo == null){
            $Recibo->recibo = 1;
            $Recibo->pdf = 'Recibo'.$Recibo->recibo.'.pdf';
            }else{
                $Recibo->recibo = $ultimaRecibo->recibo+1;
                $Recibo->pdf = 'Recibo'.$Recibo->recibo.'.pdf';
            }
    
           $Recibo->save();
           $recibonu = Recibo::selectRaw('recibo, lpad(recibo, 15, 0), id')->where('pdf',$Recibo->pdf)->first();
           $recibonumero = $recibonu['lpad(recibo, 15, 0)'];
           $this->idrecibo = $recibonu['id'];
           $idfactura = '0';
           $facturanumero = '';
        }
    
    
          /**********se calcula el monto del iva************** */
    
         // $monto_con_iva = str_replace(",",".",$this->monto_con_iva);
          $monto_con_iva = str_replace(".","",$this->monto_con_iva);
          $monto_con_iva = str_replace(",",".",$monto_con_iva);


         // $monto_sin_iva = str_replace(",",".",$this->monto_sin_iva);
          $monto_sin_iva = str_replace(".","",$this->monto_sin_iva);
          $monto_sin_iva = str_replace(",",".",$monto_sin_iva);

          $montoIva = ($monto_con_iva-$monto_sin_iva);
          $montoIva = number_format($montoIva, 2);
          $montoIva = str_replace("."," ",$montoIva);
          $montoIva = str_replace(",",".",$montoIva);
          $montoIva = str_replace(" ",",",$montoIva);


          $porcentajeIva = Ivas::find($this->id_iva);
          $porcentajeIva = $porcentajeIva->iva;


    
        /**********se guarda el registro en la tabla servicio técnico************** */
        date_default_timezone_set('America/Caracas');
        
   // $date = date('d-m-Y'));
    
    $Servicio_Tecnico = new Servicio_Tecnico();
    $Servicio_Tecnico->id_recibo = $this->idrecibo;
    $Servicio_Tecnico->id_cliente = $this->id_cliente;
    $Servicio_Tecnico->id_iva =$this->id_iva;
    $Servicio_Tecnico->id_factura_servicios = $idfactura;
    $Servicio_Tecnico->descripcion_equipo = $this->descripcion_equipo;
    $Servicio_Tecnico->monto_sin_iva = $this->monto_sin_iva;
    $Servicio_Tecnico->monto_con_iva = $this->monto_con_iva;

   
    if($this->abono == null){

        $Servicio_Tecnico->abono = $this->abonodolarbs;
        $abono = $this->abonodolarbs;
        
    }else{
      
    $Servicio_Tecnico->abono = $this->abono;
    $abono = $this->abono;
    }

    $Servicio_Tecnico->monto_pendiente = $this->monto_pendiente;
    $Servicio_Tecnico->fecha = date("Y-m-d h:i:s");
    $Servicio_Tecnico->save();
  
    
    /**********se crea el pdf************** */
    $pdf = app('dompdf.wrapper');
        $datapdf = [
            'fecha_servicio' => date("d/m/Y"),
            'hora' => date("h:i:s"),
            'name' => $this->name,
            'identificacion' => $this->identificacion,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'descripcion_equipo' => $this->descripcion_equipo,
            'monto_sin_iva' => $this->monto_sin_iva,
            'monto_con_iva' => $this->monto_con_iva,
            'abono' => $abono,
            'monto_pendiente' => $this->monto_pendiente,
            'montoIva' => $montoIva,
            'factura' => $facturanumero,
            'recibo' => $recibonumero,
            'porcentajeIva' => $porcentajeIva,
        ];
    
    
        if($this->factura === 'true'){
            $pdf->loadView('pdf.factura_servicio',compact('datapdf'));
            $pdf->save(public_path('app/archivos/pdf/facturas/') .$Factura->pdf);
            $this->urlpdf='app/archivos/pdf/facturas/'.$Factura->pdf;
            $this->Nombrepdf= $Factura->pdf;
        }else{
            $pdf->loadView('pdf.recibo_servicio',compact('datapdf'));
            $pdf->save(public_path('app/archivos/pdf/facturas/') .$Recibo->pdf);
            $this->urlpdf='app/archivos/pdf/facturas/'.$Recibo->pdf;
            $this->Nombrepdf= $Recibo->pdf;
        }
    
        $pdf->render();
    
    /**********se habilita el modal y se limpia los input************** */
    $this->confirmingUserDeletion=true;
    $this->default();
    $this->factura='ninguno';

}else{
    session()->flash('message', 'Debe llenar los campos del cliente');
    $this->view = 'livewire.servicio-tecnico';
}

}

}




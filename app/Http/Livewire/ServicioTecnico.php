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
            $existe = strrpos($this->monto_sin_iva, '.');
    
            if($existe == false){
            $this->MontoConIva($iva);
            $this->resetValidation();
           }else{
            $this->monto_con_iva =  '';
           }
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
         if($this->monto_con_iva != null){

            $existe = str_replace(",",".",$this->abono);
            $existeiva = str_replace(",",".",$this->monto_con_iva);
            $existe2 = str_replace(",",".",$this->abono_dolar);
            $existeiva2 = str_replace(",",".",$this->monto_con_iva_dolar);

            if($existe == $existeiva || $existe2 == $existeiva2){
                $factura = 'true';
            }else if($existe < $existeiva || $existe2 < $existeiva2){
                if($existe > '0,00' || $existe2 > '0,00' ){
                    $factura = 'false';
                }else{
                    $factura = 'ninguno';
                }
            }/*else{
                $factura = 'false';
            }*/


        }else{
            $factura = 'ninguno';
        }


            $this->factura = $factura;
            $this->habilitarAbono = $habilitarAbono;
            $this->habilitarAbonoDolar = $habilitarAbonoDolar;
           
        return view('livewire.servicio-tecnico',
        ['ivas'  => $data,
        'monto_con_iva' => 0,
        'fecha_servicio' => date('d/m/Y'),
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
        $this->view = 'livewire.servicio-tecnico';
    }

    }else{
        session()->flash('message', 'No se encuentra registrado debe registrar el cliente');
        $this->view = 'livewire.servicio-tecnico';
    }
    
    }
    
    public function change(){
        if ($this->id_iva != '') {
        $rules = ['monto_sin_iva' => 'required|regex:/^[\d]+(\,[\d]{1,2})$/',];
        $messages = [
            'monto_sin_iva.required' => 'Obligatorio.',
            'monto_sin_iva.regex' =>'Formato válido 0,00',
        ];

        $this->validate($rules, $messages);
        
        $iva = Ivas::find($this->id_iva);

            if ($this->monto_sin_iva != '' && $this->monto_sin_iva != 0 ) {
                $existe = strrpos($this->monto_sin_iva, '.');
                if($existe == false){
                $this->MontoConIva($iva->iva);
               }else{
                $this->monto_con_iva =  '';
               }
            }else{
                $this->monto_con_iva =  '';
            }
        }else{
            $this->monto_con_iva =  '';
        }

    }

    public function MontoConIva($iva){

       
        $monto = $this->monto_sin_iva;
        $monto = str_replace(",",".",$monto);
        $monto_con_iva = ($iva*$monto)/100;
        $this->monto_con_iva = bcdiv($monto+$monto_con_iva, '1', 2); //number_format($monto+$monto_con_iva, 2);
        
        $existe = strrpos($this->monto_con_iva, ',');

        $tasadeldiaBCV = Tasa_BCV::all();
        $tasadeldiaotros = Tasa_Otros::where('estatus',1)->first();

        if($tasadeldiaotros){
            $tasadia =   $tasadeldiaotros; 
        }else{
            $tasadia = str_replace("USD ","",$tasadeldiaBCV[0]->tasa);
            $tasadia = str_replace(",",".",$tasadia);
           
        }

        $tasadia = $tasadia;
        //$tasadia = $tasadia;
       // $tasadia = bcdiv($tasadia, '1', 2);
       
        $this->monto_con_iva_dolar = ($this->monto_con_iva*1)/$tasadia;
        
        
       if($existe != false){
        $this->monto_con_iva = str_replace(",","",$this->monto_con_iva);
       }

       $this->monto_con_iva = str_replace(".",",",$this->monto_con_iva);
       $this->monto_con_iva_dolar =   bcdiv($this->monto_con_iva_dolar, '1', 2);
       $this->monto_con_iva_dolar = str_replace(".",",",$this->monto_con_iva_dolar);

    }




public function montoPendiente(){
   if($this->monto_con_iva != null){

        $mont = str_replace(",",".",$this->monto_con_iva);
        $montDolar = str_replace(",",".",$this->monto_con_iva_dolar);

        $montAbono = str_replace(",",".",$this->abono);
        $montAbonodolar = str_replace(",",".",$this->abono_dolar);

        $tasadeldiaBCV = Tasa_BCV::all();
        $tasadeldiaotros = Tasa_Otros::where('estatus',1)->first();

        if($tasadeldiaotros){
            $tasadia = $tasadeldiaotros; 
        }else{
            $tasadia = str_replace("USD ","",$tasadeldiaBCV[0]->tasa);
            $tasadia = str_replace(",",".",$tasadia);
        }


        if($montAbono != null){

            $pendiente = $mont-$montAbono;
            $this->monto_pendiente_dolar = ($pendiente*1)/$tasadia;
            $this->monto_pendiente = number_format($pendiente, 2);
            $this->monto_pendiente_dolar = number_format($this->monto_pendiente_dolar,2) ;
            $this->monto_pendiente_dolar = str_replace(".",",",$this->monto_pendiente_dolar);
            $this->monto_pendiente = str_replace(".",",",$this->monto_pendiente);


        }else if($montAbonodolar != null){

            $pendiente = $montDolar-$montAbonodolar;
        
            $this->monto_pendiente_dolar =  number_format($pendiente, 2);
            
          //  $this->monto_pendiente_dolar =  bcdiv($pendiente, '1', 2); 
            $this->monto_pendiente_dolar = str_replace(".",",",$this->monto_pendiente_dolar);

           

            /********************* */

            $abonodolarbs = ($montAbonodolar*$tasadia)/1;
            
            //$abonodolarbs = number_format($abonodolarbs, 2);
           // $this->abonodolarbs = bcdiv($abonodolarbs, '1', 2); 
            $this->abonodolarbs =  $abonodolarbs;


          //  $this->monto_pendiente = ($pendiente*$tasadia)/1;
            $this->monto_pendiente = ($mont-$abonodolarbs);
            $this->monto_pendiente =  number_format($this->monto_pendiente, 2);
         //   $this->monto_pendiente =  bcdiv($this->monto_pendiente, '1', 2); 
            $this->monto_pendiente = str_replace(".",",",$this->monto_pendiente);

        }


        if($this->monto_pendiente == '0,00'){
            $this->monto_pendiente_dolar = '0,00';
        }else if($this->monto_pendiente_dolar == '0,00'){
            $this->monto_pendiente = '0,00';
        }
        /*$this->monto_pendiente_dolar = ($this->monto_pendiente*1)/$tasadia;
        $this->monto_pendiente_dolar = number_format($this->monto_pendiente_dolar, 2);

        $this->monto_pendiente = str_replace(".",",",$this->monto_pendiente);
        $this->abono_dolar = '';*/
        

    }
}


 /*   public function calculo(){
        if ($this->monto_con_iva != '' && $this->monto_con_iva != 0 ) {
        $monto_pendiente = ($this->monto_con_iva-$this->abono);
        $this->monto_pendiente =  $monto_pendiente;

        if($this->monto_pendiente == 0){
            $factura = true;
            }else{
                 $factura = false;
            }
            $this->factura = $factura;


        $this->view = 'livewire.servicio-tecnico';
        }
     }*/


    public function guardar(){

   
    

      /*  if ($this->recibo != '' && $this->recibo != 0 ) {
            $recibo = Servicio_Tecnico::where('recibo', $this->recibo)->exists();
*/
           /* if ($recibo) {
                session()->flash('message', 'El recibo ya se encuentra registrado');
                $this->view = 'livewire.servicio-tecnico';
                
            }else{*/
          /*      Servicio_Tecnico::create([
                'recibo' => '00000001',
                'id_cliente' => $this->id_cliente,
                'id_iva' => $this->id_iva,
                'descripcion_equipo' => $this->descripcion_equipo,
                'fecha' => $this->fecha,
                'monto_sin_iva' => $this->monto_sin_iva,
                'monto_con_iva' => $this->monto_con_iva,
                'abono' => $this->abono,
                'monto_pendiente' => $this->monto_pendiente
                ]);*/
       /*     }
*/


      /*  }else{
            //session()->flash('message', 'El n° de recibo es obligatorio');
          //  $this->view = 'livewire.servicio-tecnico';
        }*/

   /* $pdf = app('dompdf.wrapper');
    $pdf->loadView('pdf.factura_venta');
    return $pdf->streamDownload('prueba.pdf');
*/

    /*
    return response()->streamDownload(function () {
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pdf.factura_venta');
        $pdf->stream();
    }, 'prueba.pdf');*/

    /*public function DownloadNotes(PDF $p) { 
        $note = AcademyLessonNote::where('user_id',auth()->user()->id)->first(); 
        if($note){ 
            $pdf = $p->loadView('pdf.notesPdf',compact('note'))->output(); 
            return response()->streamDownload(function () use ($pdf) { print($pdf); }, md5(time()).".pdf"); 
        } }}*/

      //  $this->default();

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


/*public function buttonImprimir(){

    if($this->monto_pendiente == 0){
            $imprimir = true;
    }else{
        $imprimir = false;
    }
    $this->imprimir = $imprimir;
    $this->view = 'livewire.servicio-tecnico';
}*/


public function submit(){

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
    
          $monto_con_iva = str_replace(",",".",$this->monto_con_iva);
          $monto_sin_iva = str_replace(",",".",$this->monto_sin_iva);
      
          $montoIva = ($monto_con_iva-$monto_sin_iva);
          $porcentajeIva = Ivas::find($this->id_iva);
          $porcentajeIva = $porcentajeIva->iva;


    
        /**********se guarda el registro en la tabla servicio técnico************** */
    
    $date = str_replace('/', '-', date('d/m/Y'));
    
    $Servicio_Tecnico = new Servicio_Tecnico();
    $Servicio_Tecnico->id_recibo = $this->idrecibo;
    $Servicio_Tecnico->id_cliente = $this->id_cliente;
    $Servicio_Tecnico->id_iva =$this->id_iva;
    $Servicio_Tecnico->id_factura_servicios = $idfactura;
    $Servicio_Tecnico->descripcion_equipo = $this->descripcion_equipo;
    $Servicio_Tecnico->monto_sin_iva = $this->monto_sin_iva;
    $Servicio_Tecnico->monto_con_iva = $this->monto_con_iva;

   
    if($this->abono == null){
        $Servicio_Tecnico->abono = str_replace(".",",",$this->abonodolarbs);
        $abono = bcdiv($this->abonodolarbs, '1', 2);
    }else{
    $Servicio_Tecnico->abono = $this->abono;
    $abono = $this->abono;
    }

    $Servicio_Tecnico->monto_pendiente = $this->monto_pendiente;
    $Servicio_Tecnico->fecha = date("Y-m-d",strtotime( $date ));
    $Servicio_Tecnico->save();
  
    
    /**********se crea el pdf************** */
    $pdf = app('dompdf.wrapper');
        $datapdf = [
            'fecha_servicio' => date('d/m/Y'),
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
    }



    public function convertidor_decimal(){
      //  dd( $this->monto_sin_iva);
        
      /*  for ($dd = 2; $dd > 0; $dd--) {
            $cad3 += nums[nums.length - $dd]
        }*/


    }

}




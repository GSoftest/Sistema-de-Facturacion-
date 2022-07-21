<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Clientes;
use App\Models\Ivas;
use App\Models\Tasa_BCV;
use App\Models\Tasa_Otros;
use App\Models\Servicio_Tecnico;
use App\Http\Livewire\App;
use Illuminate\Support\Facades\App as FacadesApp;

class ServicioTecnico extends Component
{

    public $identificacion,
    $name,
    $cliente,
    $id_iva,
    $id_cliente,
    $monto_sin_iva,
    $monto_con_iva,
    $monto,$abono,
    $monto_pendiente,
    $recibo,
    $descripcion_equipo,
    $fecha,
    $item,
    $factura,
    $monto_con_iva_dolar,
    $abono_dolar;



    public function render()
    {

        $data = Ivas::All();
       /* if($this->id_iva!=''){
            foreach($data as $item){
                if($this->id_iva==$item['id'] && $this->monto_con_iva != '' && $this->monto_con_iva != 0){
                    $this->id_iva = '';
                }
            }
        }
*/

     /*   if ($this->monto_con_iva != '' && $this->monto_con_iva != 0 ) {
            //dd($this->abono);

            if ($this->abono != null) {
            $monto_pendiente = ($this->monto_con_iva-$this->abono);
            $this->monto_pendiente =  $monto_pendiente;
            }else{
                $this->monto_pendiente = '';
            }

            if($this->monto_pendiente == 0){
                $factura = true;
            }else{
                $factura = false;
            }
                $this->factura = $factura;
    
    
            $this->view = 'livewire.servicio-tecnico';
            }*/

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

         if($this->abono != null  && $this->abono_dolar != null){

            $this->abono =  '';
            $this->abono_dolar =  '';
            $this->monto_pendiente =  '';
            $this->monto_pendiente_dolar =  '';

         }else if($this->abono != null && $this->monto_con_iva > $this->abono){
            $this->montoPendiente();
         }else if($this->abono_dolar != null && $this->monto_con_iva_dolar > $this->abono){
            $this->montoPendiente();
         }



        return view('livewire.servicio-tecnico',
        ['ivas'  => $data,
        'monto_con_iva' => 0,
        'monto_pendiente' => 0,
        'fecha_servicio' => date('d/m/Y'),
    ]);
    }




    public function Buscar()
    {
     $cliente = Clientes::where('identificacion',$this->identificacion)->get();

     if (isset($cliente[0])) {
    $this->id_cliente=  $cliente[0]->id;
    $this->name=  $cliente[0]->name;
    $this->telefono =  $cliente[0]->telefono;
    $this->direccion =  $cliente[0]->direccion;
    $this->correo =  $cliente[0]->correo;

     $this->view = 'livewire.servicio-tecnico';
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
  

        $tasadia = bcdiv($tasadia, '1', 2);
       
        $this->monto_con_iva_dolar = ($this->monto_con_iva*1)/$tasadia;
        
        
       if($existe != false){
        $this->monto_con_iva = str_replace(",","",$this->monto_con_iva);
       }

       $this->monto_con_iva = str_replace(".",",",$this->monto_con_iva);
       $this->monto_con_iva_dolar =  number_format($this->monto_con_iva_dolar, 2);
       $this->monto_con_iva_dolar = str_replace(".",",",$this->monto_con_iva_dolar);

    }




public function montoPendiente(){
   if($this->monto_con_iva != null){

        $mont = str_replace(",",".",$this->monto_con_iva);
        $montDolar = str_replace(",",".",$this->monto_con_iva_dolar);

        $tasadeldiaBCV = Tasa_BCV::all();
        $tasadeldiaotros = Tasa_Otros::where('estatus',1)->first();

        if($tasadeldiaotros){
            $tasadia = $tasadeldiaotros; 
        }else{
            $tasadia = str_replace("USD ","",$tasadeldiaBCV[0]->tasa);
            $tasadia = str_replace(",",".",$tasadia); 
        }

       
        if($this->abono != null){

            $montAbono = str_replace(",",".",$this->abono);
            $pendiente = $mont-$montAbono;

            $this->monto_pendiente_dolar = ($pendiente*1)/$tasadia;

            $this->monto_pendiente = number_format($pendiente, 2);
            $this->monto_pendiente_dolar = number_format($this->monto_pendiente_dolar, 2);
            $this->monto_pendiente_dolar = str_replace(".",",",$this->monto_pendiente_dolar);
            $this->monto_pendiente = str_replace(".",",",$this->monto_pendiente);


        }else if($this->abono_dolar != null){
            $montAbonodolar = str_replace(",",".",$this->abono_dolar);
            $pendiente = $montDolar-$montAbonodolar;
            
            $this->monto_pendiente = ($pendiente*$tasadia)/1;
           
            $this->monto_pendiente_dolar = number_format($pendiente, 2);
            $this->monto_pendiente = number_format($this->monto_pendiente, 2);
            $this->monto_pendiente = str_replace(".",",",$this->monto_pendiente);
            $this->monto_pendiente_dolar = str_replace(".",",",$this->monto_pendiente_dolar);


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
    $this->recibo = '';
    $this->id_cliente = '';
    $this->id_iva = '';
    $this->descripcion_equipo = '';
   // $this->fecha = '';
    $this->monto_sin_iva = '';
    $this->monto_con_iva = '';
    $this->abono = '';
    $this->monto_pendiente = '';

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


}




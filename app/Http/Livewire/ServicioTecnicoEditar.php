<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Servicio_Tecnico;
use App\Models\Ivas;
use App\Models\Clientes;
use App\Models\Tasa_BCV;
use App\Models\Tasa_Otros;
use App\Models\Facturas_servicios;
use App\Models\Recibo;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;

class ServicioTecnicoEditar extends Component
{
    public $id_cliente,$id_recibo,$Nombrepdf;
    public $urlpdf,$id_iva,$redireccionar;
    public $identificacion,$habilitarAbono,$habilitarAbonoDolar;
    public $fecha_servicio,$boton,$total,$totalDolares;
    public $post,$actualizar_abono,$actualizar_abono_dolar;
    public $confirmingUserDeletion = false;
 

      public function mount($id)
      {
        $Servicio_Tecnico = Servicio_Tecnico::find($id);
        $this->id_servicio = $Servicio_Tecnico->id;
        $this->id_cliente = $Servicio_Tecnico->id_cliente;
        $this->descripcion_equipo = $Servicio_Tecnico->descripcion_equipo;
        $this->monto_sin_iva = $Servicio_Tecnico->monto_sin_iva;
        $this->monto_con_iva = $Servicio_Tecnico->monto_con_iva;
        $this->abono = $Servicio_Tecnico->abono;
        $this->monto_pendiente = $Servicio_Tecnico->monto_pendiente;
        $this->id_recibo = $Servicio_Tecnico->id_recibo;
        $this->id_iva = $Servicio_Tecnico->id_iva;

        $cliente = Clientes::find($Servicio_Tecnico->id_cliente);
        $this->identificacion = $cliente->identificacion;
        $this->name = $cliente->name;
        $this->telefono = $cliente->telefono;
        $this->correo = $cliente->correo;
        $this->direccion = $cliente->direccion;

        $this->habilitarAbono = 'true';
        $this->habilitarAbonoDolar = 'true';
        $this->abonodolarbs = '';
        $this->factura = '';

        $this->fecha_servicio = date('d/m/Y');

        $tasadeldiaBCV = Tasa_BCV::all();
        $tasadeldiaotros = Tasa_Otros::where('estatus',1)->first();

        if($tasadeldiaotros){
          $tasadia = $tasadeldiaotros; 
      }else{
          $tasadia = str_replace("USD ","",$tasadeldiaBCV[0]->tasa);
          $tasadia = str_replace(",",".",$tasadia);
      }

      $Dpendiente = str_replace(",",".",$this->monto_pendiente);
  
      $this->monto_pendiente_dolar = ($Dpendiente*1)/$tasadia;
      $this->monto_pendiente_dolar =   bcdiv($this->monto_pendiente_dolar, '1', 2);
      $this->monto_pendiente_dolar = str_replace(".",",",$this->monto_pendiente_dolar);

        $data = Ivas::All();
        $this->redireccionar = 'false';

      }



    public function render()
    {

      $habilitarAbono = true;
      $habilitarAbonoDolar = true;

      if($this->actualizar_abono != null || $this->actualizar_abono_dolar != null){
        $this->montoPendiente();
     }


     if($this->actualizar_abono_dolar != null){
      $habilitarAbono = false;
      $habilitarAbonoDolar = true;
      $this->actualizar_abono = '';
   }else if($this->actualizar_abono != null){
      $habilitarAbono = true;
      $habilitarAbonoDolar = false;
      $this->actualizar_abono_dolar = '';
   }

   $this->habilitarAbono = $habilitarAbono;
   $this->habilitarAbonoDolar = $habilitarAbonoDolar;

   /*if($this->redireccionar == 'true'){
    $this->confirmingUserDeletion=true;
   }*/

      return view('livewire.servicio-tecnico-editar');
       
    }

    public function montoPendiente()
    {

   
      $actualizar_abono = str_replace(".","",$this->actualizar_abono);
      $actualizar_abono = str_replace(",",".",$actualizar_abono);

      $monto_pendiente = str_replace(".","",$this->monto_pendiente);
      $monto_pendiente = str_replace(",",".",$monto_pendiente);

      $actualizar_abono_dolar = str_replace(".","",$this->actualizar_abono_dolar);
      $actualizar_abono_dolar = str_replace(",",".",$actualizar_abono_dolar);

      $monto_pendiente_dolar = str_replace(".","",$this->monto_pendiente_dolar);
      $monto_pendiente_dolar = str_replace(",",".",$monto_pendiente_dolar);


      if($actualizar_abono != null){

        $total = $monto_pendiente-$actualizar_abono;
        $totalDolares = '';

      }else if($actualizar_abono_dolar != null){
        $totalDolares = $monto_pendiente_dolar-$actualizar_abono_dolar;
        $total = '';
      }

     
      if($total == '0,00'){
        $this->boton = 'true';
      }else if($totalDolares == '0,00'){
        $this->boton = 'true';

      }else if($actualizar_abono > $monto_pendiente){
        $this->boton = 'ninguno';

    }else if($actualizar_abono_dolar > $monto_pendiente_dolar){
      $this->boton = 'ninguno';
    }else{
        $this->boton = 'false';
      }


    }

    public function submit(){

      date_default_timezone_set('America/Caracas');
      $Servicio = Servicio_Tecnico::find($this->id_servicio);
     $Recibo = Recibo::selectRaw('recibo, lpad(recibo, 15, 0), id,pdf')->where('id',$this->id_recibo)->first();


      if($this->boton === 'true'){
        /**********se guarda el registro en la tabla factura************** */
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

        $recibonumero = $Recibo['lpad(recibo, 15, 0)'];
        $idfactura = '0';
        $facturanumero = '';
      }


      /**********se obtiene el monto del iva************** */
      $monto_con_iva = str_replace(".","",$this->monto_con_iva);
      $monto_con_iva = str_replace(",",".",$monto_con_iva);

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
      if($this->boton   === 'true'){

        $pendiente = '0,00';
        $abono = '0,00';
        $Servicio->id_recibo = '0';
        $Servicio->id_factura_servicios = $idfactura;
        $Servicio->fecha = date("Y-m-d h:i:s");
        $Servicio->monto_pendiente = $pendiente;
        $Servicio->abono = $abono;
        $Servicio->save();

      }else{

        if($this->actualizar_abono != null || $this->actualizar_abono != ''){


          $suma_actualizar_abono = str_replace(".","",$this->actualizar_abono);
          $suma_actualizar_abono = str_replace(",",".",$suma_actualizar_abono);
          $suma_abono = str_replace(".","",$this->abono);
          $suma_abono = str_replace(",",".",$suma_abono);
          
          $suma = $suma_actualizar_abono+$suma_abono;
          $abono =  number_format($suma, 2);
          $abono = str_replace("."," ",$abono);
          $abono = str_replace(",",".",$abono);
          $abono = str_replace(" ",",",$abono);
          

          $resta = $monto_con_iva-$suma;
          $pendiente =  number_format($resta, 2);
          $pendiente = str_replace("."," ",$pendiente);
          $pendiente = str_replace(",",".",$pendiente);
          $pendiente = str_replace(" ",",",$pendiente);


        }else{

          $cal_actualizar_abono_dolar = str_replace(".","",$this->actualizar_abono_dolar);
          $cal_actualizar_abono_dolar = str_replace(",",".",$cal_actualizar_abono_dolar);

          $suma_abono = str_replace(".","",$this->abono);
          $suma_abono = str_replace(",",".",$suma_abono);

        $tasadeldiaotros = Tasa_Otros::where('estatus',1)->first();

        if($tasadeldiaotros){
            $tasadia = $tasadeldiaotros->tasa; 
        }else{
            $tasadeldiaBCV = Tasa_BCV::all();
            $tasadia = str_replace("USD ","",$tasadeldiaBCV[0]->tasa);
            $tasadia = str_replace(",",".",$tasadia);
        }

          $calculo_dolar = ($cal_actualizar_abono_dolar*$tasadia)/1;
          $suma = $calculo_dolar+$suma_abono;
          $abono =  number_format($suma, 2);
          $abono = str_replace("."," ",$abono);
          $abono = str_replace(",",".",$abono);
          $abono = str_replace(" ",",",$abono);

          $resta = $monto_con_iva-$suma;
          $pendiente =  number_format($resta, 2);
          $pendiente = str_replace("."," ",$pendiente);
          $pendiente = str_replace(",",".",$pendiente);
          $pendiente = str_replace(" ",",",$pendiente);


        }

        $Servicio->abono = $abono;
        $Servicio->monto_pendiente = $pendiente;
        $Servicio->fecha = date("Y-m-d h:i:s");
        $Servicio->save();

      }

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
          'monto_pendiente' => $pendiente,
          'montoIva' => $montoIva,
          'factura' => $facturanumero,
          'recibo' => $recibonumero,
          'porcentajeIva' => $porcentajeIva,
      ];

      if($this->boton   === 'true'){

        $pdf->loadView('pdf.factura_servicio',compact('datapdf'));
        $pdf->save(public_path('app/archivos/facturas/') .$Factura->pdf);
        $this->urlpdf='app/archivos/facturas/'.$Factura->pdf;
        $this->Nombrepdf= $Factura->pdf;

        /*********Eliminar recibo********** */
        File::delete(public_path('app/archivos/recibos/').$Recibo['pdf']);
        Recibo::destroy($this->id_recibo);
    }else{
          /*********Eliminar recibo viejo********** */
          File::delete(public_path('app/archivos/recibos/').$Recibo['pdf']);

        $pdf->loadView('pdf.recibo_servicio',compact('datapdf'));
        $pdf->save(public_path('app/archivos/recibos/') .$Recibo['pdf']);
        $this->urlpdf='app/archivos/recibos/'.$Recibo['pdf'];
        $this->Nombrepdf= $Recibo['pdf'];
    }

    $pdf->render();
    /**********se habilita el modal y se limpia los input************** */
    $this->confirmingUserDeletion=true;
    $this->boton='ninguno';
    $this->redireccionar = 'true';
    }

    public function cerrar()
    {
      return Redirect::route('listaServicioTecnico');
    }
}

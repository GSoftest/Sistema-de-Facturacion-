<?php

namespace App\Http\Controllers;

use App\Http\Middleware\PreventRequestsDuringMaintenance;
use App\Models\Clientes;
use Illuminate\Http\Request;
use App\Models\Servicio_Tecnico;
use App\Models\Recibo;
use App\Models\Facturas_servicios;
use App\Models\Ivas;
use Hamcrest\Core\Every;
use Illuminate\Support\Facades\DB;
use Livewire\Event;

class FacturaVentaController extends Controller
{


    public function imprimirFactura(Request $request){

        $Servicio_Tecnico = new Servicio_Tecnico();
        $Servicio_Tecnico->id_recibo = 1;
        $Servicio_Tecnico->id_cliente = $request->id_cliente;
        $Servicio_Tecnico->id_iva = $request->id_iva;
        $Servicio_Tecnico->descripcion_equipo = $request->descripcion_equipo;
        $Servicio_Tecnico->monto_sin_iva = $request->monto_sin_iva;
        $Servicio_Tecnico->monto_con_iva = $request->monto_con_iva;
        $Servicio_Tecnico->abono = $request->abono;
        $Servicio_Tecnico->monto_pendiente = $request->monto_pendiente;

        $date = str_replace('/', '-', $request->fecha_servicio);
        $Servicio_Tecnico->fecha = date("Y-m-d",strtotime( $date ));

        //$Servicio_Tecnico->save();

     if($request->factura === 'true'){
        $ultimaFactura = Facturas_servicios::first();
       

        $Factura = new Facturas_servicios();
        if($ultimaFactura == null){
            $Factura->numero_factura = 1;
            $Factura->pdf = 'Factura'.$Factura->numero_factura.'.pdf';
        }else{
            $Factura->numero_factura = $ultimaFactura->numero_factura+1;
            $Factura->pdf = 'Factura'.$Factura->numero_factura.'.pdf';
        }
        
    
       // $Factura->save();
        $facturanumero = Facturas_servicios::selectRaw('numero_factura, lpad(numero_factura, 15, 0)')->where('pdf',$Factura->pdf)->first();
        $facturanumero = $facturanumero['lpad(numero_factura, 15, 0)'];
        $recibonumero = '';

     }else{
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
       $recibonumero = Recibo::selectRaw('recibo, lpad(recibo, 15, 0)')->where('pdf',$Recibo->pdf)->first();
       $recibonumero = $recibonumero['lpad(recibo, 15, 0)'];
       $facturanumero = '';
    }

    $monto_con_iva = str_replace(",",".",$request->monto_con_iva);
    $monto_sin_iva = str_replace(",",".",$request->monto_sin_iva);

    $montoIva = ($monto_con_iva-$monto_sin_iva);
    $porcentajeIva = Ivas::find($request->id_iva);
    $porcentajeIva = $porcentajeIva->iva;
    $pdf = app('dompdf.wrapper');
   

    $data = [
        'fecha' => $request->fecha_servicio,
        'name' => $request->name,
        'identificacion' => $request->identificacion,
        'telefono' => $request->telefono,
        'direccion' => $request->direccion,
        'descripcion_equipo' => $request->descripcion_equipo,
        'monto_sin_iva' => $request->monto_sin_iva,
        'monto_con_iva' => $request->monto_con_iva,
        'abono' => $request->abono,
        'monto_pendiente' => $request->monto_pendiente,
        'montoIva' => $montoIva,
        'factura' => $facturanumero,
        'recibo' => $recibonumero,
        'porcentajeIva' => $porcentajeIva,
    ];

    if($request->factura === 'true'){
        $pdf->loadView('pdf.factura_servicio',compact('data'));
      //  $pdf->save(public_path('app/archivos/pdf/facturas/') .$Factura->pdf);
    }else{
        $pdf->loadView('pdf.recibo_servicio',compact('data'));
        $pdf->save(public_path('app/archivos/pdf/facturas/') .$Recibo->pdf);
    }

        $pdf->render();
        $request['descripcion_equipo'] = 'hola';
      //  $request->merge(array('descripcion_equipo' => "hola"));
      /*  Input::replace(['descripcion_equipo' => 'hola']);*/

       // dd($request);
        return redirect()->back();
        //->$pdf->stream('prueba.pdf',['attachment' => true]);    
    }


}


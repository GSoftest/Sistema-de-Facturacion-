<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;
use App\Models\Servicio_Tecnico;
use App\Models\Recibo;
use App\Models\Facturas_servicios;
use App\Models\Ivas;

class FacturaVentaController extends Controller
{


    public function imprimirFactura(Request $request){


        $Servicio_Tecnico = new Servicio_Tecnico();
        $Servicio_Tecnico->id_recibo = 1;
        $Servicio_Tecnico->id_cliente = $request->id_cliente;
        $Servicio_Tecnico->id_iva = $request->id_iva;
        $Servicio_Tecnico->descripcion_equipo = $request->descripcion_equipo;
        $Servicio_Tecnico->fecha = $request->fecha;
        $Servicio_Tecnico->monto_sin_iva = $request->monto_sin_iva;
        $Servicio_Tecnico->monto_con_iva = $request->monto_con_iva;
        $Servicio_Tecnico->abono = $request->abono;
        $Servicio_Tecnico->monto_pendiente = $request->monto_pendiente;

     //   $Servicio_Tecnico->save();


     if($request->factura === '1'){
        $Recibo = new Facturas_servicios();
        $Recibo->numero_factura = 000001;
        $Recibo->pdf = 'Factura.pdf';
        //$Recibo->save();

     }else{
       $Recibo = new Recibo();
       $Recibo->recibo = 0000001;
       $Recibo->pdf = 'Recibo.pdf';
     //  $Recibo->save();
    }

    $montoIva = ($request->monto_con_iva-$request->monto_sin_iva);
    $porcentajeIva = Ivas::find($request->id_iva);
    $porcentajeIva = $porcentajeIva->iva;


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
        'factura' => $request->factura,
        'montoIva' => $montoIva,
        'porcentajeIva' => $porcentajeIva,
    ];


    $pdf = app('dompdf.wrapper');


    if($request->factura === '1'){
        $pdf->loadView('pdf.factura_servicio',compact('data'));
    }else{
        $pdf->loadView('pdf.recibo_servicio',compact('data'));
    }
    // $pdf->save(public_path('app/archivos/pdf/facturas/') ."Factura.pdf");

        $pdf->render();
        return $pdf->stream('prueba.pdf',['attachment' => true]);

    }


}


<?php

namespace App\Exports;

use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Ventas;
use App\Models\Clientes;
use App\Models\Factura;

class VentasExport implements FromView
{
    public function __construct($fechadesde,$fechahasta)
    {
        $this->fechadesde = $fechadesde;
        $this->fechahasta = $fechahasta;
    }


    public function view(): View
    {
        date_default_timezone_set('America/Caracas');
        if($this->fechadesde != null &&  $this->fechahasta!=null){
            $exportVenta = Ventas::whereDate('fecha','>=', $this->fechadesde)->whereDate('fecha','<=', $this->fechahasta)->get();
        }else{
            $exportVenta = Ventas::all();
        }

        return view('components.export-datos',
        [ 'ventas' => $exportVenta,
          'factura' => Factura::selectRaw('numero_factura, lpad(numero_factura, 15, 0),id,nombre_factura,id_venta')->get(),
          'cliente' => Clientes::all(),
          'fecha' => date('Y-m-d')

        ]);
    }
}

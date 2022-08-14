<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Ventas;
use App\Models\Factura;
use App\Models\Clientes;
use Livewire\WithPagination;

class ListaVentas extends Component
{
    use WithPagination;
    public $busquedaVenta,$busqueda,$desde,$hasta;

    public $negada = false;

    public function render()
    {
        date_default_timezone_set('America/Caracas');
        $ventas = Ventas::paginate(20);
        $data2 = Factura::selectRaw('numero_factura, lpad(numero_factura, 15, 0),id,nombre_factura,id_venta')->get();
        $cliente = Clientes::all();
        //'fecha_factura' => date('d/m/Y'),

        if($this->busqueda == true){
            $this->desde = str_replace("-","/",$this->desde);
            $this->hasta = str_replace("-","/",$this->hasta);
            $busquedaVenta = Ventas::whereDate('fecha','>=', $this->desde)->whereDate('fecha','<=',$this->hasta)->paginate(20);
            $this->desde = null;
            $this->hasta = null;
            return view('livewire.lista-ventas',['ventas'  => $busquedaVenta, 'factura' => $data2,'cliente' => $cliente, 'fecha' => date('Y-m-d')]);
        }else{
            return view('livewire.lista-ventas',['ventas'  => $ventas, 'factura' => $data2,'cliente' => $cliente, 'fecha' => date('Y-m-d')]);
        }
    }


    public function download($file){
      
        $file= public_path(). "/app/archivos/facturas_ventas/".$file;
        return response()->download($file);
    }

    
    public function buscar(){

        if($this->desde != null && $this->hasta != null){
            $this->busqueda = true;
        }else{
            $this->negada=true;
        }
       
    }

    public function cerrar()
    {
        $this->negada=false;
    }


}

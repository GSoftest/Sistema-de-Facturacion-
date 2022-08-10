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
    public function render()
    {
        $data = Ventas::paginate(20);
        $data2 = Factura::selectRaw('numero_factura, lpad(numero_factura, 15, 0),id,nombre_factura,id_venta')->get();
        $cliente = Clientes::all();
        return view('livewire.lista-ventas',['ventas'  => $data, 'factura' => $data2,'cliente' => $cliente]);
    }


    public function download($file){
      
        $file= public_path(). "/app/archivos/facturas_ventas/".$file;
        return response()->download($file);
    }


}

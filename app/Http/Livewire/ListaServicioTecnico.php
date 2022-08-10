<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Servicio_Tecnico;
use App\Models\Recibo;
use App\Models\Clientes;
use Livewire\WithPagination;

class ListaServicioTecnico extends Component
{
    use WithPagination;
    public $file;
    public function render()
    {
        $data = Servicio_Tecnico::where('id_recibo', '>=' ,'1')->paginate(10);

        $data2 = Recibo::selectRaw('recibo, lpad(recibo, 15, 0),id,pdf')->get();
        
        return view('livewire.lista-servicio-tecnico',['servicios' => $data, 'recibo' => $data2]);
    }

    public function download($file){
      
        $file= public_path(). "/app/archivos/recibos/".$file;
        return response()->download($file);
    }
}

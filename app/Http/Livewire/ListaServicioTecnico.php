<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Servicio_Tecnico;
use App\Models\Recibo;
use Livewire\WithPagination;

class ListaServicioTecnico extends Component
{
    use WithPagination;
    public function render()
    {
        $data = Servicio_Tecnico::paginate(10);


     //   $recibo = Recibo::find($data[0]->id_recibo);
        return view('livewire.lista-servicio-tecnico',['servicios' => $data]);
    }
}

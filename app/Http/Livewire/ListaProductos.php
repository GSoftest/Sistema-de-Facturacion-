<?php

namespace App\Http\Livewire;

use App\Models\Medidas;
use Livewire\Component;
use App\Models\Productos;
use Livewire\WithPagination;

class ListaProductos extends Component
{
    use WithPagination;
    public function render()
    {
        $data = Productos::paginate(10);
        $medidas = Medidas::all();
        return view('livewire.lista-productos',['productos'  => $data,'medidas' => $medidas]);
    }


    public function destroy($id)
    {
        Productos::destroy($id);
    }
}

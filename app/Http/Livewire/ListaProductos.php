<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Productos;
use Livewire\WithPagination;

class ListaProductos extends Component
{
    use WithPagination;
    public function render()
    {
        $data = Productos::paginate(10);
        return view('livewire.lista-productos',['productos'  => $data]);
    }


    public function destroy($id)
    {
        Productos::destroy($id);
    }
}

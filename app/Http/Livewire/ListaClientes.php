<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Clientes;
use Livewire\WithPagination;

class ListaClientes extends Component
{

    use WithPagination;
    public function render()
    {

        $data = Clientes::paginate(10);
       return view('livewire.lista-clientes',['clientes'  => $data]);
    }


    public function destroy($id)
    {
        Clientes::destroy($id);
    }

}

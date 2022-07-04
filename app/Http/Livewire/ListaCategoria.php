<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categorias;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Redirect;

class ListaCategoria extends Component
{

    use WithPagination;
    
    public function render()
    {
        $data = Categorias::paginate(4);
        return view('livewire.lista-categoria',['items'  => $data]);
    }
    public function destroy($id)
    {
        Categorias::destroy($id);
    }
}

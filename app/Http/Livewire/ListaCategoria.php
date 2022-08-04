<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categorias;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Redirect;

class ListaCategoria extends Component
{

    public $confirmingUserDeletion = false;
    use WithPagination;
    
    public function render()
    {
        $data = Categorias::paginate(4);
        return view('livewire.lista-categoria',['items'  => $data]);
    }

    public function destroy($id)
    {
        $this->eliminar=$id;
        $this->confirmingUserDeletion=true;
    }


    
    public function destroy2()
    {
        $this->confirmingUserDeletion=false;
        Categorias::destroy($this->eliminar);
    }

    public function cerrar()
    {
        $this->confirmingUserDeletion=false;
    }

}

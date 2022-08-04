<?php

namespace App\Http\Livewire;

use App\Models\Medidas;
use Livewire\Component;
use App\Models\Productos;
use Livewire\WithPagination;

class ListaProductos extends Component
{
    public $confirmingUserDeletion = false;
    use WithPagination;
    public function render()
    {
        $data = Productos::paginate(10);
        $medidas = Medidas::all();
        return view('livewire.lista-productos',['productos'  => $data,'medidas' => $medidas]);
    }


    public function destroy($id)
    {
        $this->eliminar=$id;
        $this->confirmingUserDeletion=true;
    }
 
    public function destroy2()
    {
        $this->confirmingUserDeletion=false;
        Productos::destroy($this->eliminar);
    }

    public function cerrar()
    {
        $this->confirmingUserDeletion=false;
    }


}

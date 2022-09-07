<?php

namespace App\Http\Livewire;

use App\Models\Medidas;
use Livewire\Component;
use App\Models\Productos;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\QueryException;
use Exception;
use Illuminate\Support\Facades\Redirect;


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
        $this->confirmingUserDeletion=true;
        $this->eliminar=$id;
    }
 
    public function destroy2()
    {
        $this->confirmingUserDeletion=false;
        try {
            Productos::destroy($this->eliminar);
        }catch(\Illuminate\Database\QueryException $e){
            Session::flash('message2', 'El producto no se puede eliminar, pertenece a una venta realizada');
        }
        return redirect()->to('/productos');
    }

    public function cerrar()
    {
        $this->confirmingUserDeletion=false;
    }


}

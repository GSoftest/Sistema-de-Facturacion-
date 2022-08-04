<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Clientes;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Redirect;

class ListaClientes extends Component
{

    public $confirmingUserDeletion = false;
    public $confirmingActivar = false;
    public $cliente;
    use WithPagination;
    public function render()
    {

        $data = Clientes::paginate(10);
       return view('livewire.lista-clientes',['clientes'  => $data]);
    }


 /*   public function destroy($id)
    {
        Clientes::destroy($id);
    }
*/

public function activar($id)
{
    $this->activar=$id;
    $this->confirmingActivar=true;
}

public function activar2()
{
    $this->confirmingActivar=false;

    $cliente = Clientes::find($this->activar);
    $cliente->estatus = 1;
    $cliente->save();
    $this->estatus = $cliente->estatus;
    return Redirect::route('clientes');
}


public function desactivar($id)
{
    $this->desactivar=$id;
    $this->confirmingUserDeletion=true;
}

public function desactivar2()
{
    $this->confirmingUserDeletion=false;

    $cliente = Clientes::find($this->desactivar);
    $cliente->estatus = 0;
    $cliente->save();
    $this->estatus = $cliente->estatus;
    return Redirect::route('clientes');
}

    public function cerrar()
    {
        $this->confirmingUserDeletion=false;
        $this->confirmingActivar=false;
    }

}

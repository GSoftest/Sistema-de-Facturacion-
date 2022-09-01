<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Proveedores;
use Illuminate\Support\Facades\Redirect;

class ListaProveedores extends Component
{
    use WithPagination;
    public $confirmingUserDeletion = false;
    public $confirmingActivar = false;

    public function render()
    {
        $data = Proveedores::paginate(10);
        return view('livewire.lista-proveedores',['proveedores'  => $data]);
    }

    public function activar($id)
{
    $this->activar=$id;
    $this->confirmingActivar=true;
}

public function activar2()
{
    $this->confirmingActivar=false;

    $poveedor = Proveedores::find($this->activar);
    $poveedor->status = 1;
    $poveedor->save();
    $this->status = $poveedor->status;
    return Redirect::route('proveedores');
}


public function desactivar($id)
{
    $this->desactivar=$id;
    $this->confirmingUserDeletion=true;
}

public function desactivar2()
{
    $this->confirmingUserDeletion=false;

    $poveedor = Proveedores::find($this->desactivar);
    $poveedor->status = 0;
    $poveedor->save();
    $this->status = $poveedor->status;
    return Redirect::route('proveedores');
}

public function cerrar()
{
    $this->confirmingUserDeletion=false;
    $this->confirmingActivar=false;
}

}

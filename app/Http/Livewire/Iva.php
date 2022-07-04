<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Ivas;
use Livewire\WithPagination;


class Iva extends Component
{

  
    use WithPagination;
    public $iva, $iva_id;

    public function render()
    {
        $iva = Ivas::paginate(4);
        return view('livewire.iva', ['ivas' => $iva]);
    }

    public function guardar()
    {
        $this->validate(['iva' => 'required']);

        if ($this->iva_id) {

            $iva = Ivas::find($this->iva_id);
            $iva->update([
                'iva' => $this->iva,
                'estado' => 0
            ]);

        }else{
            $iva = Ivas::where('iva', $this->iva)->exists();
            if ($iva) {

                session()->flash('message', 'El iva ya se encuentra registrado');
                $this->view = 'livewire.iva';
                
            }else{
                Ivas::create([
                'iva' => $this->iva,
                'estado' => 0
                ]);
            }
        }

        
        $this->default();


    }

    public function edit($id)
    {
        $iva = Ivas::find($id);
        $this->iva_id = $iva->id;
        $this->iva = $iva->iva;
        $this->view = 'livewire.iva';
    }

    public function destroy($id)
    {
        Ivas::destroy($id);
    }


    public function default()
    {
        $this->iva = '';
        $this->iva_id = '';
        $this->view = 'livewire.iva';
    }

    public function activar($id)
    {
        $iva = Ivas::find($id);

        $this->view = 'livewire.iva';
    }

    public function desactivar($id)
    {
        $iva = Ivas::find($id);

        $this->view = 'livewire.iva';
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Ivas;
use App\Models\Tasa_BCV;
use Livewire\WithPagination;

class Iva extends Component
{

  
    use WithPagination;
    public $iva, $iva_id,$estado;

    public function render()
    {
        $iva = Ivas::paginate(4);

        return view('livewire.iva', ['ivas' => $iva]);
    }

    public function guardar()
    {

        $rules = [
            'iva' => 'required|regex:/^[\d]+([,][\d]+)?$/',
        ];

        $messages = [
            'iva.required' => 'Obligatorio.',
            'iva.regex' =>'El IVA con formato inválido.',
        ];

        $this->validate($rules, $messages);

        if ($this->iva_id) {

            $iva = Ivas::find($this->iva_id);
            $this->iva = str_replace(",",".",$this->iva);

            $iva->update([
                'iva' => $this->iva,
                'estado' => $this->estado
            ]);
            
        }else{
            $this->iva = str_replace(",",".",$this->iva);
            $iva = Ivas::where('iva', $this->iva)->exists();
            if ($iva) {

                session()->flash('message', 'El IVA ya se encuentra registrado');

                
            }else{
                $this->iva = str_replace(",",".",$this->iva);

                Ivas::create([
                'iva' => $this->iva,
                'estado' => 0
                ]);
            }
        }

        $this->limpiar();
        $this->view = 'livewire.iva';

    }

    public function edit($id)
    {

        $rules = [
            'iva' => 'regex:/^[\d]+([,][\d]+)?$/',
        ];

        $messages = [
            'iva.regex' =>'El IVA con formato inválido.',
        ];

        $iva = Ivas::find($id);
        $this->iva_id = $iva->id;
        $this->iva = number_format($iva->iva, 2);
        $this->iva = str_replace(".",",",$this->iva);
        $this->estado = $iva->estado;

        $this->validate($rules, $messages);
        $this->view = 'livewire.iva';
    }

    public function destroy($id)
    {
        Ivas::destroy($id);
    }


    public function limpiar()
    {
        $this->iva = '';
        $this->iva_id = '';
    }

    public function activar($id)
    {

        $verificacion = Ivas::where('estado', 1)->get();

        if(count($verificacion) == 0){

            $iva = Ivas::find($id);

            $iva->update([
                'estado' => 1
            ]);
    
    
            $this->estado = $iva->estado;

            $bcv = Tasa_BCV::all();
            $bcv->update([
                'estado' => 0
            ]);

        }else{

            session()->flash('message', 'Ya se encuentra un IVA activo para la venta');
        
        }

        $this->view = 'livewire.iva';
    }

    public function desactivar($id)
    {
        $iva = Ivas::find($id);

        $iva->update([
            'estado' => 0
        ]);
        $this->estado = $iva->estado;
        $this->view = 'livewire.iva';
    }
}

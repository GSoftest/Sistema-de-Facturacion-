<?php

namespace App\Http\Livewire;

use App\Models\Tasa_BCV;
use Livewire\Component;
use App\Models\Tasa_Otros;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Redirect;

class Tasa extends Component
{
    use WithPagination;
    public $tasa, $tasa_id,$estatus;

    public function render()
    {
        $tasaOtros = Tasa_Otros::paginate(4);
        return view('livewire.tasa',['tasaOtros' => $tasaOtros]);
    }

    public function guardar()
    {

        $rules = [
            'tasa' => 'required|regex:/^[\d]+([,][\d]+)?$/|max:5',
        ];

        $messages = [
            'tasa.required' => 'Obligatorio.',
            'tasa.regex' =>'formato inválido.',
            'tasa.max' =>'Logitud maxima de 5 caracteres.',
        ];

        $this->validate($rules, $messages);
        if ($this->tasa_id) {



            $tasa = Tasa_Otros::find($this->tasa_id);

            if(strpos($this->tasa, ',')){
            $this->tasa = str_replace(",",".",$this->tasa);

            $tasa->update([
                'tasa' => $this->tasa,
                'estatus' => $this->estatus
            ]);

            }else{
                session()->flash('message', 'formato inválido,,,.');
            }
            
        }else{
            $this->tasa = str_replace(",",".",$this->tasa);
            $tasa = Tasa_Otros::where('tasa', $this->tasa)->exists();

            if ($tasa) {

                session()->flash('message', 'La tasa ya se encuentra registrada');

                
            }else{
              
                if(strpos($this->tasa, '.')){
                $this->tasa = str_replace(",",".",$this->tasa);

                Tasa_Otros::create([
                'tasa' => $this->tasa,
                'estatus' => 0
                ]);
                }else{
                    session()->flash('message', 'formato inválido.');
                }
            }
        }

        $this->limpiar();
        $this->view = 'livewire.tasa';


    }


    public function limpiar()
    {
        $this->tasa = '';
        $this->tasa_id= '';
    }


    public function destroy($id)
    {
        Tasa_Otros::destroy($id);
    }

    public function edit($id)
    {

        $rules = [
            'tasa' => 'regex:/^[\d]+([,][\d]+)?$/',
        ];

        $messages = [
            'tasa.regex' =>'formato inválido.',
        ];

        $tasa = Tasa_Otros::find($id);
        $this->tasa_id = $tasa->id;
        $this->tasa = number_format($tasa->tasa, 2);
        $this->tasa = str_replace(".",",",$this->tasa);

        $this->estatus = $tasa->estatus;

        $this->validate($rules, $messages);
        $this->view = 'livewire.tasa';
    }

    public function activar($id)
    {

        $verificacion = Tasa_Otros::where('estatus', 1)->get();

        if(count($verificacion) == 0){

            $tasa = Tasa_Otros::find($id);

            $tasa->update([
                'estatus' => 1
            ]);

            $tasaBCV = Tasa_BCV::first();
             $tasaBCV->update([
                'estatus' => 0
            ]);

            $this->estatus = $tasa->estatus;
            session()->flash('message', 'Al activar una tasa desactiva la tasa del BCV');
        }else{

            session()->flash('message', 'Ya se encuentra una tasa activa');
        
        }

       
        return Redirect::route('tasa');
    }

    public function desactivar($id)
    {


        $tasa = Tasa_Otros::find($id);

        $tasa->update([
            'estatus' => 0
        ]);

        $tasaBCV = Tasa_BCV::first();
             $tasaBCV->update([
                'estatus' => 1
            ]);

        $this->estatus = $tasa->estatus;
        return Redirect::route('tasa');
    }
    

}

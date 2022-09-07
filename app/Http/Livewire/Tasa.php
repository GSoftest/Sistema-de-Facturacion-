<?php

namespace App\Http\Livewire;

use App\Models\Tasa_BCV;
use Livewire\Component;
use App\Models\Tasa_Otros;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class Tasa extends Component
{
    public $confirmingUserDeletion = false;
    public $confirmingActivar = false;
    public $confirmingDesactivar = false;
    use WithPagination;
    public $tasa, $tasa_id,$estatus,$activar,$desactivar;

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
        try{
        if ($this->tasa_id) {
            $tasa = Tasa_Otros::find($this->tasa_id);

            if(strpos($this->tasa, ',')){
            $this->tasa = str_replace(",",".",$this->tasa);

            $tasa->update([
                'tasa' => $this->tasa,
                'estatus' => $this->estatus
            ]);
            Session::flash('notificacion', '¡Tasa Actualizada Exitosamente!');
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
                Session::flash('notificacion', '¡Tasa Registrada Exitosamente!');
                }else{
                    session()->flash('message', 'formato inválido.');
                }
            }
        }
        }catch(\Illuminate\Database\QueryException $e){
            Session::flash('advertencia', '¡La Tasa No Puede Ser Registrada!');
        }
        $this->limpiar();
        return Redirect::route('tasa');


    }


    public function limpiar()
    {
        $this->tasa = '';
        $this->tasa_id= '';
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


    public function activar2($id)
    {
        $this->activar=$id;
        $this->confirmingActivar=true;
    }

    public function activar()
    {

        try{
        $verificacion = Tasa_Otros::where('estatus', 1)->get();

        if(count($verificacion) == 0){

            $tasa = Tasa_Otros::find($this->activar);

            $tasa->update([
                'estatus' => 1
            ]);

            $tasaBCV = Tasa_BCV::first();
             $tasaBCV->update([
                'estatus' => 0
            ]);

            $this->estatus = $tasa->estatus;
            Session::flash('notificacion', '¡La Tasa Fue Activada Exitosamente!');
        }else{

            session()->flash('message', 'Ya se encuentra una tasa activa');
        
        }
       
        }catch(\Illuminate\Database\QueryException $e){
            Session::flash('advertencia', '¡La Tasa No Puede Ser Activada!');
        }
       
        return Redirect::route('tasa');
    }

    public function desactivar2($id)
    {
        $this->desactivar=$id;
        $this->confirmingDesactivar=true;
    }

    public function desactivar()
    {


        $tasa = Tasa_Otros::find($this->desactivar);
        try{

        $tasa->update([
            'estatus' => 0
        ]);

        $tasaBCV = Tasa_BCV::first();
             $tasaBCV->update([
                'estatus' => 1
            ]);

        $this->estatus = $tasa->estatus;
        Session::flash('notificacion', '¡La Tasa Fue Desactivada Exitosamente!');
        }catch(\Illuminate\Database\QueryException $e){
            Session::flash('advertencia', '¡La Tasa No Puede Ser Desactivada!');
        }
        return Redirect::route('tasa');
    }
    

    public function destroy($id)
    {
        $this->eliminar=$id;
        $this->confirmingUserDeletion=true;
    }
 
    public function destroy2()
    {
        $this->confirmingUserDeletion=false;
        try{
        Tasa_Otros::destroy($this->eliminar);
        Session::flash('notificacion', '¡La Tasa Fue Eliminada Exitosamente!');
        }catch(\Illuminate\Database\QueryException $e){
            Session::flash('advertencia', '¡La Tasa No Puede Ser Eliminada!');
        }
        return Redirect::route('tasa');
    }

    public function cerrar()
    {
        $this->confirmingUserDeletion=false;
        $this->confirmingActivar=false;
        $this->confirmingDesactivar=false;
    }


}

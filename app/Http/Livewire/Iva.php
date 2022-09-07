<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Ivas;
use App\Models\Tasa_BCV;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class Iva extends Component
{

    public $confirmingUserDeletion = false;
    public $confirmingActivar = false;
    public $confirmingDesactivar = false;
    use WithPagination;
    public $iva, $iva_id,$estado,$activar,$desactivar;

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

        try{
        $this->validate($rules, $messages);

            if ($this->iva_id) {
                $iva = Ivas::find($this->iva_id);
                $this->iva = str_replace(",",".",$this->iva);
                $iva->update([
                    'iva' => $this->iva,
                    'estado' => $this->estado
                ]);

                Session::flash('notificacion', '¡ IVA Actualizado Exitosamente!');

            }else{

                $this->iva = str_replace(",",".",$this->iva);
                $iva = Ivas::where('iva', $this->iva)->exists();
                if($iva){
                    Session::flash('notificacion', '¡ IVA ya se encuentra registrado!');  
                }else{
                    $this->iva = str_replace(",",".",$this->iva);

                    Ivas::create([
                    'iva' => $this->iva,
                    'estado' => 0
                    ]);
                    Session::flash('notificacion', '¡ IVA Registrado Exitosamente!');
                }
            }

    }catch(\Illuminate\Database\QueryException $e){
        Session::flash('advertencia', '¡El IVA No Puede Ser Registrado!');
    }

        $this->limpiar();
        return Redirect::route('iva');

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


    public function limpiar()
    {
        $this->iva = '';
        $this->iva_id = '';
    }


    public function activar2($id)
    {
        $this->activar=$id;
        $this->confirmingActivar=true;
    }

    public function activar()
    {
        try{

        $verificacion = Ivas::where('estado', 1)->get();

        if(count($verificacion) == 0){
            $iva = Ivas::find($this->activar);
            $iva->update([
                'estado' => 1
            ]);
            $this->estado = $iva->estado;
            Session::flash('notificacion', '¡ IVA Activado Exitosamente!');
        }else{
            Session::flash('notificacion', '¡Ya se encuentra un IVA activo para la venta!');
        }

        }catch(\Illuminate\Database\QueryException $e){
            Session::flash('advertencia', '¡El IVA No Puede Ser Activado!');
        }
        return Redirect::route('iva');
    }


    public function desactivar2($id)
    {
        $this->desactivar=$id;
        $this->confirmingDesactivar=true;
    }


    public function desactivar()
    {
        try{
        $iva = Ivas::find($this->desactivar);
        $iva->update([
            'estado' => 0
        ]);
        $this->estado = $iva->estado;
        Session::flash('notificacion', '¡ IVA Desactivado Exitosamente!');
        }catch(\Illuminate\Database\QueryException $e){
        Session::flash('advertencia', '¡El IVA No Puede Ser Desactivado!');
        }

        return Redirect::route('iva');
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
        Ivas::destroy($this->eliminar);
        Session::flash('notificacion', '¡El IVA Fue Eliminado Exitosamente!');
        }catch(\Illuminate\Database\QueryException $e){
            Session::flash('advertencia', '¡El IVA No Puedo Ser Eliminado!');
        }
        return Redirect::route('iva');
    }


    public function cerrar()
    {
        $this->confirmingUserDeletion=false;
        $this->confirmingActivar=false;
    }
}

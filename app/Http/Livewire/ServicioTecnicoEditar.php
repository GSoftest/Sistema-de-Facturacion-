<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Servicio_Tecnico;
use App\Models\Ivas;
use App\Models\Clientes;
use App\Models\Tasa_BCV;
use App\Models\Tasa_Otros;

class ServicioTecnicoEditar extends Component
{
    public $id_cliente;
    public $identificacion;
    public $fecha_servicio;
    public $post;
 

      public function mount($id)
      {
        $Servicio_Tecnico = Servicio_Tecnico::find($id);
        $this->id_cliente = $Servicio_Tecnico->id_cliente;
        $this->descripcion_equipo = $Servicio_Tecnico->descripcion_equipo;
        $this->monto_sin_iva = $Servicio_Tecnico->monto_sin_iva;
        $this->monto_con_iva = $Servicio_Tecnico->monto_con_iva;
        $this->abono = $Servicio_Tecnico->abono;
        $this->monto_pendiente = $Servicio_Tecnico->monto_pendiente;

        $cliente = Clientes::find($Servicio_Tecnico->id_cliente);
        $this->identificacion = $cliente->identificacion;
        $this->name = $cliente->name;
        $this->telefono = $cliente->telefono;
        $this->correo = $cliente->correo;
        $this->direccion = $cliente->direccion;

        $this->habilitarAbono = 'true';
        $this->habilitarAbonoDolar = 'true';
        $this->abonodolarbs = '';
        $this->factura = '';

        $this->fecha_servicio = date('d/m/Y');

        $tasadeldiaBCV = Tasa_BCV::all();
        $tasadeldiaotros = Tasa_Otros::where('estatus',1)->first();

        if($tasadeldiaotros){
          $tasadia = $tasadeldiaotros; 
      }else{
          $tasadia = str_replace("USD ","",$tasadeldiaBCV[0]->tasa);
          $tasadia = str_replace(",",".",$tasadia);
      }

      $Dpendiente = str_replace(",",".",$this->monto_pendiente);
     /* $this->monto_pendiente_dolar = ($Dpendiente*1)/$tasadia;
      $this->monto_pendiente_dolar =   bcdiv($this->monto_pendiente_dolar, '1', 2);
      $this->monto_pendiente_dolar = str_replace(".",",",$this->monto_pendiente_dolar);*/

        $data = Ivas::All();


      }



    public function render()
    {
       return view('livewire.servicio-tecnico-editar');
    }




}

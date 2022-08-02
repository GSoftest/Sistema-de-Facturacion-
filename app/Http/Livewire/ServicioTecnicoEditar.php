<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Servicio_Tecnico;
use App\Models\Ivas;
use App\Models\Clientes;

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

        $data = Ivas::All();


      }



    public function render()
    {
       return view('livewire.servicio-tecnico-editar');
    }




}

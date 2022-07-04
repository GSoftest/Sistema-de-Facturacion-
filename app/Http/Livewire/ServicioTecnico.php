<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Clientes;
use App\Models\Ivas;
use App\Models\Servicio_Tecnico;
use App\Http\Livewire\App;
use Illuminate\Support\Facades\App as FacadesApp;

class ServicioTecnico extends Component
{

    public $identificacion,
    $name,
    $cliente,
    $id_iva,
    $id_cliente,
    $monto_sin_iva,
    $monto_con_iva,
    $monto,$abono,
    $monto_pendiente,
    $recibo,
    $descripcion_equipo,
    $fecha,
    $factura;


    public function render()
    {

        $data = Ivas::All();
        return view('livewire.servicio-tecnico',
        ['ivas'  => $data,
        'monto_con_iva' => 0,
        'monto_pendiente' => 0,
        'fecha_servicio' => date('d/m/Y'),
    ]);
    }

    public function Buscar()
    {
        

     $cliente = Clientes::where('identificacion',$this->identificacion)->get();

     
     if (isset($cliente[0])) {
    $this->id_cliente=  $cliente[0]->id;
    $this->name=  $cliente[0]->name;
    $this->telefono =  $cliente[0]->telefono;
    $this->direccion =  $cliente[0]->direccion;

     $this->view = 'livewire.servicio-tecnico';
    }else{
        session()->flash('message', 'No se encuentra registrado debe registrar el cliente');
        $this->view = 'livewire.servicio-tecnico';
    }



    }
    
    public function change(){
       if ($this->id_iva != '') {
        $iva = Ivas::find($this->id_iva);
            if ($this->monto_sin_iva != '' && $this->monto_sin_iva != 0 ) {
                $monto = $this->monto_sin_iva;
                $monto_con_iva = ($iva->iva*$monto)/100;
                $this->monto_con_iva =   $monto+$monto_con_iva;
            }else{
                $this->monto_con_iva =  $this->monto_sin_iva;
            }
        }else{
            $this->monto_con_iva =  $this->monto_sin_iva;
        }
        $this->view = 'livewire.servicio-tecnico';
    }


    public function calculo(){
        if ($this->monto_con_iva != '' && $this->monto_con_iva != 0 ) {
        $monto_pendiente = ($this->monto_con_iva-$this->abono);
        $this->monto_pendiente =  $monto_pendiente;

        if($this->monto_pendiente == 0){
            $factura = true;
            }else{
                 $factura = false;
            }
            $this->factura = $factura;


        $this->view = 'livewire.servicio-tecnico';
        }
     }


    public function guardar(){

   
    

      /*  if ($this->recibo != '' && $this->recibo != 0 ) {
            $recibo = Servicio_Tecnico::where('recibo', $this->recibo)->exists();
*/
           /* if ($recibo) {
                session()->flash('message', 'El recibo ya se encuentra registrado');
                $this->view = 'livewire.servicio-tecnico';
                
            }else{*/
          /*      Servicio_Tecnico::create([
                'recibo' => '00000001',
                'id_cliente' => $this->id_cliente,
                'id_iva' => $this->id_iva,
                'descripcion_equipo' => $this->descripcion_equipo,
                'fecha' => $this->fecha,
                'monto_sin_iva' => $this->monto_sin_iva,
                'monto_con_iva' => $this->monto_con_iva,
                'abono' => $this->abono,
                'monto_pendiente' => $this->monto_pendiente
                ]);*/
       /*     }
*/


      /*  }else{
            //session()->flash('message', 'El n° de recibo es obligatorio');
          //  $this->view = 'livewire.servicio-tecnico';
        }*/

   /* $pdf = app('dompdf.wrapper');
    $pdf->loadView('pdf.factura_venta');
    return $pdf->streamDownload('prueba.pdf');
*/

    /*
    return response()->streamDownload(function () {
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pdf.factura_venta');
        $pdf->stream();
    }, 'prueba.pdf');*/

    /*public function DownloadNotes(PDF $p) { 
        $note = AcademyLessonNote::where('user_id',auth()->user()->id)->first(); 
        if($note){ 
            $pdf = $p->loadView('pdf.notesPdf',compact('note'))->output(); 
            return response()->streamDownload(function () use ($pdf) { print($pdf); }, md5(time()).".pdf"); 
        } }}*/

      //  $this->default();

     }

     public function default()
{


    $this->identificacion = '';
    $this->name = '';
    $this->telefono = '';
    $this->recibo = '';
    $this->recibo = '';
    $this->id_cliente = '';
    $this->id_iva = '';
    $this->descripcion_equipo = '';
   // $this->fecha = '';
    $this->monto_sin_iva = '';
    $this->monto_con_iva = '';
    $this->abono = '';
    $this->monto_pendiente = '';

    $this->view = 'livewire.servicio-tecnico';
}


/*public function buttonImprimir(){

    if($this->monto_pendiente == 0){
            $imprimir = true;
    }else{
        $imprimir = false;
    }
    $this->imprimir = $imprimir;
    $this->view = 'livewire.servicio-tecnico';
}*/


}




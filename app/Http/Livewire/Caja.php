<?php

namespace App\Http\Livewire;

use App\Models\Categorias;
use Livewire\Component;
use App\Models\Productos;
use App\Models\Clientes;
use App\Models\Ivas;
use Livewire\WithPagination;
use App\Models\Tasa_BCV;
use App\Models\Tasa_Otros;
use App\Models\TemporalVenta;
use App\Models\TemporalVentaProducto;


class Caja extends Component
{

    use WithPagination;
    public $cliente, $botoncliente,$total_bs,$sum,$total_dolar,$botonFactura,$id_cliente,$Nombrepdf, $urlpdf,
    $identificacion,$Subtotal,$dispo,$posicionInput,$cantidadProducto,$eliminarId,$total_sin_iva,$reduccionExiste;
    public $searchTerm=[];
    public $ventas = [];
    public $id_categoria = [];
    public $costo=[];
    public $cantidad = [];
    public $total = [];
    public $totalIVA = [];
    public $totalSINIVA = [];
    public $disponible;
    public $stock=[];
    public $impuesto = [];
    public $count = 0;
    public $id_producto=[];
    public $idP=[];
    public $idProducto=[];
    public $montoP=[];
    public $disProducto=[];
    public $costo_dolares=[];
    public $total_dolar_input=[];
    public $select;

    public $confirmingDeletion = false;
    public $Deletion = false;
    public $negada = false;

   public function updatingSearch()
   {
       $this->resetPage();
   }


   public function mount()
      {
        array_push($this->ventas ,1);
        $this->posicionInput=0; 
        $tasadeldiaotros = Tasa_Otros::where('estatus',1)->first();

            if($tasadeldiaotros){
                $tasadia = $tasadeldiaotros->tasa; 
            }else{
                $tasadeldiaBCV = Tasa_BCV::all();
                $tasadia = str_replace("USD ","",$tasadeldiaBCV[0]->tasa);
                $tasadia = str_replace(",",".",$tasadia);
            }
        $this->tasadia = $tasadia;
      }

    public function render()
    {

        
        $data = Categorias::All();
        $productos = Productos::where('unidad', '>', '0')->orderBy('name', 'asc')->get();

        if(count($this->cantidad) != 0 ){

                $cantidadProd=0;
                for($i = 0; $i < count($this->cantidad); $i++){
                    $e = (int)$this->cantidad[$i];
                    if($this->cantidad[$i] != ''){

                    if(count($this->costo) == count($this->cantidad)){
                       $costoi = str_replace(".","",$this->costo[$i]);
                       $costoi = str_replace(",",".",$costoi);

                        $total = ($e*$costoi);

                        if($this->impuesto[$i] == 0){
                            $porcentaje = 0;
                        }else{
                        $iva = Ivas::where('estado', 1)->get();
                        $porcentaje = ($total*$iva[0]->iva)/100;
                        }

                        $this->total[$i] = $total+$porcentaje;

                        $this->total[$i] = number_format($this->total[$i], 2);
                        $this->total[$i] = str_replace(","," ",$this->total[$i]);
                        $this->total[$i] = str_replace(".",",",$this->total[$i]);
                        $this->total[$i] = str_replace(" ",".",$this->total[$i]);

                        $this->total_dolar_input[$i] = $total+$porcentaje;
                        $this->total_dolar_input[$i] = ($this->total_dolar_input[$i]*1)/$this->tasadia;
                        $this->total_dolar_input[$i] = number_format($this->total_dolar_input[$i], 2);
                        $this->total_dolar_input[$i] = str_replace(","," ",$this->total_dolar_input[$i]);
                        $this->total_dolar_input[$i] = str_replace(".",",",$this->total_dolar_input[$i]);
                        $this->total_dolar_input[$i] = str_replace(" ",".",$this->total_dolar_input[$i]);

                        $this->totalSINIVA[$i] = $total;
                        $this->totalIVA[$i] = $porcentaje;
                        $this->idProducto[$i] =  $total;

                     
                    }

                    }else{
                        $dispo = 0;
                    }
                    $cantidadProd += $e;
                    $this->cantidadProducto = $cantidadProd;
                }
        }
        $sum = 0;
        $sumIVA = 0;
        $sumSINIVA = 0;

        if(count($this->total) != 0 ){
            $longitud = count($this->total);
            for($i = 0; $i < $longitud; $i++){
                $total = str_replace(".","",$this->total[$i]);
                $total = str_replace(",",".",$total);
                $sum  = $sum+$total;

                $sinIVA = str_replace(".","",$this->totalSINIVA[$i]);
                $sinIVA = str_replace(",",".",$sinIVA);
                $sumSINIVA  = $sumSINIVA+$this->totalSINIVA[$i];


                $toIVA = str_replace(".","",$this->totalIVA[$i]);
                $toIVA = str_replace(",",".",$toIVA);
                $sumIVA  = $sumIVA+$toIVA;
               
            }
            $this->total_IVA = $sumIVA;
            $this->total_IVA = number_format($this->total_IVA, 2);
            $this->total_IVA = str_replace(","," ",$this->total_IVA);
            $this->total_IVA = str_replace(".",",",$this->total_IVA);
            $this->total_IVA = str_replace(" ",".",$this->total_IVA);

            $this->total_sin_iva = $sumSINIVA;
            $this->total_sin_iva = number_format($this->total_sin_iva, 2);
            $this->total_sin_iva = str_replace(","," ",$this->total_sin_iva);
            $this->total_sin_iva = str_replace(".",",",$this->total_sin_iva);
            $this->total_sin_iva = str_replace(" ",".",$this->total_sin_iva);


            $this->total_bs =  $sum;
            $this->total_bs = number_format($this->total_bs, 2);
            $this->total_bs = str_replace(","," ",$this->total_bs);
            $this->total_bs = str_replace(".",",",$this->total_bs);
            $this->total_bs = str_replace(" ",".",$this->total_bs);

            

                $total_dolar = ($sum*1)/$this->tasadia;
                $this->total_dolar = number_format($total_dolar, 2);
                $this->total_dolar = str_replace(","," ",$this->total_dolar);
                $this->total_dolar = str_replace(".",",",$this->total_dolar);
                $this->total_dolar = str_replace(" ",".",$this->total_dolar);

                $this->botonFactura = 'true';

        }else{
            $this->botonFactura = 'false';
            $this->total_dolar = '';
            $this->total_bs = '';
            $this->cantidadProducto = '0';
        }


        /*********Si tiene cambio el select productos************** */
        if($this->select != 0){
            $this->id_producto = $this->select;
            $this->seleccionBuscador();
        }

        date_default_timezone_set('America/Caracas');
        return view('livewire.caja',['categorias'  => $data,
        'productos'  => $productos,
        'description' =>'',
        'fecha_factura' => date('d/m/Y'),
    ]);
    }

    public function Buscar(){
    
     $cliente = Clientes::where('identificacion',$this->identificacion)->get();

     if (isset($cliente[0])) {

        if($cliente[0]->estatus == 1){
        $this->name=  $cliente[0]->name;
        $this->id_cliente=  $cliente[0]->id;
        $this->telefono =  $cliente[0]->telefono;
        $this->direccion =  $cliente[0]->direccion;

        $this->view = 'livewire.caja';

        }else{
            session()->flash('message', 'El cliente se encuentra desactivado');
            $this->botoncliente = 'false';
            $this->view = 'livewire.caja';
        }

    }else{
        session()->flash('message', 'No se encuentra registrado debe registrar el cliente');
        $this->botoncliente = 'true';
        $this->view = 'livewire.caja';
    }

    }


    public function seleccionBuscador(){

        $dataProducto = Productos::find($this->select);
            if($this->id_producto != ''){ 

                if($dataProducto->unidad != 0){
                $this->searchTerm[($this->posicionInput)] = $dataProducto->name;
                $this->costo[($this->posicionInput)] = $dataProducto->precio_sin_iva;
                $this->costo[($this->posicionInput)] = number_format($this->costo[($this->posicionInput)], 2);
                $this->costo[($this->posicionInput)] = str_replace(","," ",$this->costo[($this->posicionInput)]);
                $this->costo[($this->posicionInput)] = str_replace(".",",",$this->costo[($this->posicionInput)]);
                $this->costo[($this->posicionInput)] = str_replace(" ",".",$this->costo[($this->posicionInput)]);
    
                $this->costo_dolares[($this->posicionInput)] = ($dataProducto->precio_sin_iva*1)/$this->tasadia;
                $this->costo_dolares[($this->posicionInput)] = number_format($this->costo_dolares[($this->posicionInput)], 2);
                $this->costo_dolares[($this->posicionInput)] = str_replace(","," ",$this->costo_dolares[($this->posicionInput)]);
                $this->costo_dolares[($this->posicionInput)] = str_replace(".",",",$this->costo_dolares[($this->posicionInput)]);
                $this->costo_dolares[($this->posicionInput)] = str_replace(" ",".",$this->costo_dolares[($this->posicionInput)]);
    
                $this->disponible = $dataProducto->unidad;
                $this->disProducto[($this->posicionInput)] = $dataProducto->unidad;
                $this->idP[($this->posicionInput)] = $dataProducto->id;
                $this->impuesto[($this->posicionInput)] = $dataProducto->exento;
      
                }else{
                    $this->disponible = 0;
                }
            }else{$this->disponible = '';}
        $this->reset('select');       
    }

    public function agregarProductos(){

        $this->count++;
        if(count($this->ventas) == count($this->searchTerm)){

            if(count($this->cantidad) == count($this->searchTerm)){
                array_push($this->ventas ,$this->count);
                $this->posicionInput = $this->count;
            }
        }else{
            $this->Deletion=true;
        }
        $this->view = 'livewire.caja';
    }

    public function eliminarProductos()
    {
        $this->confirmingDeletion=false;
    if($this->eliminarId != 0){
        unset($this->ventas[($this->eliminarId)]);
        $this->ventas = array_values($this->ventas);

        unset($this->searchTerm[($this->eliminarId)]);
        $this->searchTerm = array_values($this->searchTerm);

        unset($this->costo[($this->eliminarId)]);
        $this->costo = array_values($this->costo);

        unset($this->cantidad[($this->eliminarId)]);
        $this->cantidad = array_values($this->cantidad);

        unset($this->total[($this->eliminarId)]);
        $this->total = array_values($this->total);

        unset($this->impuesto[($this->eliminarId)]);
        $this->impuesto = array_values($this->impuesto);

        unset($this->costo_dolares[($this->eliminarId)]);
        $this->costo_dolares = array_values($this->costo_dolares);

        unset($this->total_dolar_input[($this->eliminarId)]);
        $this->total_dolar_input = array_values($this->total_dolar_input);

        $this->posicionInput = $this->posicionInput-1;
        $this->count = $this->count-1;

    }else{
        if(count($this->ventas) == 1){

            unset($this->searchTerm[($this->eliminarId)]);
            $this->searchTerm = array_values($this->searchTerm);
    
            unset($this->costo[($this->eliminarId)]);
            $this->costo = array_values($this->costo);
    
            unset($this->cantidad[($this->eliminarId)]);
            $this->cantidad = array_values($this->cantidad);
    
            unset($this->total[($this->eliminarId)]);
            $this->total = array_values($this->total);
    
            unset($this->impuesto[($this->eliminarId)]);
            $this->impuesto = array_values($this->impuesto);
    
            unset($this->costo_dolares[($this->eliminarId)]);
            $this->costo_dolares = array_values($this->costo_dolares);
    
            unset($this->total_dolar_input[($this->eliminarId)]);
            $this->total_dolar_input = array_values($this->total_dolar_input);

            $this->posicionInput = 0;
            $this->count = 0;

        }else{

            unset($this->ventas[($this->eliminarId)]);
            $this->ventas = array_values($this->ventas);

            unset($this->searchTerm[($this->eliminarId)]);
            $this->searchTerm = array_values($this->searchTerm);

            unset($this->costo[($this->eliminarId)]);
            $this->costo = array_values($this->costo);

            unset($this->cantidad[($this->eliminarId)]);
            $this->cantidad = array_values($this->cantidad);

            unset($this->total[($this->eliminarId)]);
            $this->total = array_values($this->total);

            unset($this->impuesto[($this->eliminarId)]);
            $this->impuesto = array_values($this->impuesto);

            unset($this->costo_dolares[($this->eliminarId)]);
            $this->costo_dolares = array_values($this->costo_dolares);

            unset($this->total_dolar_input[($this->eliminarId)]);
            $this->total_dolar_input = array_values($this->total_dolar_input);

            $this->posicionInput = $this->posicionInput-1;
            $this->count = $this->count-1;
        }
    }
        $this->view = 'livewire.caja';
    }


 public function redireccionar(){

    if($this->identificacion !== null){
    /***************Venta**************** */
    $temporalVenta = TemporalVenta::all();
    if(count($temporalVenta) != 0){
        TemporalVenta::destroy($temporalVenta[0]->id);
    }

        $temporal_Venta = new TemporalVenta();
        $temporal_Venta->id = 1;
        $temporal_Venta->id_cliente = $this->id_cliente;
        $temporal_Venta->sub_total = $this->total_sin_iva;
        $temporal_Venta->iva = $this->total_IVA;
        $temporal_Venta->total = $this->total_bs;

        /***************Producto**************** */ 
        $temporalVentaProducto = TemporalVentaProducto::all();   
        $longitudP = count($this->searchTerm);

        if(count($temporalVentaProducto) != 0){
            TemporalVentaProducto::where('id_venta', '=', '1')->delete();
        }

        for($i = 0; $i < $longitudP; $i++){

            if($i == 0){
            $temporalVentaP = new TemporalVentaProducto();
            $temporalVentaP->id = 1;
            $temporalVentaP->id_venta = 1;
            $temporalVentaP->id_producto = $this->idP[$i];
            $temporalVentaP->cantidad = $this->cantidad[$i];
            $temporalVentaP->total = $this->total[$i];
            $temporalVentaP->save();
            }else{
                $temporalVentaP = new TemporalVentaProducto();
                $temporalVentaP->id = $i+1;
                $temporalVentaP->id_venta = 1;
                $temporalVentaP->id_producto = $this->idP[$i];
                $temporalVentaP->cantidad = $this->cantidad[$i];
                $temporalVentaP->total = $this->total[$i];
                $temporalVentaP->save(); 
            }
        }

    $temporal_Venta->save();
    return redirect()->to('/procesarPago');
}else{
    session()->flash('message', 'Debe llenar los campos del cliente');
    $this->view = 'livewire.caja';
}

}

    public function modalEliminar($eliminarId){
        $this->eliminarId = $eliminarId;
        $this->confirmingDeletion=true;
    }

    public function cerrar()
    {
        $this->confirmingDeletion=false;
        $this->Deletion=false;
        $this->negada=false;
    }
}

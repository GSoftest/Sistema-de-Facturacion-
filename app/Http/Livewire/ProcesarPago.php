<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MetodoPago;
use App\Models\Tasa_BCV;
use App\Models\Tasa_Otros;
use App\Models\TemporalVenta;
use App\Models\TemporalVentaProducto;
use App\Models\Ivas;
use App\Models\Productos;
use App\Models\Ventas;
use App\Models\Ventas_Productos;
use App\Models\Factura;
use App\Models\Clientes;
use Illuminate\Support\Facades\Redirect;

class ProcesarPago extends Component
{

     public $id_metodo=[];
     public $habilitado = [];
     public $count,$selector;
     public $metodosCeldas=[];
     public $pago = [];
     public $tipomoneda = [];
     public $conversion = [];
     public $conversionMonto = [];
     public $conversionMonto1 = [];
     public $habilitarBoton,$totalTemporal,$subtotal,$iva,$total,$igtf,$granTotal,$porcentajeiva;
     public $tipo_metodo = [];
     public $list_pago_bs = [];
     public $id_cliente,$id_venta_temporal,$Nombrepdf,$urlpdf;
     public $productos = [];
     public $cantidad = [];
     public $totalp = [];
     public $impuestop= [];

     public $modalImprimirFactura = false;
     public $descargarFactura = false;
     public $confirmingDeletion = false;


     public $listeners = ['Refresh' => 'render'];

     public function mount()
      {
        array_push($this->metodosCeldas ,1);
        array_push($this->habilitado ,false);
        array_push($this->conversion ,false);
        $this->habilitarBoton = false;
        $totalTemporal = TemporalVenta::all();
        $this->subtotal = $totalTemporal[0]->sub_total;
        $this->iva = $totalTemporal[0]->iva;
        $this->total = $totalTemporal[0]->total;
        $this->id_cliente = $totalTemporal[0]->id_cliente;
        $this->id_venta_temporal = $totalTemporal[0]->id;
        $porcentajeiva  = Ivas::where('estado', 1)->get();
        $this->porcentajeiva  = $porcentajeiva[0]->iva;
        $this->porcentajeiva = str_replace(".",",",$this->porcentajeiva);

      }

    public function render()
    {
        $metodos = MetodoPago::all();
        $tasadeldiaotros = Tasa_Otros::where('estatus',1)->first();

            if($tasadeldiaotros){
                $tasadia = $tasadeldiaotros->tasa; 
            }else{
                $tasadeldiaBCV = Tasa_BCV::all();
                $tasadia = str_replace("USD ","",$tasadeldiaBCV[0]->tasa);
                $tasadia = str_replace(",",".",$tasadia);
            }

        $sumabs=0;
        $sumad=0;
        $sumadolares=0;

        for($i = 0; $i < count($this->metodosCeldas); $i++){
            if(!empty($this->id_metodo[$i])){
                switch($this->id_metodo[$i]){
                    case ($this->id_metodo[$i] == 1);
                    case ($this->id_metodo[$i] == 3);
                    case ($this->id_metodo[$i] == 5);
                        if(!empty($this->pago[$i])){
                            $this->conversion[$i] = true;
                            $montobs = str_replace(".","",$this->pago[$i]);
                            $montobs = str_replace(",",".",$montobs);
                            $this->conversionMonto[$i] = ($montobs*1)/$tasadia;
                            $sumabs += $montobs;
                            $this->conversionMonto[$i] = number_format($this->conversionMonto[$i], 2);
                            $this->conversionMonto[$i] = str_replace(","," ",$this->conversionMonto[$i]);
                            $this->conversionMonto[$i] = str_replace(".",",",$this->conversionMonto[$i]);
                            $this->conversionMonto[$i] = str_replace(" ",".",$this->conversionMonto[$i]);
                            $this->conversionMonto[$i] = $this->conversionMonto[$i];
                            $this->conversionMonto1[$i] = '$ '.$this->conversionMonto[$i];
                            $this->tipomoneda[$i] = '$';
                            for($x = 0; $x < count($metodos); $x++){
                                if(!empty($metodos[$x]->id)){
                                    if($metodos[$x]->id == $this->id_metodo[$i]){
                                        $this->tipo_metodo[$i] = $metodos[$x]->descripcion;
                                    }
                                }
                            }
                            $this->list_pago_bs[$i] = $this->pago[$i];

                        }
                    break;
                    case ($this->id_metodo [$i]== 2);
                    case ($this->id_metodo[$i] == 4);
                    case ($this->id_metodo[$i] == 6);
                    case ($this->id_metodo[$i] == 7);
                    case ($this->id_metodo[$i] == 8);
                    case ($this->id_metodo[$i] == 9);
                    case ($this->id_metodo[$i] == 10);   
                        if(!empty($this->pago[$i])){
                            $this->conversion[$i] = true;
                            $montod = str_replace(".","",$this->pago[$i]);
                            $montod = str_replace(",",".",$montod);
                            $this->conversionMonto[$i] = ($montod*$tasadia)/1;
                            $sumad += $this->conversionMonto[$i];
                            $this->conversionMonto[$i] = number_format($this->conversionMonto[$i], 2);
                            $this->conversionMonto[$i] = str_replace(","," ",$this->conversionMonto[$i]);
                            $this->conversionMonto[$i] = str_replace(".",",",$this->conversionMonto[$i]);
                            $this->conversionMonto[$i] = str_replace(" ",".",$this->conversionMonto[$i]);
                            $this->conversionMonto1[$i] = 'Bs '.$this->conversionMonto[$i];
                            $this->tipomoneda[$i] = 'Bs';
                            $sumadolares += $montod;

                            for($x = 0; $x < count($metodos); $x++){
                                if(!empty($metodos[$x]->id)){
                                    if($metodos[$x]->id == $this->id_metodo[$i]){
                                        $this->tipo_metodo[$i] = $metodos[$x]->descripcion;
                                    }
                                }
                            }
                            $this->list_pago_bs[$i] = $this->conversionMonto[$i];
                        }

                    break;
                    default:
                       $this->conversion[$i] = false;
                    break;
                }  
            }

            
        }

        /***********IGTF*********** */
        $porcentajeIGTF = (3*$sumadolares)/100;
        $tasaporcentajeIGTF = ($porcentajeIGTF*$tasadia)/1;
        $tasaporcentajeIGTFFormato = number_format($tasaporcentajeIGTF, 2);
        $tasaporcentajeIGTFFormato = str_replace(","," ",$tasaporcentajeIGTFFormato);
        $tasaporcentajeIGTFFormato = str_replace(".",",",$tasaporcentajeIGTFFormato);
        $tasaporcentajeIGTFFormato = str_replace(" ",".",$tasaporcentajeIGTFFormato);
        $this->igtf=$tasaporcentajeIGTFFormato;

        /*************Suma de todos los montos Bs************ */
        $totalSuma = $sumabs+$sumad;
        $totalSumaFormato = number_format($totalSuma, 2);
        $totalSumaFormato = str_replace(","," ",$totalSumaFormato);
        $totalSumaFormato = str_replace(".",",",$totalSumaFormato);
        $totalSumaFormato = str_replace(" ",".",$totalSumaFormato);


       if($this->granTotal != null){
        //dd($totalSumaFormato.' '.$this->granTotal);
        switch($this->granTotal){
            case ($totalSumaFormato == $this->granTotal):
                $this->habilitarBoton = true;
            break;
            default:
                $this->habilitarBoton = false;
            break;
        }

        }

        /*************Total************ */
        $formatototal = $this->total;
        $formatototal = str_replace(".","",$formatototal);
        $formatototal = str_replace(",",".",$formatototal);

        /*************Gran Total************ */
        $granT = $tasaporcentajeIGTF+$formatototal;
        $granT = number_format($granT, 2);
        $granT = str_replace(","," ",$granT);
        $granT = str_replace(".",",",$granT);
        $granT = str_replace(" ",".",$granT);
        $this->granTotal=$granT;
        return view('livewire.procesar-pago',['metodos' => $metodos]);
    }

    public function seleccionMetodoPago($selector)
    {
        if($this->id_metodo[$selector] != ''){
            $this->habilitado[$selector] = true;
            $this->pago[$selector] = '';
            $this->conversion[$selector] = false;
            $this->conversionMonto[$selector] = '';
            $this->tipomoneda[$selector] = '';
        }else{
            $this->habilitado[$selector] = false;
            $this->pago[$selector] = '';
            $this->conversion[$selector] = false;
            $this->conversionMonto[$selector] = '';
            $this->tipomoneda[$selector] = '';
        }
    }


    public function agregarCeldas()
    {
        $this->count++;
        if(count($this->conversionMonto1) == count($this->metodosCeldas)){
        array_push($this->metodosCeldas ,$this->count);
        array_push($this->habilitado ,$this->count);
       }
    }


    public function modalImprimir()
    {
        $this->modalImprimirFactura = true;
    }
    
    
    public function cerrar()
    {
        $this->modalImprimirFactura = false;
        $this->confirmingDeletion = false;
    }

    public function submit()
    {
        date_default_timezone_set('America/Caracas');

        /***************descontar lo disponible***************** */
        $TemporalVentaProduto = TemporalVentaProducto::all();
        $longitudP = count($TemporalVentaProduto);
        for($i = 0; $i < $longitudP; $i++){
            $updateProducto = Productos::find($TemporalVentaProduto[$i]->id_producto);
            $reduccion = ($updateProducto->unidad-$TemporalVentaProduto[$i]->cantidad);
            $updateProducto->unidad = $reduccion;
            $reduccion2 = (int)$reduccion;
            $productos[$i] = $updateProducto->name;
            $cantidad[$i] = $TemporalVentaProduto[$i]->cantidad;
            $totalp[$i] = $TemporalVentaProduto[$i]->total;
            $impuestop[$i] = $updateProducto->exento;
          
            if($reduccion < 0){
                $reduccionExiste = '1';
            }else{
                $updateProducto->save();
            }
        }
      
        if(isset($reduccionExiste) == false){

              /*********Tabla Venta********* */
            $Venta = new Ventas();
            $Venta->id_cliente = $this->id_cliente;
            $Venta->sub_total = $this->subtotal;
            $Venta->iva = $this->iva;
            $Venta->total = $this->total;
            $Venta->total_igtf = $this->iva;
            $Venta->gran_total = $this->total;
            $Venta->fecha = date("Y-m-d h:i:s");
            $Venta->save();
            TemporalVenta::destroy($this->id_venta_temporal);

            /*********Tabla Venta_Productos********* */
            

            for($i = 0; $i < $longitudP; $i++){
                $VentaP = new Ventas_Productos();
                $VentaP->id_venta = $Venta->id;
                $VentaP->id_producto = $TemporalVentaProduto[$i]->id_producto;
                $VentaP->cantidad = $TemporalVentaProduto[$i]->cantidad;
                $VentaP->total = $TemporalVentaProduto[$i]->total;
                $VentaP->save();
            }

            /*********factura********* */
            $ultimaFactura = Factura::orderBy('numero_factura', 'desc')->first();
            $Factura = new Factura();
            if($ultimaFactura == null){
               $Factura->numero_factura = 1;
               $Factura->nombre_factura = 'Factura'.$Factura->numero_factura.'.pdf';
           }else{
               $Factura->numero_factura = $ultimaFactura->numero_factura+1;
               $Factura->nombre_factura = 'Factura'.$Factura->numero_factura.'.pdf';
           }

            $Factura->id_venta = $Venta->id;
            $Factura->save();
            $facturanu = Factura::selectRaw('numero_factura, lpad(numero_factura, 15, 0), id')->where('nombre_factura',$Factura->nombre_factura)->first();
            $facturanumero = $facturanu['lpad(numero_factura, 15, 0)'];

            /**********se crea el pdf************** */
            $pdf = app('dompdf.wrapper');

            $cliente = Clientes::find($this->id_cliente);

            $datapdf = [
                'fecha' => date("d/m/Y"),
                'hora' => date("h:i:s"),
                'name' => $cliente->name,
                'identificacion' => $cliente->identificacion,
                'telefono' => $cliente->telefono,
                'direccion' => $cliente->direccion,
                'factura' => $facturanumero,
                'productos' => $productos,
                'cantidad' => $cantidad,
                'totalp' => $totalp,
                'impuestop' => $impuestop,
                'SubtotalF' => $this->subtotal,
                'ivaF' => $this->iva,
                'total_bs' => $this->total,
                'porcentajeIva' => $this->porcentajeiva,
                'total_igtf' => $this->igtf,
                'gran_total' => $this->granTotal,
                'tipo_metodo' => $this->tipo_metodo,
                'list_pago_bs' =>$this->list_pago_bs,
            ];

            $pdf->loadView('pdf.factura_venta',compact('datapdf'));
          //  $pdf->setPaper('b7', 'portrait');
            $pdf->save(public_path('app/archivos/facturas_ventas/') .$Factura->nombre_factura);
            $this->urlpdf='app/archivos/facturas_ventas/'.$Factura->nombre_factura;
            $this->Nombrepdf = $Factura->nombre_factura;
            $pdf->render();
            $this->descargarFactura=true;
        }else{
            //$this->negada=true;
        }
    }

    public function cerrarModalFactura()
    {
      $this->descargarFactura=false;
      $this->modalImprimirFactura = false;
      return Redirect::route('caja');
    }

    public function modalEliminar($eliminarId){
        $this->eliminarId = $eliminarId;
        $this->confirmingDeletion=true;
    }


    public function eliminarProductos()
    {
        if($this->eliminarId != 0){
            unset($this->metodosCeldas[($this->eliminarId)]);
            $this->metodosCeldas = array_values($this->metodosCeldas);

            unset($this->pago[($this->eliminarId)]);
            $this->pago = array_values($this->pago);

            unset($this->conversion[($this->eliminarId)]);
            $this->conversion = array_values($this->conversion);

            unset($this->conversionMonto1[($this->eliminarId)]);
            $this->conversionMonto1 = array_values($this->conversionMonto1);
        }else{
            if(count($this->metodosCeldas) == 1){

                $this->reset('id_metodo');

                unset($this->pago[($this->eliminarId)]);
                $this->pago = array_values($this->pago);
    
                unset($this->conversion[($this->eliminarId)]);
                $this->conversion = array_values($this->conversion);
    
                unset($this->conversionMonto1[($this->eliminarId)]);
                $this->conversionMonto1 = array_values($this->conversionMonto1);
            }else{

            unset($this->id_metodo[($this->eliminarId)]);
            $this->id_metodo = array_values($this->id_metodo);

            unset($this->metodosCeldas[($this->eliminarId)]);
            $this->metodosCeldas = array_values($this->metodosCeldas);

            unset($this->pago[($this->eliminarId)]);
            $this->pago = array_values($this->pago);

            unset($this->conversion[($this->eliminarId)]);
            $this->conversion = array_values($this->conversion);

            unset($this->conversionMonto1[($this->eliminarId)]);
            $this->conversionMonto1 = array_values($this->conversionMonto1);
            
            }
        }
        $this->confirmingDeletion=false;
    }

    public function refrescar(){
        $this->emit('Refresh');
    }
}

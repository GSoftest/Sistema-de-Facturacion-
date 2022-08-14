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
use App\Models\Ventas;
use App\Models\Ventas_Productos;
use App\Models\Factura;
use Illuminate\Support\Facades\Redirect;


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
    public $count = 1;
    public $id_producto=[];
    public $idP=[];
    public $idProducto=[];
    public $montoP=[];
    public $disProducto=[];

    public $confirmingUserDeletion = false;
    public $confirmingDeletion = false;
    public $descargarFactura = false;
    public $Deletion = false;
    public $negada = false;

   public function updatingSearch()
   {
       $this->resetPage();
   }

    public function render()
    {

        $data = Categorias::All();
       
      $productos = Productos::where('unidad', '>', '0')->get();
     
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

                        $this->total[$i] = $total;
                        $this->total[$i] = number_format($this->total[$i], 2);
                        $this->total[$i] = str_replace(","," ",$this->total[$i]);
                        $this->total[$i] = str_replace(".",",",$this->total[$i]);
                        $this->total[$i] = str_replace(" ",".",$this->total[$i]);

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


            $this->total_bs = $sum+$sumIVA;
            $this->total_bs = number_format($this->total_bs, 2);
            $this->total_bs = str_replace(","," ",$this->total_bs);
            $this->total_bs = str_replace(".",",",$this->total_bs);
            $this->total_bs = str_replace(" ",".",$this->total_bs);

            $tasadeldiaotros = Tasa_Otros::where('estatus',1)->first();

            if($tasadeldiaotros){
                $tasadia = $tasadeldiaotros->tasa; 
            }else{
                $tasadeldiaBCV = Tasa_BCV::all();
                $tasadia = str_replace("USD ","",$tasadeldiaBCV[0]->tasa);
                $tasadia = str_replace(",",".",$tasadia);
            }

                $total_dolar = ($sum*1)/$tasadia;
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


    public function change(){
        if ($this->id_categoria != '' && $this->id_categoria != null) {
            $productos = Productos::where('id_categoria', $this->id_categoria)->get();
        }else{
           $productos = Productos::where('unidad', '>', '0')->get();
        }
            $this->productos = $productos;
            $this->view = 'livewire.servicio-tecnico';
    }

public function seleccionBuscador(){
    
    $cant = count($this->ventas);
    $dataProducto = Productos::find($this->id_producto);
    if($cant == 0){
        if($this->id_producto != ''){ 
        if(count($this->searchTerm) == 0){
           
            if($dataProducto->unidad != 0){
            $this->searchTerm[0] = $dataProducto->name;
            $this->costo[0] = $dataProducto->precio_sin_iva;
            $this->costo[0] = number_format($this->costo[0], 2);
            $this->costo[0] = str_replace(","," ",$this->costo[0]);
            $this->costo[0] = str_replace(".",",",$this->costo[0]);
            $this->costo[0] = str_replace(" ",".",$this->costo[0]);

            $this->disponible = $dataProducto->unidad;
            $this->disProducto[0] = $dataProducto->unidad;
            $this->impuesto[0] = $dataProducto->exento;
            $this->idP[0] = $dataProducto->id;
            $this->posicionInput=0; 
            }else{
                $this->disponible = 0;
            }
        }else{
            $this->disponible = $dataProducto->unidad;
        }
      }else{$this->disponible = '';}
    }else{
        if($this->id_producto != ''){ 
        if(count($this->searchTerm) == count($this->ventas)){
            if($dataProducto->unidad != 0){
            $this->searchTerm[($this->posicionInput)] = $dataProducto->name;
            $this->costo[($this->posicionInput)] = $dataProducto->precio_sin_iva;
            $this->costo[($this->posicionInput)] = number_format($this->costo[($this->posicionInput)], 2);
            $this->costo[($this->posicionInput)] = str_replace(","," ",$this->costo[($this->posicionInput)]);
            $this->costo[($this->posicionInput)] = str_replace(".",",",$this->costo[($this->posicionInput)]);
            $this->costo[($this->posicionInput)] = str_replace(" ",".",$this->costo[($this->posicionInput)]);
            $this->disponible = $dataProducto->unidad;
            $this->disProducto[($this->posicionInput)] = $dataProducto->unidad;
            $this->idP[($this->posicionInput)] = $dataProducto->id;
            $this->impuesto[($this->posicionInput)] = $dataProducto->exento;
            }else{
                $this->disponible = 0;
            }

        }else{
            $this->disponible = $dataProducto->unidad;
        }
        }else{$this->disponible = '';}
    }

}


    public function agregarProductos(){

        $this->count++;

        if(count($this->ventas) != count($this->searchTerm)){

            if(count($this->cantidad) == count($this->searchTerm)){
                array_push($this->ventas ,$this->count);
                if(count($this->searchTerm) == $this->posicionInput){
                    $this->posicionInput = count($this->searchTerm);
                }else{
                    $this->posicionInput = count($this->ventas);
                }
            }
        }else{
            $this->Deletion=true;
        }

        $this->view = 'livewire.caja';
    }

    public function eliminarProductos()
    {

        $i =  $this->eliminarId;
        $this->confirmingDeletion=false;

    

        if(count($this->ventas) != count($this->searchTerm)){

        unset($this->ventas[($i)]);
        $this->ventas = array_values($this->ventas);

        unset($this->searchTerm[($i)]);
        $this->searchTerm = array_values($this->searchTerm);

        unset($this->costo[($i)]);
        $this->costo = array_values($this->costo);

        unset($this->cantidad[($i)]);
        $this->cantidad = array_values($this->cantidad);

        unset($this->total[($i)]);
        $this->total = array_values($this->total);

        unset($this->impuesto[($i)]);
        $this->impuesto = array_values($this->impuesto);

    
        $this->posicionInput = count($this->ventas)+1;
        }else{

            if( $i == count($this->ventas)){
                
                array_pop($this->ventas);
                $this->ventas = array_values($this->ventas);
        

              
            }else{
                $this->Deletion=true;
            }
        }

    }

    public function modal(){
        $this->confirmingUserDeletion=true;
    }


    public function modalEliminar($eliminarId){
        $this->eliminarId = $eliminarId;
        $this->confirmingDeletion=true;
    }

    public function cerrar()
    {
        $this->confirmingUserDeletion=false;
        $this->confirmingDeletion=false;
        $this->Deletion=false;
        $this->negada=false;
    }

    public function submit(){
        date_default_timezone_set('America/Caracas');

        
        /***************descontar lo disponible***************** */
            $longitudDisP = count($this->disProducto);

            for($i = 0; $i < $longitudDisP; $i++){
                $updateProducto = Productos::find($this->idP[$i]);
                $reduccion = ($updateProducto->unidad-$this->cantidad[$i]);
                $updateProducto->unidad = $reduccion;
                $reduccion2 = (int)$reduccion;
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
        $Venta->sub_total = $this->total_sin_iva;
        $Venta->iva = $this->total_IVA;
        $Venta->total = $this->total_bs;
        $Venta->fecha = date("Y-m-d h:i:s");
        $Venta->save();

         /*********Tabla Venta_Productos********* */
        $longitudP = count($this->searchTerm);

        for($i = 0; $i < $longitudP; $i++){
            $VentaP = new Ventas_Productos();
            $VentaP->id_venta = $Venta->id;
            $VentaP->id_producto = $this->idP[$i];
            $VentaP->cantidad = $this->cantidad[$i];
            $VentaP->total = $this->total[$i];
            $VentaP->save();
        }


         /*********Tabla factura********* */
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

         $porcentajeIva = Ivas::where('estado',1)->get();
         $porcentajeIva = $porcentajeIva[0]->iva;
   

        /**********se crea el pdf************** */
        $pdf = app('dompdf.wrapper');
        $datapdf = [
            'fecha' => date("d/m/Y"),
            'hora' => date("h:i:s"),
            'name' => $this->name,
            'identificacion' => $this->identificacion,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'factura' => $facturanumero,
            'productos' => $this->searchTerm,
            'cantidad' => $this->cantidad,
            'total_IVA' => $this->total_IVA,
            'total_sin_iva' => $this->total_sin_iva,
            'total_bs' => $this->total_bs,
            'porcentajeIva' => $porcentajeIva,
            'productosMonto' => $this->idProducto,
            'coniva' => $this->impuesto,
        ];

        $pdf->loadView('pdf.factura_venta',compact('datapdf'));
        $pdf->save(public_path('app/archivos/facturas_ventas/') .$Factura->nombre_factura);
        $this->urlpdf='app/archivos/facturas_ventas/'.$Factura->nombre_factura;
        $this->Nombrepdf= $Factura->nombre_factura;
        $pdf->render();

        $this->confirmingUserDeletion=false;
        $this->descargarFactura=true;

    }else{
        $this->negada=true;
    }

    }

    public function cerrarModalFactura()
    {
      return Redirect::route('caja');
    }


  /*  public function reducionNegada()
    {
        $this->confirmingUserDeletion=false;
        $this->negada=true;

        $this->view = 'livewire.caja';
    }*/
}

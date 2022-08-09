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
    $identificacion,$Subtotal,$dispo,$posicionInput,$cantidadProducto,$eliminarId,$total_sin_iva;
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

    public $confirmingUserDeletion = false;
    public $confirmingDeletion = false;
    public $descargarFactura = false;
   // private $productos;

   public function updatingSearch()
   {
       $this->resetPage();
   }

    public function render()
    {

        $data = Categorias::All();
       /* if($this->searchTerm){
            $searchTerm = '%' .$this->searchTerm[0]. '%';
        }else{
            $searchTerm = '%' .''. '%';
        }*/
        
     //   $productos = Productos::where('name','like', '%' .''. '%')->get();
      $productos = Productos::all();
      //  $links  = $productos;

        //$this->costo_unitario = '';
    
        if(count($this->cantidad) != 0 ){

         /* if(count($this->cantidad) == 1){
            if($this->cantidad[0] != ''){
            $disponible = Productos::where('name',$this->searchTerm[0])->get();

            $dispo = ($disponible[0]->unidad - $this->cantidad[0]);
            $total = ($this->cantidad[0]*$this->costo[0]);
            $this->total[0] = $total;
                dd('');
            }else{
               $dispo = 0;
            }
                //array_push($this->stock,$dispo);
                $this->stock[0] = $dispo;

            }else{*/
                $cantidadProd=0;
                for($i = 0; $i < count($this->cantidad); $i++){

                    if($this->cantidad[$i] != ''){
                       //  $disponible = Productos::where('name',$this->searchTerm[$i])->get();
                        // $dispo = ($disponible[0]->unidad - $this->cantidad[($i)]);
                       //  array_push($this->stock,$dispo);
                        $total = ($this->cantidad[$i]*$this->costo[ $i]);

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

                        $this->totalSINIVA[$i] = $total;
                        $this->totalIVA[$i] = $porcentaje;
                    }else{
                        $dispo = 0;
                    }
                    //$this->stock[$i] = $dispo;

                    $cantidadProd += $this->cantidad[$i];
                    $this->cantidadProducto = $cantidadProd;
                }
          //  }



                
           // $this->disponible = $disponible;
        }/*else{
            $disponible = 0;
        }*/

        $sum = 0;
        $sumIVA = 0;
        $sumSINIVA = 0;

        if(count($this->total) != 0 ){
            $longitud = count($this->total);
            for($i = 0; $i < $longitud; $i++){
                $total = str_replace(".","",$this->total[$i]);
                $total = str_replace(",",".",$total);
                $sum  = $sum+$total;

                   // dd($this->totalSINIVA[0]);
                //$sinIVA = str_replace(".","",$this->totalSINIVA[$i]);
                //$sinIVA = str_replace(",",".",$sinIVA);
                 $sumSINIVA  = $sumSINIVA+$this->totalSINIVA[$i];


                $toIVA = str_replace(".","",$this->totalIVA[$i]);
                $toIVA = str_replace(",",".",$toIVA);
                $sumIVA  = $sumIVA+$toIVA;
               
            }
            $this->total_bs = $sum;
            $this->total_bs = number_format($this->total_bs, 2);
            $this->total_bs = str_replace(","," ",$this->total_bs);
            $this->total_bs = str_replace(".",",",$this->total_bs);
            $this->total_bs = str_replace(" ",".",$this->total_bs);


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

    public function Buscar()
    {
        

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


    public function change($valor){

     //   $this->searchTerm[$valor] = '';
      //  $this->costo[$valor] = '';

        /*if($this->searchTerm){
            $searchTerm = '%' .$this->searchTerm[$valor] . '%';
        }else{
            $searchTerm = '%' .''. '%';
        }*/
        

            if ($this->id_categoria != '' && $this->id_categoria != null) {
               // $productos = Productos::where('id_categoria', $this->id_categoria)->where('name','like', $searchTerm)->get();
               $productos = Productos::where('id_categoria', $this->id_categoria)->get();
            }else{
            
           // $productos = Productos::where('name','like', $searchTerm)->get();
           $productos = Productos::all();
            }


            $this->productos = $productos;
            $this->view = 'livewire.servicio-tecnico';
        
    }




 /*   public function search($valor){

    
        $this->costo[$valor] = '';

        if($this->searchTerm){
           // dd($this->searchTerm[$valor]);
            $searchTerm = $this->searchTerm[$valor];
            $searchTerm =  '%'.$searchTerm.'%';
            if($this->id_categoria){
                if ($this->id_categoria != '' && $this->id_categoria != null) {
                    $productos = Productos::where('id_categoria', $this->id_categoria)->where('name','like',$searchTerm)->get();
                }else{
                    $productos = Productos::where('name','like', $searchTerm)->get();
                }
            }else{
                $productos = Productos::where('name','like',$searchTerm)->get();
            }
    
       // $links  = $productos;
       // $this->productos =  collect($productos->items());
        /*$this->productos  = $productos;
        $this->view = 'livewire.servicio-tecnico';*/
    /*    }


    }*/




 /*   public function seleccionBuscador($id)
    {
        $cant = count($this->ventas);
        $dataProducto = Productos::find($id);
        if($cant == 0){

           
            if(count($this->searchTerm) == 0){
                $this->searchTerm[0] = $dataProducto->name;
                $this->costo[0] = $dataProducto->costo_unitario;
                $this->disponible = $dataProducto->unidad;
                $this->impuesto[0] = $dataProducto->exento;
                $this->posicionInput=0; 
            }
 
        }else{
            if(count($this->searchTerm) == count($this->ventas)){
                $this->searchTerm[($this->posicionInput)] = $dataProducto->name;
                $this->costo[($this->posicionInput)] = $dataProducto->costo_unitario;
                $this->impuesto[($this->posicionInput)] = $dataProducto->exento;
            } 
        }
        
        $this->view = 'livewire.caja';
    }
*/

public function seleccionBuscador()
{
    
    $cant = count($this->ventas);
    $dataProducto = Productos::find($this->id_producto);
    if($cant == 0){

        if(count($this->searchTerm) == 0){
            $this->searchTerm[0] = $dataProducto->name;
            $this->costo[0] = $dataProducto->precio_sin_iva;
            $this->disponible = $dataProducto->unidad;
            $this->impuesto[0] = $dataProducto->exento;
            $this->idP[0] = $dataProducto->id;
            $this->posicionInput=0; 
        }else{
            $this->disponible = $dataProducto->unidad;
        }

    }else{
        if(count($this->searchTerm) == count($this->ventas)){
            $this->searchTerm[($this->posicionInput)] = $dataProducto->name;
            $this->costo[($this->posicionInput)] = $dataProducto->precio_sin_iva;
            $this->disponible = $dataProducto->unidad;
            $this->idP[($this->posicionInput)] = $dataProducto->id;
            $this->impuesto[($this->posicionInput)] = $dataProducto->exento;
        }else{
            $this->disponible = $dataProducto->unidad;
        }
    }

}


    public function agregarProductos()
    {

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
            //dd('no va a agregar más');
        }

       // dd($this);
        $this->view = 'livewire.caja';
    }

    public function eliminarProductos()
    {
        $i =  $this->eliminarId;
        unset($this->ventas[($i-1)]);
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
        $this->confirmingDeletion=false;
    }


   /* public function CalcularTotal($i)
    {
    
      /*- if($i=='0'){*/
       //     $total = ($this->cantidad[$i]*$this->costo[$i]);
         //   $this->total[$i] = $total;
        /*}else{
       // dd($this->cantidad[($i)]);
       /* $total = ($this->cantidad[$i]*$this->costo[$i]);
        $this->total[$i] = $total;*/
       // }
   // }*/
   /* public function changeProductos(){


        if ( $this->id_producto != '' &&  $this->id_producto != null) {
            $dataProducto = Productos::find($this->id_producto);
            $this->description = $dataProducto->description;
            $this->costo_unitario = $dataProducto->costo_unitario;
        }else{
            $this->description = '';
            $this->costo_unitario = '';
        }

        $this->view = 'livewire.servicio-tecnico';
        
    }*/

 /*   public function facturar($id)
    {
        $item = Productos::find($id);
  

        if(isset($this->item_id)){

            $cant =  $this->cant+1;
            $this->cant = $cant;
            $this->costo_unitario = $this->costo_unitario+$item->costo_unitario;

        }else{
          
            $this->item_id = $item->id;
            $this->name = $item->name;
            $this->costo_unitario = $item->costo_unitario;
            $this->imagen_url = $item->imagen_url;
            $this->cant = 1;
        }
        $this->view = 'livewire.caja';
    }


    public function destroy($id)
    {
        if($this->item_id == $id){
            $this->item_id = '';
        }

        $this->view = 'livewire.caja';
    }*/

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
    }

    public function submit(){
        date_default_timezone_set('America/Caracas');

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
            'cantidad' => $this->cantidad,
            'total_IVA' => $this->total_IVA,
            'total_sin_iva' => $this->total_sin_iva,
            'total_bs' => $this->total_bs,
        ];

        $pdf->loadView('pdf.factura_venta',compact('datapdf'));
        $pdf->save(public_path('app/archivos/facturas_ventas') .$Factura->nombre_factura);
        $this->urlpdf='app/archivos/facturas_ventas'.$Factura->nombre_factura;
        $this->Nombrepdf= $Factura->nombre_factura;
        $pdf->render();

        $this->confirmingUserDeletion=false;
        $this->descargarFactura=true;
    }

    public function cerrarModalFactura()
    {
      return Redirect::route('caja');
    }


}

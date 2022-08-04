<?php

namespace App\Http\Livewire;

use App\Models\Categorias;
use Livewire\Component;
use App\Models\Productos;
use App\Models\Clientes;
use App\Models\Ivas;
use Livewire\WithPagination;
use phpDocumentor\Reflection\Types\This;

class Caja extends Component
{

    use WithPagination;
    public $cliente,
    $identificacion,$Subtotal,$dispo,$posicionInput,$cantidadProducto;
    public $searchTerm=[];
    public $ventas = [];
    public $id_categoria = [];
    public $costo=[];
    public $cantidad = [];
    public $total = [];
    public $disponible;
    public $stock=[];
    public $impuesto = [];
    public $count = 1;
    public $id_producto=[];
    
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
        $sum = 0;
        if($this->total){
            $logitud = count($this->total);
            foreach($this->total as $indice => $valor){
                $sum+=$valor;
                $this->Subtotal = $sum;
            }
        }


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

                    if($this->cantidad[ $i] != ''){
                       //  $disponible = Productos::where('name',$this->searchTerm[$i])->get();
                        // $dispo = ($disponible[0]->unidad - $this->cantidad[($i)]);
                       //  array_push($this->stock,$dispo);
                        $total = ($this->cantidad[ $i]*$this->costo[ $i]);
                        $iva = Ivas::paginate(4);
                        $this->total[$i] = $total;
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
        $this->telefono =  $cliente[0]->telefono;
        $this->direccion =  $cliente[0]->direccion;

        $this->view = 'livewire.caja';

        }else{
            session()->flash('message', 'El cliente se encuentra desactivado');
            $this->view = 'livewire.servicio-tecnico';
        }


    }else{
        session()->flash('message', 'No se encuentra registrado debe registrar el cliente');
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
            $this->costo[0] = $dataProducto->costo_unitario;
            $this->disponible = $dataProducto->unidad;
            $this->impuesto[0] = $dataProducto->exento;
            $this->posicionInput=0; 
        }else{
            $this->disponible = $dataProducto->unidad;
        }

    }else{
        if(count($this->searchTerm) == count($this->ventas)){
            $this->searchTerm[($this->posicionInput)] = $dataProducto->name;
            $this->costo[($this->posicionInput)] = $dataProducto->costo_unitario;
            $this->disponible = $dataProducto->unidad;
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

    public function eliminarProductos($i)
    {

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
}

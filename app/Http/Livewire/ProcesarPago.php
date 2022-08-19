<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MetodoPago;
use App\Models\Tasa_BCV;
use App\Models\Tasa_Otros;
use App\Models\TemporalVenta;

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
     public $habilitarBoton,$totalTemporal,$subtotal,$iva,$total,$igtf,$granTotal;

     public $modalImprimirFactura = false;
     

     public function mount()
      {
        array_push($this->metodosCeldas ,1);
        array_push($this->habilitado ,false);
        array_push($this->conversion ,false);
        $totalTemporal = TemporalVenta::all();
        $this->subtotal = $totalTemporal[0]->sub_total;
        $this->iva = $totalTemporal[0]->iva;
        $this->total = $totalTemporal[0]->total;

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
                            $this->conversionMonto1[$i] = $this->conversionMonto[$i].'$';
                            $this->tipomoneda[$i] = '$';


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
                            $this->conversionMonto1[$i] = $this->conversionMonto[$i].'Bs';
                            $this->tipomoneda[$i] = 'Bs';
                            $sumadolares += $montod;
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


        switch($this->granTotal){
            case ($totalSumaFormato == $this->granTotal):
                $this->habilitarBoton = true;
            break;
            default:
                $this->habilitarBoton = false;
            break;
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
    }
    
    public function change()
    {


    }
    public function submit()
    {

    }
}

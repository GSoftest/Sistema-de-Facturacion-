<div class="flex flex-col justify-center items-center">
        <!-- <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             {{ __('Lista de servicio técnico') }}
         </h2>
     </x-slot>-->
     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">
            <form wire:submit.prevent="submit" method="post" enctype="multipart/form-data" target="_blank">
                    @csrf

                <div class="px-4 py-5 bg-white sm:p-6">
                    
                <div class="grid grid-cols-1 gap-1  justify-items-stretc">
                    <div class="justify-self-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Procesar Pago') }}
                    </h2>
                    </div>
                </div>

                <div class="pt-8"></div>


                <table class="w-full">
                    <thead>
                        <tr class="">
                            <td class="text-center"><label for="" class="block text-sm font-medium text-gray-700">Método de Pagos</label></td>
                            <td class="text-center"><label for="" class="block text-sm font-medium text-gray-700">Monto</label></td>
                            <td class="text-center"><label for="" class="block text-sm font-medium text-gray-700">
                             @if(!empty($conversionMonto1))
                             <label for="" class="block text-sm font-medium text-gray-700">Conversión
                            </label>
                            @endif
                            </td>
                            <td class="text-center"><label for="" class="block text-sm font-medium text-gray-700"></label></td>
                        </tr>
                    </thead>
                    <tbody>
                        @if($metodosCeldas)
                            @foreach($metodosCeldas as $key => $value)
                            <tr>
                            <td class="w-30 px-2 text-center">
                            <select name="id_metodo.{{$key}}" wire:model="id_metodo.{{$key}}" wire:change="seleccionMetodoPago({{$key}})" class="scroll appearance-none form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="" selected>{{ __("Seleccione") }}</option>
                                @foreach ($metodos as $metodo)
                                <option value="{{ $metodo['id'] }}">{{$metodo['descripcion'] }}</option>
                                @endforeach
                            </select>
                            </td>
                   
                                @if($habilitado[$key] == true)
                                    <td class="w-28 px-2 text-center"><input type="text"  id='pago.{{$key}}' name='pago.{{$key}}' wire:model="pago.{{$key}}" wire:change='refrescar'  placeholder="0,00" onkeyup="convertidor_decimal(this,this.value.charAt(this.value.length-1),2,'pago.{{$key}}')" onkeypress="return myFunction('{{$key}}')" class="text-right justify-self-end mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-24 shadow-sm sm:text-sm border-gray-300 rounded-md"></td>
                                @else
                                    <td class="w-28 px-2 text-center"><input type="text"  id='pago.{{$key}}' name='pago.{{$key}}' wire:model="pago.{{$key}}" placeholder="0,00" onkeyup="convertidor_decimal(this,this.value.charAt(this.value.length-1),2,'pago.{{$key}}')" onkeypress="return myFunction('{{$key}}')" class="text-right justify-self-end mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-24 shadow-sm sm:text-sm border-gray-300 rounded-md" readonly></td>
                                @endif

                                <td class="w-30 px-2 text-center">
                                @if(!empty($conversion[$key]))

                                    @if($conversion[$key] == true)
                                   
                                        <input type="text"  id='conversionMonto1.{{$key}}' name='conversionMonto1.{{$key}}'  wire:model="conversionMonto1.{{$key}}" placeholder="0,00" class="text-right justify-self-end mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-24 shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
                                  
                                    @endif
                                @endif
                                </td>
                            <td class="w-4 px-4 py-4"><button type="button" wire:click='agregarCeldas({{$key}})'><i class="fa fa-plus fa-sm" style="color: green;"></i></button></td>
                            <td class="w-4 px-4 py-4"><button type="button" title='Eliminar' wire:click='modalEliminar({{$key}})'><i class="fa fa-trash-can fa-sm"style="color: red;"></i></button></td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>


<div class="pt-8 flex justify-center">
    <table class="w-3/4 border bg-gray-100 border-gray-100">
        <thead>
            <tr>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="px-2"><label  class="text-sm font-medium text-gray-700">Total:&nbsp;</label></td>
            
                <td class="text-right px-2"><label  class="text-sm font-medium text-gray-700"><strong>Bs&nbsp;{{$total}}</strong></label></td>
            </tr>
            <tr>
                <td class="px-2"><label  class="text-sm font-medium text-gray-700">Total IGTF:&nbsp;</label></td>
            
                <td class="text-right px-2"><label  class="text-sm font-medium text-gray-700"><strong>Bs&nbsp;{{$igtf}}</strong></label></td>
            </tr>
            <tr>
                <td class="px-2"><label  class="text-sm font-medium text-gray-700">Gran Total:&nbsp;</label></td>
             
                <td class="text-right px-2"><label  class="text-sm font-medium text-gray-700"><strong>Bs&nbsp;{{$granTotal}}</strong></label></td>
            </tr>
        </tbody>
    </table>
    </div>



                @if($habilitarBoton == true)
                <div class="flex justify-center py-2 font-light px-6 py-4 whitespace-nowrap">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mt-2  border border-blue-500 rounded py-1.5" type="button"  wire:click='modalImprimir()'>Procesar Factura</button>
                </div>
                @endif
                </div>


<x-jet-dialog-modal wire:model="confirmingDeletion">
    <x-slot name="title">
        <span class="flex justify-center">
        <i class="fa fa-exclamation-circle fa-3x" aria-hidden="true" style="color: red;"></i>
        </span>
    </x-slot>
    <x-slot name="content">
        <span class="flex justify-center">
        ¿Está seguro que desea eliminar?
        </span>
    </x-slot>
        
<x-slot name="footer">
<span class="flex justify-center pt-2">
        <div class="">
        <x-jet-secondary-button class="mx-8"  wire:loading.attr="disabled" wire:click="cerrar">
            No
        </x-jet-secondary-button>
        </div>
        <div class="">
        <x-jet-danger-button class="mx-12" wire:loading.attr="disabled" wire:click="eliminarProductos">
            Sí
            </x-jet-danger-button>
        </div>
        </span>
</x-slot>
</x-jet-dialog-modal>

<x-dialog-modal-procesarpago wire:model="modalImprimirFactura">
    <x-slot name="title">
        <span class="flex justify-start">
            <strong>Factura</strong>
        </span>
    </x-slot>
    <x-slot name="content">
        <table class="w-full border bg-gray-100 border-gray-100">
            <thead></thead>
            <tbody>
                <tr>
                    <td class="text-sm font-medium text-gray-700 px-2">Subtotal:&nbsp;</td>
                    <td class="text-sm font-medium text-gray-700 text-right px-2"><strong>Bs&nbsp;{{$subtotal}}</strong></td>
                </tr>
                <tr>
                    <td class="text-sm font-medium text-gray-700 px-2">IVA {{$porcentajeiva}}%:&nbsp;</td>
                    <td class="text-sm font-medium text-gray-700 text-right px-2"><strong>Bs&nbsp;{{$iva}}</strong></td>
                </tr>
                <tr>
                    <td class="text-sm font-medium text-gray-700 px-2">Total:&nbsp;</td>
                    <td class="text-sm font-medium text-gray-700 text-right px-2"><strong>Bs&nbsp;{{$total}}</strong></td>
                </tr>
                <tr>
                    @if($igtf > '0,00')
                    <td class="text-sm font-medium text-gray-700 px-2">Total IGTF:&nbsp;</td>
                    <td class="text-sm font-medium text-gray-700 text-right px-2"><strong>Bs&nbsp;{{$igtf}}</strong></td>
                    @endif
                </tr>
                <tr>
                    <td class="text-sm font-medium text-gray-700 px-2">Gran Total:&nbsp;</td>
                    <td class="text-sm font-medium text-gray-700 text-right px-2"><strong>Bs&nbsp;{{$granTotal}}</strong></td>
                </tr>
                @foreach($tipo_metodo as $key => $value)
                <tr>
                    <td class="text-sm font-medium text-gray-700 px-2">{{str_replace('Bs','',$value)}}:&nbsp;</td>
                    <td class="text-sm font-medium text-gray-700 text-right px-2"><strong>Bs&nbsp;{{$list_pago_bs[$key]}}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
        <label for="" class="text-sm font-medium text-gray-700">Tamaño de la Factura</label>

        <div class="grid grid-cols-2 gap-1">
            <div><input type="radio" wire:model="factura_radio" value="yes"><label for="" class="text-sm font-medium text-gray-700">&nbsp;Factura Simple</label></div>
            <div><input type="radio" wire:model="factura_radio" value="no"><label for="" class="text-sm font-medium text-gray-700">&nbsp;Factura Fiscal</label></div>
        </div>
        </div>
    </x-slot>
        
<x-slot name="footer">
    <span class="flex justify-center pt-2">
        <div class="">
        <x-blue-button class="mx-8"  wire:loading.attr="disabled" wire:click="submit">
            Imprimir Factura
        </x-blue-button>
        </div>
    </span>
</x-slot>
</x-dialog-modal-procesarpago>

<x-dialog-modal-factura wire:model="descargarFactura">
<x-slot name="title">
        <div class="grid grid-cols-2 gap-4">
            <div>{{$Nombrepdf}}</div>
            <div class="flex justify-end">
                <x-button-cerrar class="mx-8"  wire:loading.attr="disabled" wire:click="cerrarModalFactura">
                <i class="fa fa-times fa-sm" aria-hidden="true"></i>
                </x-jet-button-cerrar>
            </div>
        </div>
    </x-slot>
    <x-slot name="content">
    <embed
    src="{{URL::asset($urlpdf)}}"
    style="width:600px; height:800px;"
    frameborder="0">
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-dialog-modal-factura>

                </form>
            </div>
        </div>
    </div>
</div>
<script>
function myFunction(id) {
  var pagobs = document.getElementById(id);
  var pagodolar = document.getElementById(id);
  pagobs.value = pagobs.value.replace(/[^0-9,,]/g, '').replace(/,/g, ',');
  pagodolar.value = pagodolar.value.replace(/[^0-9,,]/g, '').replace(/,/g, ',');
}

function convertidor_decimal(donde, caracter, campo, id) {
			var decimales = true;
			var dec = campo;
			var pat = /[\*,\+,\(,\),\?,\\,\$,\[,\],\^]/;
			var valor = donde.value;
			var largo = valor.length;
			var crtr = true;
			var cad1 = "";
			var cad2 = "";
			var cad3 = "";
			var tres = 0;
			var nums = 0;
			var cont = 0;
			var ctdd = 0;
			var nmrs = 0;

            var elemento = document.getElementById(id);
            var val = document.getElementById(id).value;

			if (isNaN(caracter) || pat.test(caracter) == true) {
				if (pat.test(caracter) == true) {
					caracter = "\\" + caracter
				}
				carcter = new RegExp(caracter, "g")
				valor = valor.replace(carcter, "")
				donde.value = valor
				crtr = false
			} else {
				var nums = new Array()
				cont = 0
				for (m = 0; m < largo; m++) {
					if (valor.charAt(m) == "." || valor.charAt(m) == " " || valor.charAt(m) == ",") {
						continue;
					} else {
						nums[cont] = valor.charAt(m)
						cont++
					}

				}
			}

			if (decimales == true) {
				ctdd = eval(1 + dec);
				nmrs = 1
			} else {
				ctdd = 1;
				nmrs = 3
			}

			if (largo > nmrs && crtr == true) {

				for (k = nums.length - ctdd; k >= 0; k--) {
					cad1 = nums[k]
					cad2 = cad1 + cad2
					tres++
					if ((tres % 3) == 0) {
						if (k != 0) {
							cad2 = "." + cad2
						}
					}
				}

				for (dd = dec; dd > 0; dd--) {
					cad3 += nums[nums.length - dd]
				}
				if (decimales == true) {
					cad2 += "," + cad3
				}
				var palabra = ",undefined";

				var index = cad2.search(palabra);

				if (index == 0) {
					donde.value = 0;
				} else {
					donde.value = cad2;
				}


			}
			donde.focus()
		}
</script>
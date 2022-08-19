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
                            <td class="text-center"><label for="" class="block text-sm font-medium text-gray-700"></label></td>
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
                                    <td class="w-28 px-2 text-center"><input type="text"  id='pago.{{$key}}' name='pago.{{$key}}' wire:model="pago.{{$key}}" placeholder="0,00" onkeyup="convertidor_decimal(this,this.value.charAt(this.value.length-1),2,'pago.{{$key}}')" onkeypress="return myFunction('{{$key}}')" class="text-right justify-self-end mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-24 shadow-sm sm:text-sm border-gray-300 rounded-md"></td>
                                @else
                                    <td class="w-28 px-2 text-center"><input type="text"  id='pago.{{$key}}' name='pago.{{$key}}' wire:model="pago.{{$key}}" placeholder="0,00" onkeyup="convertidor_decimal(this,this.value.charAt(this.value.length-1),2,'pago.{{$key}}')" onkeypress="return myFunction('{{$key}}')" class="text-right justify-self-end mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-24 shadow-sm sm:text-sm border-gray-300 rounded-md" readonly></td>
                                @endif

                                @if(!empty($conversion[$key]))

                                    @if($conversion[$key] == true)
                                    <td class="w-30 px-2 text-center">
                                        <input type="text"  id='conversionMonto1.{{$key}}' name='conversionMonto1.{{$key}}' wire:loading.remove wire:model="conversionMonto1.{{$key}}" placeholder="0,00" class="text-right justify-self-end mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-24 shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
                                    </td>
                                    @endif
                                @endif

                            <td class="w-8 px-8 py-4"><button type="button" wire:click='agregarCeldas({{$key}})' wire:click="$refresh"><i class="fa fa-plus fa-sm" style="color: green;"></i></button></td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

<div class="pt-8">
<label  class="block text-sm font-medium text-gray-700"><strong>Total Bs: {{$total}}</strong></label>
<label  class="block text-sm font-medium text-gray-700"><strong>Total IGTF Bs: {{$igtf}}</strong></label>
<label  class="block text-sm font-medium text-gray-700"><strong>Gran Total Bs: {{$granTotal}}</strong></label>
</div>



                @if($habilitarBoton == true)
                <div class="flex justify-center py-2 font-light px-6 py-4 whitespace-nowrap">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mt-2  border border-blue-500 rounded py-1.5" type="button"  wire:click='modalImprimir()'>Procesar factura</button>
                </div>
                @endif
                </div>

<x-dialog-modal-procesarpago wire:model="modalImprimirFactura">
    <x-slot name="title">
        <span class="flex justify-start">
            <strong>Factura</strong>
        </span>
    </x-slot>
    <x-slot name="content">
        <span class="flex justify-start">Subtotal Bs:{{$subtotal}}</span>
        <span class="flex justify-start">IVA Bs:{{$iva}}</span>
        <span class="flex justify-start">Total Bs:{{$total}}</span>
        <span class="flex justify-start">Total IGTF Bs:{{$igtf}}</span>
        <span class="flex justify-start">Gran Total Bs:{{$granTotal}}</span>
        <span class="flex justify-start">Total Debito Bs:</span>
    </x-slot>
        
<x-slot name="footer">
<span class="flex justify-center pt-2">
        <div class="pb-3.5 pr-4">
        <x-blue-button class="mx-8"  wire:loading.attr="disabled" wire:click="cerrar">
            Imprimir Factura
        </x-blue-button>
        </div>
        </span>
</x-slot>
</x-dialog-modal-procesarpago>


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
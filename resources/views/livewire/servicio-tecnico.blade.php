<div class="flex flex-col justify-center items-center">
   <!-- <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             {{ __('Servicio Técnico') }}
         </h2>
     </x-slot>-->

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">
                <!-- <form action="{{ route('imprimirFactura')  }}" method="post" id='formulario' enctype="multipart/form-data">-->
  
                     <form wire:submit.prevent="submit" method="post" enctype="multipart/form-data" target="_blank">
                    @csrf
                    <div class="px-4 py-5 bg-white sm:p-6">
                
                    <div class="grid grid-cols-1 gap-1  justify-items-stretc">
                        <div class="justify-self-center">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ __('Servicio Técnico') }}
                            </h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 pt-8 justify-items-stretc">
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div>
                            <label for="identificacion" class="block text-sm font-medium text-gray-700">Cédula o RIF</label>
                            <input type="text" name="identificacion" id="identificacion" wire:model='identificacion' placeholder="V-xxxxxxxx" maxlength="11" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-jet-input-error for="identificacion"/>
                        </div>
                            <div class="pt-4">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mt-2 border border-blue-500 rounded" type="button" wire:click='Buscar()'>Buscar</button>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div></div>
                        <div class="py-2 justify-self-start  w-3/4 md:flex md:items-center">
                                <div>
                                <label for="fecha_servicio" class="block text-sm font-medium text-gray-700">Fecha:&nbsp;</label>
                                </div>
                                <div>
                                <label class="block text-sm font-medium text-gray-700">{{$fecha_servicio}}</label>
                                <input type="hidden" name="fecha_servicio" id="fecha_servicio" value="{{$fecha_servicio}}" wire:model='fecha_servicio'>
                                </div>
                        </div>
                        </div>
                     </div>
                    <div class="py-2">
                        @if (session()->has('message'))
                            <p class="text-sm text-red-600">{{ session('message') }}</p>
                            <div class="py-2">
                                @if($botoncliente == 'true')
                                <a href="{{ route('clientesNuevo') }}" class="bg-green-600 hover:bg-green-500 text-white font-bold py-1 px-2 mt-2 border border-green-500 rounded">Registrar Cliente</a>
                                @elseif($botoncliente == 'false')
                                <a href="{{ route('clientes') }}" class="bg-green-600 hover:bg-green-500 text-white font-bold py-1 px-2 mt-2 border border-green-500 rounded">Listado de Cliente</a>
                                @endif
                            </div>
                    @endif
                    </div>


                    <div class="grid grid-cols-2 gap-4 py-2">
                        <div>
                            <input type="hidden" name="id_cliente" id="id_cliente" wire:model='id_cliente'>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre/Razón Social</label>
                            <input type="text" name="name" id="name" wire:model='name' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required readonly>
                            <x-jet-input-error for="id_cliente"/>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                <input type="text" name="telefono" id="telefono"  wire:model='telefono' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required readonly>
                            </div>
                            <div>
                                <label for="correo" class="block text-sm font-medium text-gray-700">Correo</label>
                                <input type="text" name="correo" id="correo"  wire:model='correo' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required readonly>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div class="py-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Dirección</label>
                        <textarea type="text" name="direccion" id="direccion"  wire:model='direccion' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 resize-y rounded-md" required readonly></textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div class="py-2">
                        <label for="descripcion_equipo" class="block text-sm font-medium text-gray-700">Descripción del Equipo y Falla</label>
                        <textarea type="text" name="descripcion_equipo" id="descripcion_equipo"  wire:model='descripcion_equipo'  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 resize-y rounded-md" required></textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div>
                                <label for="monto_sin_iva" class="block text-sm font-medium text-gray-700">Monto Bs.</label>
                                <input type="text" onkeyup="convertidor_decimal(this,this.value.charAt(this.value.length-1),2,'monto_sin_iva')" onkeypress='return myFunction()' name="monto_sin_iva" id="monto_sin_iva" wire:model="monto_sin_iva" placeholder="0,00" autocorrect="off" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                <x-jet-input-error for="monto_sin_iva"/>
                            </div>


                            <div>
                                <label for="id_iva" class="block text-sm font-medium text-gray-700">IVA</label>
                                <select wire:model="id_iva" name="id_iva" id="id_iva" wire:click="change()" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                 <option value="">{{ __("Seleccione") }}</option>                     
                                 @foreach ($ivas as $iva)
                                 <option value="{{ $iva->id }}">{{str_replace(".",",",str_replace(",","",number_format($iva->iva, 2 )))}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div></div>
                    </div>   
                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div></div>
                            <div>
                                <label for="monto_con_iva" class="block text-sm font-medium text-gray-700">Monto Total Bs.</label>
                                <input type="text" name="monto_con_iva" id="monto_con_iva" wire:model="monto_con_iva"  placeholder="0,00" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required readonly>
                            </div>

                        </div>
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div>
                                <label for="monto_con_iva_dolar" class="block text-sm font-medium text-gray-700">Monto Total $</label>
                                <input type="text" name="monto_con_iva_dolar" id="monto_con_iva_dolar"  wire:model="monto_con_iva_dolar" placeholder="0,00" autocomplete="given-monto_con_iva_dolar" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required readonly>
                         
                            </div>
                        </div>
                    </div> 

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div></div>
                            <div>
                                <label for="abono" class="block text-sm font-medium text-gray-700">Abono Bs.</label>
                                @if($habilitarAbono == 'true')
                                <input type="text" name="abono" id="abono" onkeyup="convertidor_decimal(this,this.value.charAt(this.value.length-1),2,'abono')" onkeypress='return myFunction()' wire:model="abono" placeholder="0,00" autocorrect="off" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @else
                                <input type="text" name="abono" id="abono"  wire:model="abono" onkeyup="convertidor_decimal(this,this.value.charAt(this.value.length-1),2,'abono')" onkeypress='return myFunction()' placeholder="0,00" autocorrect="off" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
                                @endif
                            </div>
                            
                        </div>
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div>
                            <label for="abono_dolar" class="block text-sm font-medium text-gray-700">Abono $</label>
                            <input type="hidden" name="abonodolarbs" id="abonodolarbs" value="{{$abonodolarbs}}"></label>
                            @if($habilitarAbonoDolar == 'true')
                            <input type="text" name="abono_dolar" id="abono_dolar"   onkeyup="convertidor_decimal(this,this.value.charAt(this.value.length-1),2,'abono_dolar')" onkeypress='return myFunction()' wire:model="abono_dolar" onkeyup="myFunction()" placeholder="0,00" autocomplete="given-abono" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @else
                            <input type="text" name="abono_dolar" id="abono_dolar"  wire:model="abono_dolar" onkeyup="myFunction()" placeholder="0,00" autocomplete="given-abono" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
                            @endif

                         </div>
                        </div>
                    </div>


                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div></div>
                            <div>
                                <label for="monto_pendiente" class="block text-sm font-medium text-gray-700">Monto Pendiente Bs.</label>
                                <input type="text" name="monto_pendiente"  wire:model="monto_pendiente" placeholder="0,00" autocomplete="given-monto_pendiente" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required readonly>
                            </div>
                        </div>
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div>
                            <label for="monto_pendiente_dolar" class="block text-sm font-medium text-gray-700">Monto Pendiente $</label>
                            <input type="text" name="monto_pendiente_dolar" id="monto_pendiente_dolar" wire:model="monto_pendiente_dolar" autocomplete="given-monto_pendiente_dolar" placeholder="0,00" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required readonly>  
                            </div>
                        </div>
                    </div>

                  <!--  <div class="py-4">
                            @if (session()->has('message'))
                        <p class="text-sm text-red-600">{{ session('message') }}</p>
                            @endif
                    </div>-->


                    
                    <div class="flex justify-center py-2 font-light px-6 py-4 whitespace-nowrap">
                        
                        <div class="pb-3.5 pr-4">
                            @if($factura == 'true')
                                <input type="hidden" name="factura" id="factura" value="{{$factura}}"/>
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mt-2  border border-blue-500 rounded py-1.5" type="submit">Imprimir factura</button>
                            @elseif($factura == 'false')
                                <input type="hidden" name="factura" id="factura" value="{{$factura}}"/>
                                <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 mt-2  border border-green-500 rounded py-1.5" type="submit">Imprimir Recibo</button>
                            @else
                              <input type="hidden" name="factura" id="factura" value="{{$factura}}"/>
                                <!--<p class="text-sm text-red-600">El abono supera el monto total</p>-->
                            @endif
                        </div>
                    </div> 


                     </div>
                    </form>


<x-dialog-modal-factura wire:model="confirmingUserDeletion">
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


            </div>
        </div>
    </div>
</div>

<script>
function myFunction() {
  var monto_sin_iva = document.getElementById("monto_sin_iva");
  var abono = document.getElementById("abono");
  var abono_dolar = document.getElementById("abono_dolar");
  monto_sin_iva.value = monto_sin_iva.value.replace(/[^0-9,,]/g, '').replace(/,/g, ',');
  abono.value = abono.value.replace(/[^0-9,,]/g, '').replace(/,/g, ',');
  abono_dolar.value = abono_dolar.value.replace(/[^0-9,,]/g, '').replace(/,/g, ',');
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


$(document).ready(function() {
    $('#id_iva').select2({
    minimumResultsForSearch: Infinity
});
});

</script>
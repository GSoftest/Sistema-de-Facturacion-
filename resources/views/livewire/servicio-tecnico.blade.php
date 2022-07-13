<div class="flex flex-col justify-center items-center">
   <!-- <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             {{ __('Servicio Técnico') }}
         </h2>
     </x-slot>-->

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">
  
                    <form action="{{ route('imprimirFactura')  }}" method="post" enctype="multipart/form-data" target="_blank">
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
                            <input type="text" name="identificacion" id="identificacion" wire:model='identificacion' placeholder="V-xxxxxxxx" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="pt-4">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mt-2 border border-blue-500 rounded" type="button" wire:click='Buscar()'>Buscar</button>
                            </div>
                        </div>

                        <div class="py-2 justify-self-end  w-3/4 md:flex md:items-center">
                                <div>
                                <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha:</label>
                                </div>
                                <div>
                                <input type="text" name="fecha" id="fecha" wire:model='fecha' value="{{$fecha_servicio}}" placeholder="{{$fecha_servicio}}" class="appearance-none bg-transparent border-none w-full text-gray-700 text-sm font-medium mr-3 py-1 px-2 leading-tight focus:outline-none" disabled>
                                </div>
                            </div>
                     </div>
                    <div class="py-2">
                        @if (session()->has('message'))
                            <p class="text-sm text-red-600">{{ session('message') }}</p>
                            <div class="py-2">
                                <a href="{{ route('clientesNuevo') }}" class="bg-green-600 hover:bg-green-500 text-white font-bold py-1 px-2 mt-2 border border-green-500 rounded">Registrar Cliente</a>
                            </div>
                    @endif
                    </div>


                    <div class="grid grid-cols-2 gap-4 py-2">
                        <div>
                            <input type="hidden" name="id_cliente" id="id_cliente" wire:model='id_cliente'>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre/Razón Social</label>
                            <input type="text" name="name" id="name" wire:model='name' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required disabled>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                <input type="text" name="telefono" id="telefono"  wire:model='telefono' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required disabled>
                            </div>
                            <div>
                                <label for="correo" class="block text-sm font-medium text-gray-700">Correo</label>
                                <input type="text" name="correo" id="correo"  wire:model='correo' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required disabled>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div class="py-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Dirección</label>
                        <textarea type="text" name="direccion" id="direccion"  wire:model='direccion' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 resize-y rounded-md" required disabled></textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div class="py-2">
                        <label for="descripcion_equipo" class="block text-sm font-medium text-gray-700">Descripción del Equipo y Falla</label>
                        <textarea type="text" name="descripcion_equipo" id="descripcion_equipo"  wire:model='descripcion_equipo' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 resize-y rounded-md" required></textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div>
                                <label for="monto_sin_iva" class="block text-sm font-medium text-gray-700">Monto Bs.</label>
                                <input type="text" name="monto_sin_iva" id="monto_sin_iva" wire:model="monto_sin_iva" placeholder="0,00" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                <x-jet-input-error for="monto_sin_iva"/>
                            </div>


                            <div>
                                <label for="id_iva" class="block text-sm font-medium text-gray-700">Iva</label>
                                <select wire:model="id_iva" name="id_iva" wire:click="change()" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
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
                                <input type="text" name="monto_con_iva" id="monto_con_iva" value="{{ $monto_con_iva }}"  placeholder="0,00" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                        </div>
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div>
                                <label for="monto_con_iva" class="block text-sm font-medium text-gray-700">Monto Total $</label>
                                <input type="text" name="monto_con_iva" id="monto_con_iva" value="{{ $monto_con_iva }}" placeholder="0,00"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                        </div>
                    </div> 

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div></div>
                            <div>
                                <label for="abono" class="block text-sm font-medium text-gray-700">Abono Bs.</label>
                                <input type="text" name="abono" id="abono"  wire:model="abono" wire:change="calculo()"  placeholder="0,00" autocomplete="given-abono" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                            
                        </div>
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div>
                            <label for="abono" class="block text-sm font-medium text-gray-700">Abono $</label>
                            <input type="text" name="abono" id="abono"  wire:model="abono" wire:change="calculo()"  placeholder="0,00" autocomplete="given-abono" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                        </div>
                    </div>


                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div></div>
                            <div>
                                <label for="monto_pendiente" class="block text-sm font-medium text-gray-700">Monto Pendiente Bs.</label>
                                <input type="text" name="monto_pendiente" id="monto_pendiente" wire:model="monto_pendiente" placeholder="0,00" value="{{ $monto_pendiente }}"   autocomplete="given-monto_pendiente" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                        </div>
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div>
                            <label for="abono" class="block text-sm font-medium text-gray-700">Monto Pendiente $</label>
                            <input type="text" name="monto_pendiente" id="monto_pendiente" wire:model="monto_pendiente" placeholder="0,00" value="{{ $monto_pendiente }}"   autocomplete="given-monto_pendiente" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                        </div>
                    </div>

                    <div class="py-4">
                            @if (session()->has('message'))
                        <p class="text-sm text-red-600">{{ session('message') }}</p>
                            @endif
                    </div>


                    
                    <div class="flex justify-center py-2 font-light px-6 py-4 whitespace-nowrap">
                        <input type="hidden" name="factura" id="factura" value="{{$factura}}">
                        <div class="pb-3.5 pr-4">
                            @if($factura == true)
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mt-2  border border-blue-500 rounded py-1.5" type="submit">Imprimir factura</button>
                            @else
                                <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 mt-2  border border-green-500 rounded py-1.5" type="submit">Imprimir Recibo</button>
                            @endif
                        </div>
                    </div> 


                     </div>
                    </form>
            </div>
        </div>
    </div>
</div>

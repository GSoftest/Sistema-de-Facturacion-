<div>
    <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             {{ __('Servicio Técnico') }}
         </h2>
     </x-slot>

     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                          
                    <form action="{{ route('imprimirFactura')  }}" method="post" enctype="multipart/form-data" target="_blank">
                    @csrf
                    <div class="grid grid-cols-1 gap-1 justify-items-stretc">
                            <div class="justify-self-end">
                            <input type="hidden" name="fecha_servicio" id="fecha_servicio" value="{{$fecha_servicio}}">
                                <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                                <input type="text" name="fecha" id="fecha" wire:model='fecha' value="{{$fecha_servicio}}" placeholder="{{$fecha_servicio}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" disabled>
                            </div>
                    </div>

                <!--    <div class="grid grid-cols-1 gap-1 justify-items-stretc py-2">
                            <div class="justify-self-end">
                                <label for="recibo" class="block text-sm font-medium text-gray-700">N° Recibo</label>
                                <input type="text" name="recibo" id="recibo" wire:model='recibo' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" require>
                            </div>
                    </div>-->


                        <div class="grid grid-cols-4 gap-4">
                            
                            <div>
                                <label for="identificacion" class="block text-sm font-medium text-gray-700">Cédula o RIF</label>
                                <input type="text" name="identificacion" id="identificacion" wire:model='identificacion' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>       
                            </div>
                   
                            <div>
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mt-2  border border-blue-500 rounded" wire:click='Buscar()'>Buscar</button>
                            </div>
                        </div>
                        @if (session()->has('message'))
                        <div class="mt-2 py-2">
                            {{ session('message') }}
                            <div class="py-2">
                            <a href="/clientes/nuevo" class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 border border-green-500 rounded">Registrar Cliente</a>
                            </div>

                        </div>
                            @endif
                        
                        <div class="grid grid-cols-4 gap-4 py-2">
                            <div>
                                <input type="hidden" name="id_cliente" id="id_cliente" wire:model='id_cliente'>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre o Razón Social</label>
                                <input type="text" name="name" id="name" wire:model='name' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                            <div>
                                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                <input type="text" name="telefono" id="telefono"  wire:model='telefono' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-2 py-2">
                        <div>
                            <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                            <textarea type="text" name="direccion" id="direccion"  wire:model='direccion' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required></textarea>
                        </div>
                        </div>

                        <div class="py-2">
                            <label for="descripcion_equipo" class="block text-sm font-medium text-gray-700">Descripción del Equipo y Falla</label>
                            <textarea type="text" name="descripcion_equipo" id="descripcion_equipo"  wire:model='descripcion_equipo' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required></textarea>
                        </div>


                        <div class="grid grid-cols-4 gap-4 py-2">
                            <div>
                                <label for="monto_sin_iva" class="block text-sm font-medium text-gray-700">Monto</label>
                                <input type="text" name="monto_sin_iva" id="monto_sin_iva" wire:model="monto_sin_iva" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            
                                <div class="py-2">
                            <label for="id_iva" class="block text-sm font-medium text-gray-700">Iva</label>
                            <select wire:model="id_iva" name="id_iva" wire:click="change()" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                 <option value="">{{ __("Seleccione") }}</option>                     
                                 @foreach ($ivas as $iva)
                                 <option value="{{ $iva->id }}">{{ $iva->iva }}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="py-2">
                                <label for="monto_con_iva" class="block text-sm font-medium text-gray-700">Monto Total</label>
                                <input type="text" name="monto_con_iva" id="monto_con_iva" value="{{ $monto_con_iva }}"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>

                            <div class="py-2">
                                <label for="abono" class="block text-sm font-medium text-gray-700">Abono</label>
                                <input type="text" name="abono" id="abono"  wire:model="abono" wire:change="calculo()"  autocomplete="given-abono" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>
                            <div class="py-2">
                                <label for="monto_pendiente" class="block text-sm font-medium text-gray-700">Monto Pendiente</label>
                                <input type="text" name="monto_pendiente" id="monto_pendiente" wire:model="monto_pendiente" value="{{ $monto_pendiente }}"   autocomplete="given-monto_pendiente" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                            </div>
                        </div>


                        <div>
                            @if (session()->has('message'))
                        <div class="mt-2">
                            {{ session('message') }}
                        </div>
                            @endif
                         </div>
                        <!-- <x-jet-input-error for="fecha" class="mt-2" />-->

                        <div>
                        <input type="hidden" name="factura" id="factura" value="{{$factura}}">
                          <!--  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mt-2  border border-blue-500 rounded" wire:click='guardar'>Guardar</button>-->
                            @if($factura == true)
                           <!--    <a class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 mt-2  border border-red-500 rounded" href="/imprimirFacturaVenta">Imprimir Factura</a> -->
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mt-2  border border-blue-500 rounded" type="submit">Imprimir factura</button>
                            @else
                            <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 border border-green-500 rounded" type="submit">Imprimir Recibo</button>
                            @endif
                        </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>

</div>

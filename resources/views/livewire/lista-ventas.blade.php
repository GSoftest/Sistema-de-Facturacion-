<div>
     <!-- <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             {{ __('Lista de servicio técnico') }}
         </h2>
     </x-slot>-->
    
     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">




                <div class="grid grid-cols-1 gap-1  justify-items-stretc">
                    <div class="justify-self-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Listado de Ventas') }}
                    </h2>
                    </div>
                </div>

                
<div class="pt-8 pb-8 grid grid-cols-4 gap-4">
    <div class="py-4">
       <label for="desde">Desde:</label>
       <input type="date" name='desde' id="desde" wire:model='desde' max="{{$fecha}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
    </div>
    <div class="py-4">
       <label for="hasta">Hasta:</label>
       <input type="date" name='hasta' id="hasta" wire:model='hasta' max="{{$fecha}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
    </div>
    <div class="py-4">
        <div class="pt-5">
        <button type='button' wire:click='buscar()' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-2 mt-2  border border-blue-500 rounded w-10"><i class="fa fa-search fa-sm" aria-hidden="true"></i></button>
        </div>
    </div>
    <div class="py-4 flex justify-end pr-4">
        <div class="pt-5">
        <button type='button' wire:click='buscar' data-tooltip-target="tooltip-default" class="bg-white-500 hover:bg-white-700 text-white font-bold py-1.5 px-2 mt-2  border border-white-500 rounded w-10"><i class="fa fa-download fa-sm" aria-hidden="true" style="color: blue;"></i></button>
        <div id="tooltip-default" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
            Tooltip content
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        </div>
    </div>
</div>

                <table class="w-full border m:table-fixed">
                <thead class="border-b bg-gray-800">
                 <tr>
                    <th scope="col" class="text-sm font-medium text-white border-r">
                        Factura
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        RIF/CI
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        Nombre/Razón Social
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        Monto Total Bruto
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        Monto Total IVA
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        Monto Total Neto
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        Fecha de la Venta
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                         &nbsp;
                     </th>
                 </tr>
                </thead>
                <tbody>
                @foreach ($ventas as $venta)
                <tr class="border-b">
                    <td class="w-44 border-r text-gray-700 mr-3 text-center">
                    @foreach ($factura as $fac)
                    @if($fac->id_venta == $venta->id) 
                        {{$fac['lpad(numero_factura, 15, 0)']}}
                    @endif
                    @endforeach
                    </td>
                    <td class="w-44 border-r text-gray-700 mr-3 text-center">
                    @foreach ($cliente as $clien)
                    @if($clien->id == $venta->id_cliente) 
                        {{$clien->identificacion}}
                    @endif
                    @endforeach
                    </td>
                    <td class="w-44 border-r text-gray-700 mr-3 text-left">
                    @foreach ($cliente as $clien)
                    @if($clien->id == $venta->id_cliente) 
                        {{$clien->name}}
                    @endif
                    @endforeach
                    </td>
                    <td class="w-32 border-r appearance-none text-gray-700 mr-3 text-right">{{$venta->sub_total}}</td>
                    <td class="w-32 border-r appearance-none text-gray-700 mr-3 text-right">{{$venta->iva}}</td>
                    <td class="w-32 border-r appearance-none text-gray-700 mr-3 text-right">{{$venta->total}}</td>
                    <td class="w-28 border-r appearance-none text-gray-700 mr-3 text-center">
                        {{date('d/m/Y',strtotime($venta->fecha))}}
                    </td>
                    <td class="w-16 border-r text-center">
                    @foreach ($factura as $fac)
                    @if($fac->id_venta == $venta->id) 
                    <button class="py-2" type="button" wire:click="download('{{$fac->nombre_factura}}')"><i class="fa fa-download fa-sm" style="color: green;" aria-hidden="true"></i></button>
                    @endif
                    @endforeach
                </td>

                </tr>
                @endforeach
                </tbody>

                </table>    
                <div class="mt-4">
                        {{ $ventas->links() }}
               </div>


<x-jet-dialog-modal wire:model="negada">
    <x-slot name="title">
        <span class="flex justify-center">
        <i class="fa fa-exclamation-circle fa-3x" aria-hidden="true" style="color: #dac52d;"></i>
        </span>
    </x-slot>
    <x-slot name="content">
        <span class="flex justify-center">
          ¡Debe ingresar el rango de fecha para su busqueda!
        </span>
    </x-slot>
        
<x-slot name="footer">
<span class="flex justify-center pt-2">
        <div class="pb-3.5 pr-4">
        <x-button-advertencia class="mx-8"  wire:loading.attr="disabled" wire:click="cerrar">
            ok
        </x-button-advertencia>
        </div>
        </span>
</x-slot>
</x-jet-dialog-modal>

                </div>
            </div>
        </div>
    </div>
</div>

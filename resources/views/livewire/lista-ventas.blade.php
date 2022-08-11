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
       <label for="">Desde:</label>
       <input type="date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
    </div>
    <div class="py-4">
       <label for="">Hasta:</label>
       <input type="date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
    </div>
    <div class="py-4 grid grid-cols-2 gap-2 w-0.5">
        <div class="pt-5">
        <button type='button' wire:click='guardar' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-2 mt-2  border border-blue-500 rounded w-10"><i class="fa fa-search fa-sm" aria-hidden="true"></i></button>
        </div>
        <div class="pt-5">
        <button type='button' wire:click='guardar' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-2 mt-2  border border-blue-500 rounded w-10"><i class="fa fa-download fa-sm" aria-hidden="true"></i></button>
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
                    <td class="w-44 border-r text-gray-700 mr-3 text-center">
                    @foreach ($cliente as $clien)
                    @if($clien->id == $venta->id_cliente) 
                        {{$clien->name}}
                    @endif
                    @endforeach
                    </td>
                    <td class="w-32 border-r appearance-none text-gray-700 mr-3 text-center">{{$venta->sub_total}}</td>
                    <td class="w-32 border-r appearance-none text-gray-700 mr-3 text-center">{{$venta->iva}}</td>
                    <td class="w-32 border-r appearance-none text-gray-700 mr-3 text-center">{{$venta->total}}</td>
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

                </div>
            </div>
        </div>
    </div>
</div>

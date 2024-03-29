<div class="justify-center items-center">
    <!-- <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             {{ __('Lista de servicio técnico') }}
         </h2>
     </x-slot>-->

    <div class="mx-auto sm:px-6 lg:px-8 py-12 w-3/5">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">

                <div class="px-4 py-5 bg-white sm:p-6">

                <div class="grid grid-cols-1 gap-1  justify-items-stretc">
                    <div class="justify-self-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Listado de Servicio Técnico') }}
                    </h2>
                    </div>
                </div>

                <div class="pt-8 grid grid-cols-4 gap-4 justify-items-stretc">
                    <div class="py-4">
                    </div>
                </div>

                <table class="w-full border m:table-fixed">
                <thead class="border-b bg-gray-800">
                 <tr>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        Recibo
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        Fecha
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        Abono
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        Monto Pendiente
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                         &nbsp;
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                         &nbsp;
                     </th>
                 </tr>
             </thead>
             <tbody>
             @foreach ($servicios as $servicio)
             <tr class="border-b">
                <td class="w-44 border-r text-gray-700 mr-3 text-center">
                @foreach ($recibo as $rec)
                @if($rec->id == $servicio->id_recibo) 
                    {{$rec['lpad(recibo, 15, 0)']}}
                @endif
                @endforeach
                </td> 
                <td class="w-28 border-r appearance-none text-gray-700 mr-3 text-center">{{date('d/m/Y',strtotime($servicio->fecha))}}</td>
                <td class="w-32 border-r appearance-none text-gray-700 mr-3 text-center"> {{$servicio->abono}}</td>

              <td class="w-32 border-r appearance-none text-gray-700 mr-3 text-center">{{$servicio->monto_pendiente}}</td>
              <td class="w-16 border-r text-center">
                @foreach ($recibo as $rec)
                    @if($rec->id == $servicio->id_recibo) 
                    <button class="py-2" type="button" wire:click="download('{{$rec->pdf}}')" title='Descargar Recibo'><i class="fa fa-download fa-sm" style="color: green;" aria-hidden="true"></i></button>
                    @endif
                @endforeach
                </td>
                <td class="w-16 border-r text-center">
               <a class="py-2" href="{{ route('servicioTecnicoEditar', $servicio->id) }}" title='Editar'><i class="fa fa-pencil fa-sm" style="color: blue;" aria-hidden="true"></i></a>
                </td>
             </tr>
             @endforeach
             </tbody>

                </table>

                <div class="mt-4">
                        {{ $servicios->links() }}
               </div>

                </div>
            </div>
        </div>
    </div>

</div>

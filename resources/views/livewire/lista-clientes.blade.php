<div>
  <!--  <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>-->

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="shadow overflow-hidden sm:rounded-md">

        <div class="px-4 py-5 bg-white sm:p-6">

        <div class="grid grid-cols-1 gap-1  justify-items-stretc">
                            <div class="justify-self-center">
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ __('Clientes') }}
                                </h2>
                            </div>
                        </div>

 <div class="py-8 grid grid-cols-4 gap-4">
    <div class="py-4">
        <a class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 border border-green-500 rounded"
        href="/clientes/nuevo">Nuevo</a>
    </div>
</div>

            <table class="w-full border table-fixed">
             <thead class="border-b bg-gray-800">
             <tr>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        Nombre/Razón Social
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                         RIF/CI
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                         Teléfono
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                         Correo
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
             @foreach ($clientes as $cliente)
                     <tr class="border-b">
                         <td class="w-44 border-r text-gray-700 mr-3">
                             {{ $cliente->name }}</td>
                         <td class="w-32 border-r appearance-none text-gray-700 mr-3 text-center">
                            {{ $cliente->identificacion }}</td>
                         </td>
                         <td class="w-32 border-r appearance-none text-gray-700 mr-3 text-center">
                             {{ $cliente->telefono }}
                         </td>
                         <td class="w-32 border-r appearance-none text-gray-700 mr-3 text-center">
                             {{ $cliente->correo }}
                         </td>
                         <td class="w-24 border-r text-center">
                         <a class="py-2" href="/clientes/{{$cliente->id}}"><i class="fa fa-pencil fa-sm" style="color: blue;" aria-hidden="true"></i></a>
                        </td>
                         <td class="w-24 border-r text-center">
                            <button class="py-2"><i class="fa fa-trash-can fa-sm" style="color: red;" wire:click='destroy({{ $cliente->id }})'></i></button>
                         </td>
                     </tr>
                 @endforeach
             </tbody>
         </table>

         <div class="mt-4">
                        {{ $clientes->links() }}
               </div>

 
        </div>
        </div>
        </div>
    </div>
</div>

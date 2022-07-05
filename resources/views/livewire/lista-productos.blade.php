<div class="flex flex-col justify-center items-center">
   <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>-->

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="shadow overflow-hidden sm:rounded-md">

        <div class="px-4 py-5 bg-white sm:p-6">

        <div class="grid grid-cols-1 gap-1  justify-items-stretc">
                    <div class="justify-self-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Productos7') }}
                    </h2>
                    </div>
                </div>

                <div class="py-8 grid grid-cols-4 gap-4">
                    <div class="py-4">
                    <a class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 border border-green-500 rounded" href="/productos/nuevo">Nuevo</a>
                    </div>
                </div>

            <table class="text-center w-full">
             <thead class="border-b bg-gray-800">
             <tr>
                     <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                         Productos
                     </th>
                     <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                         Código
                     </th>
                     <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                         Precio sin Iva
                     </th>
                     <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                         Costo Unitario
                     </th>
                      <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                         Contenido Neto
                     </th>
                     <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                         &nbsp;
                     </th>
                 </tr>
             </thead class="border-b">
             <tbody>
             @foreach ($productos as $producto)
                     <tr class="bg-white border-b">
                         <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                             {{ $producto->name }}</td>
                         <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                             {{ $producto->upc }}
                         </td>
                         <td class="text-sm text-gray-900 font-light whitespace-nowrap">
                             {{ $producto->precio_sin_iva }}
                         </td>
                         <td class="text-sm text-gray-900 font-light whitespace-nowrap">
                             {{ $producto->costo_unitario }}
                         </td>
                         <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                             {{ $producto->contenido_neto }}
                         </td>
                         <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                         <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 border border-blue-500 rounded"
                            href="/productos/{{$producto->id}}">Editar</a>
                             <button
                                 class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 border border-red-500 rounded" wire:click='destroy({{ $producto->id }})'>Delete</button>
                         </td>
                     </tr class="bg-white border-b">
                 @endforeach
             </tbody>
         </table>

         <div class="mt-4">
                        {{ $productos->links() }}
               </div>


        </div>
        </div>
        </div>
    </div>
</div>

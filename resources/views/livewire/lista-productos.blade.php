<div>
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
                            {{ __('Productos') }}
                    </h2>
                    </div>
                </div>

                <div class="pt-8 grid grid-cols-4 gap-4 justify-items-stretc">
                    <div class="py-4">
                    <a class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 border border-green-500 rounded" href="/productos/nuevo">Nuevo</a>
                    </div>
                </div>

            <table class="w-full border">
             <thead class="border-b bg-gray-800">
             <tr>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                         Productos
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                         Código
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                         Precio sin IVA
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                         Costo Unitario
                     </th>
                      <th scope="col" class="text-sm font-medium text-white border-r">
                         Contenido Neto
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
             @foreach ($productos as $producto)
                     <tr class="border-b">
                         <td class="w-44 border-r text-gray-700 mr-3">
                             {{ $producto->name }}</td>
                         <td class="w-32 border-r appearance-none text-gray-700 mr-3 text-center">
                             {{ $producto->upc }}
                         </td>
                         <td class="w-28 border-r appearance-none text-gray-700 mr-3 text-center">
                             {{ $producto->precio_sin_iva }}
                         </td>
                         <td class="w-28 border-r appearance-none text-gray-700 mr-3 text-center">
                             {{ $producto->costo_unitario }}
                         </td>
                         <td class="w-28 border-r appearance-none text-gray-700 mr-3 text-center">
                             {{ $producto->contenido_neto }}
                         </td>
                         <td class="w-24 border-r px-8 py-4">
                         <a class="py-2"
                            href="/productos/{{$producto->id}}"><i class="fa fa-pencil fa-sm" style="color: blue;" aria-hidden="true"></i></a>
                         </td>
                         <td class="w-24 border-r px-8 py-4">
                             <button class="py-2"><i class="fa fa-trash-can fa-sm" style="color: red;" wire:click='destroy({{ $producto->id }})'></i></button>
                         </td>
                     </tr>
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

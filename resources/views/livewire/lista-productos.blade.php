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
                    <a class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 border border-green-500 rounded w-20" href="{{ route('productosN') }}">Nuevo</a>
                    </div>
                </div>

            <table class="w-full border m:table-fixed">
             <thead class="border-b bg-gray-800">
             <tr>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                         Código
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        Productos
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        Unidad Disponible
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                         Costo Unitario
                     </th>
                      <th scope="col" class="text-sm font-medium text-white border-r">
                         Contenido Neto
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        Precio sin IVA
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
                         <td class="w-32 border-r text-gray-700 mr-3 text-center">
                             {{ $producto->upc }}</td>
                         <td class="w-44 border-r appearance-none text-gray-700 mr-3 text-center">
                             {{ $producto->name }}
                         </td>
                         <td class="w-28 border-r appearance-none text-gray-700 mr-3 text-center">
                             {{ $producto->unidad }}
                         </td>
                         <td class="w-28 border-r appearance-none text-gray-700 mr-3 text-center">
                             {{str_replace(".",",",str_replace(",","",number_format($producto->costo_unitario, 2 )))}}
                         </td>
                         <td class="w-28 border-r appearance-none text-gray-700 mr-3 text-center">
                             {{ $producto->contenido_neto }} 
                             @foreach ($medidas as $medida)
                               @if($producto->id_medida==$medida->id) 
                               {{ $medida->unidad }}
                               @endif
                             @endforeach
                         </td>
                         <td class="w-28 border-r appearance-none text-gray-700 mr-3 text-center">
                         {{str_replace(".",",",str_replace(",","",number_format($producto->precio_sin_iva, 2 )))}}
                         </td>
                         <td class="w-16 border-r text-center">
                         <a class="py-2"
                            href="/productos/{{$producto->id}}"><i class="fa fa-pencil fa-sm" style="color: blue;" aria-hidden="true"></i></a>
                         </td>
                         <td class="w-16 border-r text-center">
                             <button class="py-2"><i class="fa fa-trash-can fa-sm" style="color: red;" wire:click='destroy({{ $producto->id }})'></i></button>
                         </td>
                     </tr>
                 @endforeach
             </tbody>
         </table>

         <div class="mt-4">
                        {{ $productos->links() }}
               </div>

<x-jet-dialog-modal wire:model="confirmingUserDeletion">
    <x-slot name="title">
        <span class="flex justify-center">
        <i class="fa fa-exclamation-circle fa-3x" aria-hidden="true" style="color: red;"></i>
        </span>
    </x-slot>
    <x-slot name="content">
        <span class="flex justify-center">
        ¿Está seguro que desea eliminar?
        </span>
    </x-slot>
        
<x-slot name="footer">
<span class="flex justify-center pt-2">
        <div class="pb-3.5 pr-4">
        <x-jet-secondary-button class="mx-8"  wire:loading.attr="disabled" wire:click="cerrar">
            No
        </x-jet-secondary-button>
        </div>
        <div class="">
        <x-jet-danger-button class="mx-12" wire:click="destroy2" wire:loading.attr="disabled">
            Sí
            </x-jet-danger-button>
        </div>
        </span>
</x-slot>
</x-jet-dialog-modal>

        </div>
        </div>
        </div>
    </div>
</div>

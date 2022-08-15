<div class="justify-center items-center">
   <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categorias') }}
        </h2>
    </x-slot>-->

    <div class="mx-auto sm:px-6 lg:px-8 py-12 w-3/5">
        <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="shadow overflow-hidden sm:rounded-md">

        <div class="px-4 py-5 bg-white sm:p-6">

        <div class="grid grid-cols-1 gap-1  justify-items-stretc">
                    <div class="justify-self-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Categorías') }}
                    </h2>
                    </div>
                </div>

<div class="py-8 grid grid-cols-1 gap-4">
    <div class="py-4">
        <a class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 border border-green-500 rounded w-20"
         href="{{ route('categoriasaNuevo') }}" >Nuevo</a>
    </div>
</div>


            <table class="w-full border m:table-fixed">
             <thead class="border-b bg-gray-800">
                 <tr>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                         Nombre
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                         Descripción
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
                 @foreach ($items as $item)
                     <tr class="border-b">
                         <td class="w-44 border-r text-gray-700 mr-3">
                         {{ $item->name }}</td>
                         <td class="w-64 border-r text-gray-700 mr-3">
                         {{ $item->descripcion }}</td>
                         <td class="w-20 border-r text-center">
                         <a class="py-2" href="/categorias/{{$item->id}}" title='Editar' ><i class="fa fa-pencil fa-sm" style="color: blue;" aria-hidden="true"></i></a>
                        </td>
                         <td class="w-20 border-r text-center">
                         <button class="py-2" title='Eliminar'><i class="fa fa-trash-can fa-sm" style="color: red;" wire:click='destroy({{ $item->id }})'></i></button>
                         </td>
                     </tr>
                 @endforeach
             </tbody>
         </table>

         <div class="mt-4">
                        {{ $items->links() }}
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

<div class="flex flex-col justify-center items-center">
   <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categorias') }}
        </h2>
    </x-slot>-->

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
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

        <a class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 border border-green-500 rounded"
        href="/categorias/nuevo">Nuevo</a>

    <x-table>
            <table class="text-center">
             <thead class="border-b bg-gray-800">
                 <tr>
                     <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                         Nombre
                     </th>
                     <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                         Imagen
                     </th>
                     <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                         &nbsp;
                     </th>
                 </tr>
             </thead class="border-b">
             <tbody>
                 @foreach ($items as $item)
                     <tr class="bg-white border-b">
                         <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                         {{ $item->name }}</td>
                         <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            <img src="{{URL::asset('app/archivos/categorias/'.$item->imagen)}}"  class="flex-shrink-0 w-10">
                         </td>
                         <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                         <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 border border-blue-500 rounded"
                            href="/categorias/{{$item->id}}">Editar</a>
                         <button
                                 class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 border border-red-500 rounded" wire:click='destroy({{ $item->id }})'>Eliminar</button>
                         </td>
                     </tr class="bg-white border-b">
                 @endforeach
             </tbody>
         </table>

         <div class="mt-4">
                        {{ $items->links() }}
               </div>

     </x-table>
        </div>
        </div>
        </div>
    </div>
</div>

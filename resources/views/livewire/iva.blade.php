 <div class="flex flex-col justify-center items-center">
    <!-- <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             {{ __('Tipos de Iva') }}
         </h2>
     </x-slot>-->

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">

 <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="shadow overflow-hidden sm:rounded-md">
                 <div class="px-4 py-5 bg-white sm:p-6">

                 <div class="grid grid-cols-1 gap-1  justify-items-stretc">
                    <div class="justify-self-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Registro de IVA') }}
                    </h2>
                    </div>
                </div>

                     <div class="py-8 grid grid-cols-4 gap-4">
                   <!--  <div class="col-span-3 sm:col-span-3">-->
                        <div>
                            <label for="iva" class="block text-sm font-medium text-gray-700">IVA</label>
                            <input type="text" name="iva" id="iva" wire:model='iva' autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                         
                            @if (session()->has('message'))
                            <p class="text-sm text-red-600">{{ session('message') }}</p>
                            @endif
                            <x-jet-input-error for="iva"/>
                        </div>
                   
                         <div class="py-4">
                         <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mt-2  border border-blue-500 rounded" wire:click='guardar'>Guardar</button>
                         </div>
                         <!--   </div>-->
                     </div>
 

     <x-table>
         <table class="text-center w-2/3">
             <thead class="border-b bg-gray-800">
                 <tr>
                     <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                         IVA
                     </th>
                     <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                         &nbsp;
                     </th>
                     <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                         &nbsp;
                     </th>
                     <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                         &nbsp;
                     </th>
                 </tr>
             </thead class="border-b">
             <tbody>
                 @foreach ($ivas as $iva)
                     <tr class="bg-white border-b">
                         <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                             {{ $iva->iva }}
                         </td>
                         <td class="w-24 text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                             <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 border border-green-500 rounded" wire:click='activar({{ $iva->id }})'>Activar</button>
                         </td>
                         <td class="w-24 text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                             <button
                                 class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 border border-blue-500 rounded" wire:click='edit({{ $iva->id }})'>Editar</button>
                         </td>
                         <td class="w-24 text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                             <button
                                 class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 border border-red-500 rounded" wire:click='destroy({{ $iva->id }})'>Eliminar</button>
                         </td>
                     </tr class="bg-white border-b">
                 @endforeach
             </tbody>
         </table>
     
         <div class="mt-4">
                        {{ $ivas->links() }}
               </div>
     </x-table>
     </div>
        </div>
 </div>
 </div>
 </div>

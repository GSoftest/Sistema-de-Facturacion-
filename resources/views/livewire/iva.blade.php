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

                     <div class="pt-8 grid grid-cols-2 gap-4">
                   <!--  <div class="col-span-3 sm:col-span-3">-->
                        <div>
                            <label for="iva" class="block text-sm font-medium text-gray-700">IVA</label>
                            <input type="text" name="iva" id="iva" wire:model='iva' autocomplete="given-name" maxlength="5" placeholder="0,00" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                   
                         <div class="py-4">
                         <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mt-2  border border-blue-500 rounded w-20" wire:click='guardar'>Guardar</button>
                         </div>
                         <!--   </div>-->
                     </div>
                     <div class="py-4">
                     @if (session()->has('message'))
                            <p class="text-sm text-red-600">{{ session('message') }}</p>
                            @endif
                            <x-jet-input-error for="iva"/>
                    </div>  
  
         <table class="w-full border">
             <thead class="border-b bg-gray-800">
                 <tr>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                         IVA
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                         &nbsp;
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
                 @foreach ($ivas as $iva)
                     <tr class="border-b">
                         <td class="border-r text-gray-700 mr-3 text-center">
                             {{str_replace(".",",",number_format($iva->iva, 2 )) }}
                         </td>
                         <td class="w-24 border-r text-center">
                            <input type="hidden" wire:model='estado' name="estado">
                            @if ($iva->estado == 0)

                             <button class="py-2"><i class="fa fa-toggle-off fa-sm" style="color: red;" aria-hidden="true" wire:click='activar({{ $iva->id }})'></i></button>
                            @else
                            <button class="py-2"><i class="fa fa-toggle-on fa-sm" style="color: green;" aria-hidden="true" wire:click='desactivar({{ $iva->id }})'></i></button>
                            @endif
                        </td>
                         <td class="w-24 border-r text-center">
                             <button class="py-2"><i class="fa fa-pencil fa-sm" style="color: blue;" aria-hidden="true" wire:click='edit({{ $iva->id }})'></i></button>
                         </td>
                         <td class="w-24 border-r text-center">
                             <button class="py-2"><i class="fa fa-trash-can fa-sm" style="color: red;" wire:click='destroy({{ $iva->id }})'></i></button>
                         </td>
                     </tr>
                 @endforeach
             </tbody>
         </table>
     
         <div class="mt-4">
                        {{ $ivas->links() }}
               </div>

     </div>
        </div>
 </div>
 </div>
 </div>

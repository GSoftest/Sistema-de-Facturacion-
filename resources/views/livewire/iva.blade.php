<div>
@if (Session::has('notificacion'))
<x-notificacion on="{{ session('notificacion') }}"></x-notificacion>
@endif

@if (Session::has('advertencia'))
<x-advertencia on="{{ session('advertencia') }}"></x-advertencia>
@endif
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
                            <label for="iva" class="block text-sm font-medium text-gray-700">IVA *</label>
                            <input type="text" name="iva" id="iva" wire:model='iva' autocomplete="given-name" maxlength="5" onkeydown="ocultarError('ocultariva')" placeholder="0,00" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                   
                         <div class="py-4">
                         <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mt-2  border border-blue-500 rounded w-20" wire:click='guardar'>Guardar</button>
                         </div>
                         <!--   </div>-->
                     </div>
                     <div class="py-4">
                        <x-jet-input-error for="iva" id='ocultariva'/>
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

                             <button class="py-2" title='Activar' ><i class="fa fa-toggle-off fa-sm" style="color: red;" aria-hidden="true" wire:click='activar2({{ $iva->id }})'></i></button>
                            @else
                            <button class="py-2" title='Desactivar'><i class="fa fa-toggle-on fa-sm" style="color: green;" aria-hidden="true" wire:click='desactivar2({{ $iva->id }})'></i></button>
                            @endif
                        </td>
                         <td class="w-24 border-r text-center">
                             <button class="py-2" title='Editar'><i class="fa fa-pencil fa-sm" style="color: blue;" aria-hidden="true" wire:click='edit({{ $iva->id }})'></i></button>
                         </td>
                         <td class="w-24 border-r text-center">
                             <button class="py-2" title='Eliminar'><i class="fa fa-trash-can fa-sm" style="color: red;" wire:click='destroy({{ $iva->id }})'></i></button>
                         </td>
                     </tr>
                 @endforeach
             </tbody>
         </table>
     
        <div class="mt-4">
            {{ $ivas->links() }}
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
        <x-jet-secondary-button  wire:loading.attr="disabled" wire:click="cerrar">
            No
        </x-jet-secondary-button>
        </div>
        <div class="">
        <x-jet-danger-button  wire:click="destroy2" wire:loading.attr="disabled">
            Sí
            </x-jet-danger-button>
        </div>
        </span>
</x-slot>

</x-jet-dialog-modal>

<x-jet-dialog-modal wire:model="confirmingActivar">
    <x-slot name="title">
        <span class="flex justify-center">
        <i class="fa fa-exclamation-circle fa-3x" aria-hidden="true" style="color: red;"></i>
        </span>
    </x-slot>
    <x-slot name="content">
        <span class="flex justify-center">
        ¿Está seguro que desea activarlo?
        </span>
    </x-slot>
        
<x-slot name="footer">
<span class="flex justify-center pt-2">
        <div class="pb-3.5 pr-4">
        <x-jet-secondary-button  wire:loading.attr="disabled" wire:click="cerrar">
            No
        </x-jet-secondary-button>
        </div>
        <div class="">
        <x-jet-danger-button  wire:click="activar" wire:loading.attr="disabled">
            Sí
            </x-jet-danger-button>
        </div>
        </span>
</x-slot>
</x-jet-dialog-modal>

<x-jet-dialog-modal wire:model="confirmingDesactivar">
    <x-slot name="title">
        <span class="flex justify-center">
        <i class="fa fa-exclamation-circle fa-3x" aria-hidden="true" style="color: red;"></i>
        </span>
    </x-slot>
    <x-slot name="content">
        <span class="flex justify-center">
        ¿Está seguro que desea desactivar?
        </span>
    </x-slot>
        
<x-slot name="footer">
<span class="flex justify-center pt-2">
        <div class="pb-3.5 pr-4">
        <x-jet-secondary-button  wire:loading.attr="disabled" wire:click="cerrar">
            No
        </x-jet-secondary-button>
        </div>
        <div class="">
        <x-jet-danger-button  wire:click="desactivar" wire:loading.attr="disabled">
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
 </div>

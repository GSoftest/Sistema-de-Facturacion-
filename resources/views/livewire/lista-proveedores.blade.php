<div>
@if (Session::has('message'))
<x-notificacion on="{{ session('message') }}"></x-notificacion>
@endif

@if (Session::has('message2'))
<x-advertencia on="{{ session('message2') }}"></x-advertencia>
@endif

<div class="justify-center items-center">
  <!--  <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>-->

    <div class="mx-auto sm:px-6 lg:px-8 py-12 w-3/5">
        <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
            <div class="grid grid-cols-1 gap-1  justify-items-stretc">
                <div class="justify-self-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Proveedores') }}
                    </h2>
                </div>
            </div>
        <div class="py-8 grid grid-cols-4 gap-4">
            <div class="py-4">
                <a class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 border border-green-500 rounded w-20"
                href="/proveedores/nuevo">Nuevo</a>
            </div>
        </div>





        <table class="w-full border m:table-fixed">
             <thead class="border-b bg-gray-800">
             <tr>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        Nombre
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
             @foreach ($proveedores as $proveedor)
             <tr class="border-b">
                <td class="w-44 border-r appearance-none text-gray-700 mr-3 text-center">
                    {{ $proveedor->name }}
                </td>
                <td class="w-32 border-r appearance-none text-gray-700 mr-3 text-center">
                    {{ $proveedor->phone_number }}
                </td>
                <td class="w-44 border-r appearance-none text-gray-700 mr-3 text-center">
                    {{ $proveedor->email }}
                </td>
                <td class="w-24 border-r text-center">
                    <a class="py-2" href="/proveedores/{{$proveedor->id}}" title='Editar'><i class="fa fa-pencil fa-sm" style="color: blue;" aria-hidden="true"></i></a>
                </td>
                <td class="w-24 border-r text-center">
                    @if ($proveedor->status == 0)
                        <button class="py-2"><i class="fa fa-toggle-off fa-sm" style="color: red;" aria-hidden="true" wire:click='activar({{ $proveedor->id }})' title='Activar'></i></button>
                    @else
                        <button class="py-2"><i class="fa fa-toggle-on fa-sm" style="color: green;" aria-hidden="true" wire:click='desactivar({{ $proveedor->id }})' title='Desactivar'></i></button>
                    @endif
                </td>

             </tr>
             @endforeach
             </tbody>
         </table>

         <div class="mt-4">
                        {{ $proveedores->links() }}
               </div>

<x-jet-dialog-modal wire:model="confirmingActivar">
    <x-slot name="title">
        <span class="flex justify-center">
        <i class="fa fa-exclamation-circle fa-3x" aria-hidden="true" style="color: red;"></i>
        </span>
    </x-slot>
    <x-slot name="content">
        <span class="flex justify-center">
        ¿Está seguro que desea activar el proveedor?
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
        <x-jet-danger-button  wire:click="activar2" wire:loading.attr="disabled">
            Sí
            </x-jet-danger-button>
        </div>
        </span>
</x-slot>
</x-jet-dialog-modal>

<x-jet-dialog-modal wire:model="confirmingUserDeletion">
    <x-slot name="title">
        <span class="flex justify-center">
        <i class="fa fa-exclamation-circle fa-3x" aria-hidden="true" style="color: red;"></i>
        </span>
    </x-slot>
    <x-slot name="content">
        <span class="flex justify-center">
        ¿Está seguro que desea desactivar el proveedor?
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
        <x-jet-danger-button  wire:click="desactivar2" wire:loading.attr="disabled">
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

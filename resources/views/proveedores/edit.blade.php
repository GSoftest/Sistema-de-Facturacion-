<x-app-layout>
   <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modificar cliente') }}
        </h2>
    </x-slot>-->
    <div class="flex flex-col justify-center items-center">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <form action="{{ route('editarproveedores')  }}" method="post" enctype="multipart/form-data">
                    @csrf 
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-1 gap-1  justify-items-stretc">
                            <div class="justify-self-center">
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ __('Actualizar Proveedor') }}
                                </h2>
                            </div>
                        </div>

                        <div class="pt-8 py-2 grid grid-cols-2 gap-4 justify-items-stretc">
                        <input type="hidden" name="id" id="id" value="{{$data->id}}">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre *</label>
                                <input type="text" name="name" id="name" wire:model='name' value="{{$data->name}}"  autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="name"/>
                            </div>
                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-700">Teléfono *</label>
                                <input type="text" name="phone_number" id="phone_number" wire:model='phone_number' maxlength="12" value="{{$data->phone_number}}" placeholder="0xxx-xxxxxxx"  autocomplete="given-phone_number" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"> 
                                <x-jet-input-error for="phone_number"/>
                            </div>
                        </div>

                        <div class="py-2 grid grid-cols-2 gap-4 justify-items-stretc">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Correo *</label>
                                <input type="text" name="email" id="email" wire:model='email' value="{{$data->email}}"  autocomplete="given-email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"> 
                                <x-jet-input-error for="email"/>
                            </div>
                        </div>


                        <div class="flex justify-center py-2 font-light px-6 py-4 whitespace-nowrap">
                            <div class="pb-3.5 pr-4">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-2 mt-2 border border-blue-500 rounded py-1.5 w-20" type="submit">Guardar</button>
                            </div>
                            <div class="">
                            <a class="bg-red-500 hover:bg-red-700 text-white font-bold px-2 mt-2 border border-red-500 rounded py-1.5 w-20" href="{{ route('proveedores') }}" type="button" >Cancelar</a>
                            </div>
                        </div>


                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
   <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar producto') }}
        </h2>
    </x-slot>-->
    <div>
        

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
            
                    <form action="{{ route('nuevoproductos')  }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="px-4 py-5 bg-white sm:p-6">

                    <div class="grid grid-cols-1 gap-1  justify-items-stretc">
                            <div class="justify-self-center">
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ __('Registro de Producto') }}
                                </h2>
                            </div>
                        </div>


                        <div class="grid grid-cols-4 gap-4 pt-8">
                            <div class="py-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                <input type="text" name="name" id="name" wire:model='name' autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="name"/>
                            </div>
                            <div class="py-2">
                                <label for="peso" class="block text-sm font-medium text-gray-700">Peso</label>
                                <input type="text" name="peso" id="peso" wire:model='peso' autocomplete="given-peso" value='0' placeholder="0" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="peso"/>
                            </div>
                            <div class="py-2">
                                <label for="altura" class="block text-sm font-medium text-gray-700">Altura</label>
                                <input type="text" name="altura" id="altura" wire:model='altura' autocomplete="given-altura" value='0' placeholder="0" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="altura"/>
                            </div>
                            
                            <div class="py-2">
                                <label for="ancho" class="block text-sm font-medium text-gray-700">Ancho</label>
                                <input type="text" name="ancho" id="ancho" wire:model='ancho' autocomplete="given-ancho" value='0' placeholder="0" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="ancho"/>
                            </div>
                            </div>

                            <div class="grid grid-cols-4 gap-4">
                            <div class="py-2">
                                <label for="longitud" class="block text-sm font-medium text-gray-700">Longitud</label>
                                <input type="text" name="longitud" id="longitud" wire:model='longitud' autocomplete="given-longitud" placeholder="0" value='0' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="longitud"/>
                            </div>
                            <div class="py-2">
                                <label for="upc" class="block text-sm font-medium text-gray-700">UPC</label>
                                <input type="text" name="upc" id="upc" wire:model='upc' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="upc"/>
                            </div>
                            <div class="py-2">
                                <label for="precio_sin_iva" class="block text-sm font-medium text-gray-700">Precio sin IVA</label>
                                <input type="text" name="precio_sin_iva" id="precio_sin_iva" wire:model='precio_sin_iva' autocomplete="given-precio_sin_iva" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="precio_sin_iva"/>
                            </div>
                            <div class="py-2">
                                <label for="costo_unitario" class="block text-sm font-medium text-gray-700">Costo unitario</label>
                                <input type="text" name="costo_unitario" id="costo_unitario" wire:model='costo_unitario' autocomplete="given-costo_unitario" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="costo_unitario"/>
                            </div>
                            </div>

                            <div class="grid grid-cols-4 gap-4">
                            <div class="py-2">
                                <label for="contenido_neto" class="block text-sm font-medium text-gray-700">Contenido neto</label>
                                <input type="text" name="contenido_neto" id="contenido_neto" wire:model='contenido_neto' autocomplete="given-contenido_neto" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="contenido_neto"/>
                            </div>
                            <div class="py-2">
                                <label for="unidad" class="block text-sm font-medium text-gray-700">Unidad disponible</label>
                                <input type="text" name="unidad" id="unidad" wire:model='unidad' autocomplete="given-unidad" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="unidad"/>
                            </div>


                            <div class="py-2">
                            <label for="id_categoria" class="block text-sm font-medium text-gray-700">Categorías</label>
                            <select wire:model="id_categoria" name="id_categoria" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>  
                                <option value="">{{ __("Seleccione") }}</option>                   
                                 @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                    
                                    @endforeach
                            </select>
                            <x-jet-input-error for="id_categoria"/>
                        </div>


                            <div class="py-2">
                                <label for="exento" class="block text-sm font-medium text-gray-700">Exento de IVA</label>
                                <div class="py-2 justify-center">
                                <input type="radio" name="exento" wire:model='exento' value="1"> Si
                                <input type="radio" name="exento" wire:model='exento'value="0"> No
                                </div>
                                <x-jet-input-error for="exento"/>
                            </div>
                        

                            </div>

                            <div class="grid grid-cols-4 gap-4 justify-items-stretc">

                            <div class="py-2">
                            <div class="col-span-3 sm:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 py-2">Imagen del producto</label>
                            <input type="file" name="imagen_url" accept="image/*">
                            <x-jet-input-error for="imagen_url"/>
                            </div>
                            </div>

                            </div>
                            
                            <div class="py-2 ">
                            <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea type="text" name="description" id="description" wire:model='description' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full h-32 shadow-sm sm:text-sm border-gray-300 resize-y rounded-md"></textarea>
                            <x-jet-input-error for="description"/>
                        </div>

                         
                            <div class="flex justify-center py-2 font-light px-6 py-4 whitespace-nowrap">
                            <div class="pb-3.5 pr-4">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mt-2 border border-blue-500 rounded" type="submit">Guardar&nbsp;</button>
                            </div>
                            <div class="pt-3.5">
                                <a href="/productos" class="bg-red-500 hover:bg-red-700 text-white font-bold px-2 mt-2 border border-red-500 rounded py-1.5">Cancelar</a>
                            </div>
                        </div> 



                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
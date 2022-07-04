<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modificar producto') }}
        </h2>
    </x-slot>
    <div>
        

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
            
                    <form action="{{ route('editarproductos')  }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{$producto->id}}">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-4 gap-4">
                            <div class="py-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                <input type="text" name="name" id="name" wire:model='name' value="{{$producto->name}}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="py-2">
                                <label for="peso" class="block text-sm font-medium text-gray-700">Peso</label>
                                <input type="text" name="peso" id="peso" wire:model='peso' value="{{$producto->peso}}" autocomplete="given-peso" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="py-2">
                                <label for="altura" class="block text-sm font-medium text-gray-700">Altura</label>
                                <input type="text" name="altura" id="altura" wire:model='altura' value="{{$producto->altura}}" autocomplete="given-altura" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                            
                            <div class="py-2">
                                <label for="ancho" class="block text-sm font-medium text-gray-700">Ancho</label>
                                <input type="text" name="ancho" id="ancho" wire:model='ancho' value="{{$producto->ancho}}" autocomplete="given-ancho" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            </div>

                            <div class="grid grid-cols-4 gap-4">
                            <div class="py-2">
                                <label for="longitud" class="block text-sm font-medium text-gray-700">Longitud</label>
                                <input type="text" name="longitud" id="longitud" wire:model='longitud' value="{{$producto->longitud}}" autocomplete="given-longitud" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="py-2">
                                <label for="upc" class="block text-sm font-medium text-gray-700">UPC</label>
                                <input type="text" name="upc" id="upc" wire:model='upc' value="{{$producto->upc}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="py-2">
                                <label for="precio_sin_iva" class="block text-sm font-medium text-gray-700">Precio sin iva</label>
                                <input type="text" name="precio_sin_iva" id="precio_sin_iva" wire:model='precio_sin_iva' value="{{$producto->precio_sin_iva}}" autocomplete="given-precio_sin_iva" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="py-2">
                                <label for="costo_unitario" class="block text-sm font-medium text-gray-700">Costo unitario</label>
                                <input type="text" name="costo_unitario" id="costo_unitario" wire:model='costo_unitario' value="{{$producto->costo_unitario}}" autocomplete="given-costo_unitario" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            </div>

                            <div class="grid grid-cols-4 gap-4">
                            <div class="py-2">
                                <label for="contenido_neto" class="block text-sm font-medium text-gray-700">Contenido neto</label>
                                <input type="text" name="contenido_neto" id="contenido_neto" wire:model='contenido_neto' value="{{$producto->contenido_neto}}" autocomplete="given-contenido_neto" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="py-2">
                                <label for="unidad" class="block text-sm font-medium text-gray-700">Unidad</label>
                                <input type="text" name="unidad" id="unidad" wire:model='unidad' autocomplete="given-unidad" value="{{$producto->unidad}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            </div>


                            <div class="py-2">
                            <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea type="text" name="description" id="description" wire:model='description' value="{{$producto->description}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{$producto->description}}</textarea>
                            </div>

                            <div class="py-2">
                                <label for="exento" class="block text-sm font-medium text-gray-700">Exento de iva</label>
                                <input type="radio" name="exento" wire:model='exento' class="" value="1" @if($producto->exento=="1") checked @endif> Si
                                <input type="radio" name="exento" wire:model='exento' class="" value="0" @if($producto->exento=="0") checked @endif> No
                            </div>

                            <div class="grid grid-cols-4 gap-4">
                          
                            <div class="py-2">
                            <label for="id_categoria" class="block text-sm font-medium text-gray-700">Categorías</label>
                            <select wire:model="id_categoria" name="id_categoria" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                 <option value="">{{ __("Seleccione") }}</option>                     
                                 @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" @if($producto->id_categoria==$categoria->id) selected @endif>{{ $categoria->name }}</option>
                                @endforeach
                            </select>
                            </div>
                            </div>
                            
                            <div class="py-2">
                            <div class="col-span-3 sm:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 py-2">Imagen del producto</label>
                            <img src="{{ URL::asset('app/archivos/productos/'.$producto->imagen_url) }}" class="flex-shrink-0 w-28"/>
                            <input type="file" name="imagen_url" accept="image/*">
                            </div>
                            </div>

                        <div class="py-2">
                            <div class="col-span-3 sm:col-span-3">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mt-2  border border-blue-500 rounded" type="submit">Guardar</button>
                            <a href="/productos" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 mt-2  border border-red-500 rounded">Cancelar</a>
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
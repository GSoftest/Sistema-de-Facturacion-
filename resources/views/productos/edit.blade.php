<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modificar producto') }}
        </h2>
    </x-slot>-->
    <div class="flex flex-col justify-center items-center">
        

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
            
                    <form action="{{ route('editarproductos')  }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{$producto->id}}">
                    <div class="px-4 py-5 bg-white sm:p-6">

                    <div class="grid grid-cols-1 gap-1  justify-items-stretc">
                            <div class="justify-self-center">
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ __('Actualizar Producto') }}
                                </h2>
                            </div>
                        </div>

                    <div class="grid grid-cols-2 gap-4 pt-8">
                        <div class="py-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="name" id="name" wire:model='name' value="{{$producto->name}}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="name"/>
                        </div>
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div>
                                <label for="upc" class="block text-sm font-medium text-gray-700">UPC</label>
                                <input type="text" name="upc" id="upc" wire:model='upc' value="{{$producto->upc}}" placeholder="000000000000" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="upc"/>
                            </div>
                            <div>
                                <label for="id_categoria" class="block text-sm font-medium text-gray-700">Categorías</label>
                                <select wire:model="id_categoria" name="id_categoria" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                 <option value="">{{ __("Seleccione") }}</option>                     
                                 @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" @if($producto->id_categoria==$categoria->id) selected @endif>{{ $categoria->name }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="id_categoria"/>
                            </div>
                        </div>
                    </div>


                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div>
                            <label for="contenido_neto" class="block text-sm font-medium text-gray-700">Contenido neto</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="text" name="contenido_neto" id="contenido_neto" wire:model='contenido_neto' value="{{$producto->contenido_neto}}" autocomplete="given-contenido_neto" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <div class="absolute inset-y-0 right-0 flex items-center">
                                    <label for="medida" class="sr-only">Medida</label>
                                    <select wire:model="medida" name="medida" class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">             
                                        @foreach ($medidas as $medida)
                                        <option value="{{ $medida->id }}" @if($producto->id_medida==$medida->id) selected @endif>{{ $medida->unidad }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <x-jet-input-error for="contenido_neto"/>
                            </div>
                            <div>
                                <label for="altura" class="block text-sm font-medium text-gray-700">Altura</label>
                                <input type="text" name="altura" id="altura" wire:model='altura' value="{{$producto->altura}}" placeholder="0" autocomplete="given-altura" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="altura"/>
                            </div>
                        </div>
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div>
                                <label for="ancho" class="block text-sm font-medium text-gray-700">Ancho</label>
                                <input type="text" name="ancho" id="ancho" wire:model='ancho' value="{{$producto->ancho}}" placeholder="0" autocomplete="given-ancho" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="ancho"/>
                            </div>
                            <div>
                            <label for="unidad" class="block text-sm font-medium text-gray-700">Unidad disponible</label>
                            <input type="text" name="unidad" id="unidad" wire:model='unidad' autocomplete="given-unidad" value="{{$producto->unidad}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="unidad"/>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div>
                                <label for="precio_sin_iva" class="block text-sm font-medium text-gray-700">Precio sin IVA</label>
                                <input type="text" name="precio_sin_iva" id="precio_sin_iva" wire:model='precio_sin_iva' placeholder="0,00" value="{{$producto->precio_sin_iva}}" autocomplete="given-precio_sin_iva" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="precio_sin_iva"/>
                            </div>
                            <div>
                                <label for="costo_unitario" class="block text-sm font-medium text-gray-700">Costo unitario</label>
                                <input type="text" name="costo_unitario" id="costo_unitario" wire:model='costo_unitario' placeholder="0,00" value="{{$producto->costo_unitario}}" autocomplete="given-costo_unitario" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="costo_unitario"/>
                            </div>
                        </div>
                        <div>
                            <label for="exento" class="block text-sm font-medium text-gray-700">Exento de IVA</label>
                            <div class="py-2 justify-center">
                                <input type="radio" name="exento" wire:model='exento' class="" value="1" @if($producto->exento=="1") checked @endif> Si
                                <input type="radio" name="exento" wire:model='exento' class="" value="0" @if($producto->exento=="0") checked @endif> No
                                </div>
                                <x-jet-input-error for="exento"/>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <div class="py-2">
                        <label class="block text-sm font-medium text-gray-700 py-2">Imagen del producto</label>
                        <input type="file" name="imagen_url" accept="image/*">
                                    @if(isset($producto->imagen_url))
                                    <img src="{{ URL::asset('app/archivos/productos/'.$producto->imagen_url) }}" class="flex-shrink-0 w-28"/>
                                    @endif
                                    <x-jet-input-error for="imagen_url"/>
                        </div>
                    </div>


                    <div class="grid grid-cols-1 gap-4">
                        <div class="py-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea type="text" name="description" id="description" wire:model='description' value="{{$producto->description}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full h-32 shadow-sm sm:text-sm border-gray-300 resize-y rounded-md">{{$producto->description}}</textarea>
                            <x-jet-input-error for="description"/>
                        </div>
                    </div>
                        
                    <div class="flex justify-center py-2 font-light px-6 py-4 whitespace-nowrap">
                            <div class="pb-3.5 pr-4">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-2 mt-2 border border-blue-500 rounded py-1.5" type="submit">Guardar&nbsp;</button>
                            </div>
                            <div class="">
                            <a class="bg-red-500 hover:bg-red-700 text-white font-bold px-2 mt-2 border border-red-500 rounded py-1.5" href="{{ route('productos') }}" type="button" >Cancelar</a>
                            </div>
                        </div> 

                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
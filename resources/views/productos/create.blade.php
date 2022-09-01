<x-app-layout>
   <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar producto') }}
        </h2>
    </x-slot>-->
    <div class="flex flex-col justify-center items-center">
        

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

                    <div class="grid grid-cols-2 gap-4 pt-8">
                        <div class="py-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre *</label>
                            <input type="text" name="name" id="name" wire:model='name' autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <x-jet-input-error for="name"/>
                        </div>
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div>
                                <label for="upc" class="block text-sm font-medium text-gray-700">UPC</label>
                                <input type="text" name="upc" id="upc" wire:model='upc' maxlength="12" placeholder="000000000000" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="upc"/>
                            </div>
                            <div>
                                <label for="id_categoria" class="block text-sm font-medium text-gray-700">Categorías *</label>
                                <select wire:model="id_categoria" name="id_categoria"  id="id_categoria" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>  
                                    <option value="">{{ __("Seleccione") }}</option>                   
                                    @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="id_categoria"/>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div>
                            <label for="contenido_neto" class="block text-sm font-medium text-gray-700">Contenido neto *</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="text" name="contenido_neto" id="contenido_neto" wire:model='contenido_neto' autocomplete="given-contenido_neto" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <div class="absolute inset-y-0 right-0 flex items-center">
                                    <label for="medida" class="sr-only">Medida</label>
                                    <select id="medida" name="medida" class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">             
                                        @foreach ($medidas as $medida)
                                        <option value="{{ $medida->id }}">{{ $medida->unidad }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            <x-jet-input-error for="contenido_neto"/>
                            </div>
                            <div>
                                <label for="altura" class="block text-sm font-medium text-gray-700">Altura</label>
                                <input type="text" name="altura" id="altura" wire:model='altura' autocomplete="given-altura" placeholder="0" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="altura"/>
                            </div>
                        </div>
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div>
                                <label for="ancho" class="block text-sm font-medium text-gray-700">Ancho</label>
                                <input type="text" name="ancho" id="ancho" wire:model='ancho' autocomplete="given-ancho" placeholder="0" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="ancho"/>
                            </div>
                            <div>
                            <label for="unidad" class="block text-sm font-medium text-gray-700">Unidad disponible *</label>
                                <input type="text" name="unidad" id="unidad" wire:model='unidad' autocomplete="given-unidad" placeholder="0" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="unidad"/>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <div>
                                <label for="precio_sin_iva" class="block text-sm font-medium text-gray-700">Precio sin IVA *</label>
                                <input type="text" name="precio_sin_iva" id="precio_sin_iva" wire:model='precio_sin_iva' placeholder="0,00" autocomplete="given-precio_sin_iva" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="precio_sin_iva"/>
                            </div>
                            <div>
                                <label for="costo_unitario" class="block text-sm font-medium text-gray-700">Costo unitario *</label>
                                <input type="text" name="costo_unitario" id="costo_unitario" wire:model='costo_unitario' placeholder="0,00" autocomplete="given-costo_unitario" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="costo_unitario"/>
                            </div>
                        </div>
                        <div class="py-2 grid grid-cols-2 gap-4">
                        <div>
                                <label for="id_proveedor" class="block text-sm font-medium text-gray-700">Proveedor *</label>
                                <select wire:model="id_proveedor" name="id_proveedor"  id="id_proveedor" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>  
                                    <option value="">{{ __("Seleccione") }}</option>                   
                                    @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}">{{ $proveedor->name }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="id_proveedor"/>
                            </div>

                        <div class="">
                            <label for="exento" class="block text-sm font-medium text-gray-700">Exento de IVA *</label>
                                <div class="py-2 justify-center">
                                    <input type="radio" name="exento" wire:model='exento' value="1">&nbsp;Sí&nbsp;&nbsp;
                                    <input type="radio" name="exento" wire:model='exento'value="0" checked>&nbsp;No
                                </div>
                            <x-jet-input-error for="exento"/>
                        </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2 grid grid-cols-2 gap-4"> 
                            <div class="">
                                <label class="block text-sm font-medium text-gray-700 py-2">Imagen del producto</label>
                                <input type="file" name="imagen_url" id="imagen_url" accept="image/*" class="hidden">
                                    <x-jet-input-error for="imagen_url"/>
                                <x-button-file class="mr-2" type="button">
                                <label for="imagen_url" id="filelabel">
                                    Seleccionar archivo
                                </label>
                                </x-button-file>
                            </div>
                            <div class="py-2 mt-10 grid grid-cols-1">
                                <div>
                                    <label id='nombreFile' class="block text-sm font-medium text-gray-700" style="width: 150px;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div class="py-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Descripción *</label>
                            <textarea type="text" name="description" id="description" wire:model='description' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full h-32 shadow-sm sm:text-sm border-gray-300 resize-y rounded-md"></textarea>
                            <x-jet-input-error for="description"/>
                        </div>
                    </div>


                        <div class="flex justify-center py-2 font-light px-6 py-4 whitespace-nowrap">
                            <div class="pb-3.5 pr-4">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-2 mt-2 border border-blue-500 rounded py-1.5 w-20" type="submit">Guardar</button>
                            </div>
                            <div class="">
                            <a class="bg-red-500 hover:bg-red-700 text-white font-bold px-2 mt-2 border border-red-500 rounded py-1.5 w-20" href="{{ route('productos') }}" type="button" >Cancelar</a>
                            </div>
                        </div> 

                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

<script>
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('#id_categoria').select2({
    minimumResultsForSearch: Infinity
});
$('#medida').select2({
    minimumResultsForSearch: Infinity
});
$('#id_proveedor').select2({
    minimumResultsForSearch: Infinity
});
});

document.getElementById('imagen_url').onchange = function () {
   let nombre = document.getElementById('imagen_url').files[0].name;
   document.getElementById('nombreFile').innerHTML = nombre;
}

</script>
</x-app-layout>
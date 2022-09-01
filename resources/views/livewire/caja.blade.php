<div>
    <style>
.scroll::-webkit-scrollbar{
    width: 10px;
    background-color: rgb(59 130 246 / 50%);; 
}
.scroll::-webkit-scrollbar-track{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}
.scroll::-webkit-scrollbar-thumb{
    background-color: rgb(59 130 246 / 50%);; 
}


.scroll select::-ms-expand {
    display: none;
}

</style>
  <!--<x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             {{ __('Venta') }}
         </h2>
     </x-slot>-->
     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">
            <form wire:submit.prevent="submit" method="post" enctype="multipart/form-data" target="_blank">
                    @csrf

                <div class="px-4 py-5 bg-white sm:p-6">

                <div class="grid grid-cols-1 gap-1  justify-items-stretc">
                    <div class="justify-self-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Venta') }}
                    </h2>
                    </div>
                </div>


               <!--   <div class="grid grid-cols-1 gap-1 justify-items-stretc">
                            <div class="justify-self-center">
                                <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                                <input type="text" name="fecha" id="fecha" wire:model='fecha' value="{{$fecha_factura}}" placeholder="{{$fecha_factura}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" disabled>
                            </div>
                    </div>-->

                    <div class="pt-8 grid grid-cols-4 gap-4 justify-items-stretc">
                            <div>
                                <label for="identificacion" class="block text-sm font-medium text-gray-700">Cédula o RIF</label>
                                <input type="text" name="identificacion" id="identificacion" wire:model='identificacion'  placeholder="V-xxxxxxxx" maxlength="11"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>       
                            </div>
                   
                            <div class="py-4">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mt-2  border border-blue-500 rounded" type="button" wire:click='Buscar()'>Buscar</button>
                            </div>
                            <div> </div>
                            <div class="justify-self-end  w-3/4 md:flex md:items-center">
                                <div>
                                <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha:</label>
                                </div>
                                <div class="pb-1">
                                <input type="text" name="fecha" id="fecha" wire:model='fecha' value="{{$fecha_factura}}" placeholder="{{$fecha_factura}}" class="appearance-none bg-transparent border-none w-full focus:outline-none mt-1 block sm:text-sm" disabled>
                                </div>
                            </div>
                    </div>


                    <div class="py-2">
                        @if (session()->has('message'))
                            <p class="text-sm text-red-600">{{ session('message') }}</p>
                            <div class="py-2">
                            @if($botoncliente == 'true')
                                <a href="{{ route('clientesNuevo') }}" class="bg-green-600 hover:bg-green-500 text-white font-bold py-1 px-2 mt-2 border border-green-500 rounded">Registrar Cliente</a>
                                @elseif($botoncliente == 'false')
                                <a href="{{ route('clientes') }}" class="bg-green-600 hover:bg-green-500 text-white font-bold py-1 px-2 mt-2 border border-green-500 rounded">Listado de Cliente</a>
                                @endif
                            </div>
                    @endif
                    </div>

                        <div class="grid grid-cols-4 gap-4 py-2">
                            <div>
                                <input type="hidden" name="id_cliente" id="id_cliente" wire:model='id_cliente'>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre o Razón Social</label>
                                <input type="text" name="name" id="name" wire:model='name' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
                            </div>
                            <div>
                                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                <input type="text" name="telefono" id="telefono"  wire:model='telefono' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-2 py-2">
                        <div>
                            <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                            <textarea type="text" name="direccion" id="direccion"  wire:model='direccion' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly></textarea>
                        </div>
                        </div>

                        <div class="grid grid-cols-4 gap-4">
                            <div class="py-2" wire:ignore>
                            <label for="id_producto" class="block text-sm font-medium text-gray-700 pb-1">Productos</label>
                            <select wire:model="id_producto" name="id_producto" id="id_producto" class="pt-1 scroll appearance-none form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <option value="0" selected>{{ __("Seleccione") }}</option>         
                            @foreach ($productos as $producto)
                                <option value="{{ $producto['id'] }}">{{$producto['name'] }}</option>
                                @endforeach
                            </select>
                            </div>
                       
                        <!--<div class="grid grid-cols-4 gap-4">
                            <div class="py-2">
                            <label for="id_categoria" class="block text-sm font-medium text-gray-700">Categorías</label>
                            <select wire:model="id_categoria" name="id_categoria" wire:change="change()" class="scroll appearance-none form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                 <option value="" selected>{{ __("Seleccione") }}</option>                     
                                 @foreach ($categorias as $categoria)
                                 <option value="{{ $categoria->id }}">{{$categoria->name }}</option>
                                @endforeach
                            </select>
                            
                            </div>-->



                        <!--    <div class="py-2">
                            <label for="id_categoria" class="block text-sm font-medium text-gray-700">Productos</label>
                            <select wire:model="id_producto" name="id_producto"  id="id_producto" wire:change="seleccionBuscador()" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'  class="scroll form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md appearance-none">
                                <option value="0" selected>{{ __("Seleccione") }}</option>              
                                @foreach ($productos as $producto)
                                <option value="{{ $producto['id'] }}">{{$producto['name'] }}</option>
                                @endforeach
                                </select>
                            </div>
-->

                            <div class="py-2">
                            @if($disponible >= 0)
                                <label for="id_categoria" class="block text-sm font-medium text-gray-700">Disponible</label>
                                    <input type='text' class="font-bold text-green-600 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block shadow-sm sm:text-sm border-gray-300 rounded-md w-1/3" placeholder="{{$disponible}}" value="{{$disponible}}" disabled/>
                                    &nbsp;&nbsp; 
                            @endif
                            </div>

                            

                        </div>
                        
                        <div class="py-2">
<table class="w-full border">
  <thead class="bg-gray-800 border-b">
    <tr>
      <th class="text-sm font-medium text-white border-r">Cantidad</th>
      <th class="text-sm font-medium text-white border-r">Descripción</th>
      <th class="text-sm font-medium text-white border-r">Precio</th>
      <th class="text-sm font-medium text-white border-r">Precio + IVA</th>
      <th class="text-sm font-medium text-white border-r">Impuesto</th>
      <th class="text-sm font-medium text-white border-r">&nbsp;</th>
      <th class="text-sm font-medium text-white border-r">&nbsp;</th>
    </tr>
  </thead>
  <tbody>
    @if($ventas)
           @foreach($ventas as $key => $value)
    <tr class="border-b">
        <td  class="w-24 border-r">
            <input type="hidden" name="disProducto.{{ $key }}" id="disProducto.{{ $key }}" wire:model='disProducto.{{ $key }}'>
            <input type="number"  name="cantidad.{{ $key }}"  wire:model='cantidad.{{  $key }}' min="1" id="cantidad.{{$key}}" onkeypress="return validacionInt('cantidad.{{$key}}')"  class="block appearance-none text-left bg-transparent border-none w-full mr-3 py-1 px-2 leading-tight focus:outline-none sm:text-sm">
        </td>
        <td class="border-r">
            <input type="hidden" name="idP.{{ $key }}" id="idP.{{ $key }}" wire:model='idP.{{ $key }}'>
            <input type="hidden" name="idProducto.{{ $key }}" id="idProducto.{{ $key }}" wire:model='idProducto.{{ $key }}'>
            <input type="text" name="id_producto.{{ $key }}" class="block appearance-none text-left bg-transparent border-none w-full focus:outline-none sm:text-sm" wire:model="searchTerm.{{ $key }}" disabled>
        </td>
        <td  class="w-28 border-r">
            <input type="text" name="precio_sin_iva.{{ $key }}"  wire:model='costo.{{ $key }}' class="appearance-none text-right bg-transparent border-none w-full  mr-3 py-1 px-2 leading-tight focus:outline-none sm:text-sm" disabled> 
            <input type="text" name="costo_dolares.{{ $key }}"  wire:model='costo_dolares.{{ $key }}' class="appearance-none text-right bg-transparent border-none w-full  mr-3 py-1 px-2 leading-tight focus:outline-none sm:text-sm" disabled> 
        </td>
        <td  class="w-28 border-r">
            <input type="hidden" name="montoP.{{ $key }}"  wire:model='montoP.{{ $key }}'>
            <input type="text" name="total.{{ $key }}"  wire:model='total.{{ $key }}' class="appearance-none text-right bg-transparent border-none w-full  mr-3 py-1 px-2 leading-tight focus:outline-none sm:text-sm" disabled>
            <input type="text" name="total_dolar_input.{{ $key }}"  wire:model='total_dolar_input.{{ $key }}' class="appearance-none text-right bg-transparent border-none w-full mr-3 py-1 px-2 leading-tight focus:outline-none sm:text-sm" disabled>
        </td>
        <td  class="w-24 border-r">
            @if(count($impuesto) > $key)
                @if($impuesto[$key] == 0)
                <input type="text" placeholder="EX"  class="appearance-none text-center bg-transparent border-none w-full  mr-3 py-1 px-2 leading-tight focus:outline-none sm:text-sm" disabled>
               @else
               <input type="text" placeholder="GR"  class="appearance-none text-center bg-transparent border-none w-full  mr-3 py-1 px-2 leading-tight focus:outline-none sm:text-sm" disabled>
               @endif
           @else

           <input type="text" class="appearance-none text-center bg-transparent border-none w-full mr-3 py-1 px-2 leading-tight focus:outline-none sm:text-sm" disabled>
            @endif
        </td>
        <td class="w-16 border-r px-8 py-4">
            <button class="py-2" type="button" title='Agregar'><i class="fa fa-plus fa-sm" style="color: green;" wire:click='agregarProductos'></i></button>
        </td>
        <td class="w-16 border-r px-8 py-4">
            <button class="py-2" type="button" title='Eliminar'><i class="fa fa-trash-can fa-sm"style="color: red;" wire:click='modalEliminar({{$key}})'></i></button>
        </td>
                      
    </tr>
            @endforeach
        @endif
  </tbody>
  <footer>
    <tr>
        <td></td>
    </tr>
  </footer>
</table>

</div>


<table class="w-full">
    <thead>
        <tr class="">
            <td colspan="2"><label  class="block text-sm font-medium text-gray-700">Cantidad de productos:@if(isset($cantidadProducto))<strong>&nbsp;{{$cantidadProducto}}</strong>@else<strong>&nbsp;0</strong>@endif</label></td>
            <td class="text-center"><label for="total_sin_iva" class="block text-sm font-medium text-gray-700">Sub-Total</label></td>
            <td class="text-center"><label for="total_IVA" class="block text-sm font-medium text-gray-700">IVA</label></td>
            <td class="text-center"><label for="total_bs" class="block text-sm font-medium text-gray-700">Total Bs</label></td>
            <td class="text-center"><label for="total_dolar" class="block text-sm font-medium text-gray-700">Total $</label></td>
           <td></td>
        </tr>
    </thead>
<tbody>
    <tr>
        <td colspan="2" class="w-38"></td>
        <td class="w-28 px-2 text-center"><input type="text" name="total_sin_iva" id="total_sin_iva"  wire:model='total_sin_iva'  class="text-right justify-self-end mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-24 shadow-sm sm:text-sm border-gray-300 rounded-md"></td>
        <td class="w-28 px-2 text-center"><input type="text" name="total_IVA" id="total_IVA"  wire:model='total_IVA'  class="text-right justify-self-end mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-24 shadow-sm sm:text-sm border-gray-300 rounded-md"></td>
        <td class="w-28 px-2 text-center"><input type="text" name="total_bs" id="total_bs"  wire:model='total_bs'  class="text-right justify-self-end mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-24 shadow-sm sm:text-sm border-gray-300 rounded-md"></td>
        <td class="w-28 px-2 text-center"><input type="text" name="total_dolar" id="total_dolar"  wire:model='total_dolar' class="text-right mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-24 shadow-sm sm:text-sm border-gray-300 rounded-md"></td>
      <td class="w-8"></td>
    </tr>
</tbody>
</table>


                        <div class="flex justify-center py-2 font-light px-6 py-4 whitespace-nowrap">
                        
                        <div class="pb-3.5 pr-4">
                            @if($botonFactura == 'true')
                                <input type="hidden" name="botonFactura" id="botonFactura" value="{{$botonFactura}}"/>
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mt-2  border border-blue-500 rounded py-1.5" type="button" wire:click='redireccionar()'>Procesar Pago</button>
                            @else
                              <input type="hidden" name="factura" id="factura" value="{{$botonFactura}}"/>
                            @endif
                        </div>
                    </div> 



<x-jet-dialog-modal wire:model="confirmingDeletion">
    <x-slot name="title">
        <span class="flex justify-center">
        <i class="fa fa-exclamation-circle fa-3x" aria-hidden="true" style="color: red;"></i>
        </span>
    </x-slot>
    <x-slot name="content">
        <span class="flex justify-center">
        ¿Está seguro que desea eliminar el producto?
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
        <x-jet-danger-button  wire:loading.attr="disabled" wire:click="eliminarProductos">
            Sí
            </x-jet-danger-button>
        </div>
        </span>
</x-slot>
</x-jet-dialog-modal>


<x-jet-dialog-modal wire:model="Deletion">
    <x-slot name="title">
        <span class="flex justify-center">
        <i class="fa fa-exclamation-circle fa-3x" aria-hidden="true" style="color: #dac52d;"></i>
        </span>
    </x-slot>
    <x-slot name="content">
        <span class="flex justify-center">
          ¡Debe agregar algún producto a la casilla vacía o eliminarla!
        </span>
    </x-slot>
        
<x-slot name="footer">
<span class="flex justify-center pt-2">
        <div class="pb-3.5 pr-4">
        <x-button-advertencia class="mx-8"  wire:loading.attr="disabled" wire:click="cerrar">
            ok
        </x-button-advertencia>
        </div>
        </span>
</x-slot>
</x-jet-dialog-modal>

<x-jet-dialog-modal wire:model="negada">
    <x-slot name="title">
        <span class="flex justify-center">
        <i class="fa fa-exclamation-circle fa-3x" aria-hidden="true" style="color: #dac52d;"></i>
        </span>
    </x-slot>
    <x-slot name="content">
        <span class="flex justify-center">
          ¡Esta solicitando un producto que supera la cantidad disponible!
        </span>
    </x-slot>
        
<x-slot name="footer">
<span class="flex justify-center pt-2">
        <div class="pb-3.5 pr-4">
        <x-button-advertencia class="mx-8"  wire:loading.attr="disabled" wire:click="cerrar">
            ok
        </x-button-advertencia>
        </div>
        </span>
</x-slot>
</x-jet-dialog-modal>

                </div>
                </form>
            </div>
        </div>
      </div>
</div>

<script>
function validacionInt(campo){
  let cantidad = document.getElementById(campo);
  cantidad.value = cantidad.value.replace(/[^0-9]/g, '');
}

// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('#id_producto').select2();
    $('#id_producto').on('change',function(){
        @this.set('select',this.value);
    });
});

</script>
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
                                <input type="text" name="identificacion" id="identificacion" wire:model='identificacion' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">       
                            </div>
                   
                            <div class="py-4">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mt-2  border border-blue-500 rounded" wire:click='Buscar()'>Buscar</button>
                            </div>
                            <div> </div>
                            <div class="justify-self-end  w-3/4 md:flex md:items-center">
                                <div>
                                <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha:</label>
                                </div>
                                <div>
                                <input type="text" name="fecha" id="fecha" wire:model='fecha' value="{{$fecha_factura}}" placeholder="{{$fecha_factura}}" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" disabled>
                                </div>
                            </div>
                    </div>

                        @if (session()->has('message'))
                        <div class="mt-2 py-2">
                            {{ session('message') }}
                            <div class="py-2">
                            <a href="/clientes/nuevo" class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 border border-green-500 rounded">Registrar Cliente</a>
                            </div>

                        </div>
                            @endif
                        

                        <div class="grid grid-cols-4 gap-4 py-2">
                            <div>
                                <input type="hidden" name="id_cliente" id="id_cliente" wire:model='id'>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre o Razón Social</label>
                                <input type="text" name="name" id="name" wire:model='name' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                <input type="text" name="telefono" id="telefono"  wire:model='telefono' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-2 py-2">
                        <div>
                            <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                            <textarea type="text" name="direccion" id="direccion"  wire:model='direccion' class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                        </div>
                        </div>


                        <div class="grid grid-cols-4 gap-4">
                            <div class="py-2">
                            <label for="id_categoria" class="block text-sm font-medium text-gray-700">Categorias</label>
                            <select wire:model="id_categoria" name="id_categoria" wire:change="change(0)" class="scroll appearance-none form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                 <option value="">{{ __("Seleccione") }}</option>                     
                                 @foreach ($categorias as $categoria)
                                 <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                @endforeach
                            </select>
                            
                            </div>



                            <div class="py-2">
                            <label for="id_categoria" class="block text-sm font-medium text-gray-700">Productos</label>
                            <select wire:model="id_producto" name="id_producto" wire:change="seleccionBuscador()" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'  class="scroll form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md appearance-none">
                                <option value="">{{ __("Seleccione") }}</option>              
                                @foreach ($productos as $producto)
                                <option value="{{ $producto['id'] }}">{{ $producto['name'] }}</option>
                                @endforeach
                                </select>
                            </div>


                            <div class="py-2">
                            @if(!empty($disponible))
                                <label for="id_categoria" class="block text-sm font-medium text-gray-700">Disponible</label>
                                    @if($disponible != '')
                                    <input type='text' class="font-bold text-green-600 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block shadow-sm sm:text-sm border-gray-300 rounded-md w-1/3" placeholder="{{$disponible}}" value="{{$disponible}}" disabled/>
                                    &nbsp;&nbsp;
                                    @endif
                                @endif
                            </div>

                        <!--    <div class="py-2">
                            <div class="overflow-y-auto h-20">
                                <ul class="divide-y divide-blue-600 overflow-visible" id='lista.0'>
                                @foreach ($productos as $producto)
                                <li name='producto'><button wire:click="seleccionBuscador({{ $producto['id'] }})"><p>{{ $producto['name'] }}</p></button></li>
                                @endforeach
                                </ul>
                            </div>
                            </div>-->


                        </div>
                        
                        <div class="py-2">
<table class="w-full border">
  <thead class="bg-gray-800 border-b">
    <tr class="">
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
    <tr class="border-b">
      <td class="w-24 border-r">
        <input type="text" name="cantidad.0" wire:model='cantidad.0' class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none">
      </td>
      <td class="border-r">
        <input type="text"  name="id_producto.0" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" wire:model="searchTerm.0" disabled>
      </td>
      <td  class="w-24 border-r">
        <input type="text" name="costo_unitario.0"  wire:model='costo.0' class="appearance-none text-right bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" disabled>
      </td>
      <td  class="w-24 border-r">
        <input type="text" name="total.0"  wire:model='total.0' class="appearance-none text-right bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" disabled>
     </td>
      <td class="w-24 border-r">
        @if($impuesto)
            @if($impuesto[0] == 0)
                <input type="text" placeholder="EX"  class="appearance-none text-center bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" disabled>
            @else
               <input type="text" placeholder="GR"  class="appearance-none text-center bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" disabled>
            @endif
        @else
        <input type="text" class="appearance-none text-right bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" disabled>
        @endif
      </td>
      <td  class="w-24 border-r px-8 py-4">
       <button><i class="fa fa-plus fa-sm" style="color: green;" wire:click='agregarProductos()'></i></button>
      </td>
      <td  class="w-24 border-r px-8 py-4">
        <button><i class="fa fa-trash-can fa-sm"style="color: red;" wire:click='eliminarProductos(0)'></i></button>
      </td>
    </tr>
    @if($ventas)
           @foreach($ventas as $key => $value)
    <tr class="border-b">
        <td  class="w-24 border-r">
            <input type="text"  name="cantidad.{{ $key+1 }}"  wire:model='cantidad.{{  $key+1 }}' class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none">
        </td>
        <td class="border-r">
            <input type="text" name="id_producto.{{ $key+1 }}" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" wire:model="searchTerm.{{ $key+1 }}" disabled>
        </td>
        <td  class="w-24 border-r">
            <input type="text" name="costo_unitario.{{ $key+1 }}"  wire:model='costo.{{ $key+1 }}' class="appearance-none text-right bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" disabled>
        </td>
        <td  class="w-24 border-r">
            <input type="text" name="total.{{ $key+1 }}"  wire:model='total.{{ $key+1 }}' class="appearance-none text-right bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" disabled>
        </td>
        <td  class="w-24 border-r">
            @if(count($impuesto) > $key+1)
                @if($impuesto[$key+1] == 0)
                <input type="text" placeholder="EX"  class="appearance-none text-center bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" disabled>
               @else
               <input type="text" placeholder="GR"  class="appearance-none text-center bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" disabled>
               @endif
           @else

           <input type="text" class="appearance-none text-right bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" disabled>
            @endif
        </td>
        <td class="w-24 border-r px-8 py-4">
            <button class="py-2"><i class="fa fa-plus fa-sm" style="color: green;" wire:click='agregarProductos'></i></button>
        </td>
        <td class="w-24 border-r px-8 py-4">
            <button class="py-2"><i class="fa fa-trash-can fa-sm"style="color: red;" wire:click='eliminarProductos({{$key+1}})'></i></button>
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

                 


                        <div class="grid grid-cols-4 gap-1 justify-items-stretc">
                           <div class="justify-self-end w-3/4"></div>
                           <div class="justify-self-end w-1/4"></div>
                            <div class="justify-self-end w-3/4 md:flex md:items-center">
                                <div class="md:w-2/3">
                                    <label for="fecha" class="block text-sm font-medium text-gray-700">Total Bs</label>
                                </div>
                                <div class="md:w-full">
                                <input type="text" name="fecha" id="fecha"  class="justify-self-end mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-4 gap-1 justify-items-stretc">
                           <div class="justify-self-start md:flex md:items-left"><label>Cantidad de productos:@if(isset($cantidadProducto))<strong>&nbsp;{{$cantidadProducto}}</strong>@else<strong>&nbsp;0</strong>@endif</label></div>
                           <div class="justify-self-end w-1/4"></div>
                            <div class="justify-self-end w-3/4 md:flex md:items-center">
                                <div class="md:w-2/3">
                                    <label for="fecha" class="block text-sm font-medium text-gray-700">Total $</label>
                                </div>
                                <div class="md:w-full">
                                <input type="text" name="fecha" id="fecha"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                        </div>



                </div>
            </div>
        </div>
      </div>
</div>


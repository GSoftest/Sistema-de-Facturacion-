<x-app-layout>
  <!--  <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modificar categoria') }}
        </h2>
    </x-slot>-->
    <div class="flex flex-col justify-center items-center">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <form action="{{ route('editarCategoria')  }}" method="post" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="px-4 py-5 bg-white sm:p-6">

                    <div class="grid grid-cols-1 gap-1  justify-items-stretc">
                            <div class="justify-self-center">
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ __('Actualizar Categoría') }}
                                </h2>
                            </div>
                        </div>
                        
                        <div class="pt-8 py-2 grid grid-cols-2 gap-4 justify-items-stretc">
                        <input type="hidden" name="id" id="id" value="{{$data->id}}">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre *</label>
                                <input type="text" name="name" id="name" wire:model='name' value="{{$data->name}}"  autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="name" id='ocultarNameEditC'/>
                            </div>
                        </div>

                        <div class="py-2 grid grid-cols-2 gap-4 justify-items-stretc">
                            <div class="col-span-2 sm:col-span-2"> 
                                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción *</label>
                                <textarea type="text" name="descripcion" id="descripcion" wire:model='descripcion' value="{{$data->descripcion}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full h-32 shadow-sm sm:text-sm border-gray-300 resize-y rounded-md">{{$data->descripcion}}</textarea>
                                <x-jet-input-error for="descripcion" id='ocultarDesEditC'/>
                            </div>
                            <div class="col-span-2 sm:col-span-2"></div>
                        </div>

                        <div class="flex justify-center py-2 font-light px-6 py-4 whitespace-nowrap">
                            <div class="pb-3.5 pr-4">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-2 mt-2 border border-blue-500 rounded py-1.5 w-20" type="submit">Guardar</button>
                            </div>
                            <div class="">
                            <a class="bg-red-500 hover:bg-red-700 text-white font-bold px-2 mt-2 border border-red-500 rounded py-1.5 w-20" href="{{ route('categorias') }}" type="button" >Cancelar</a>
                            </div>
                        </div> 

                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
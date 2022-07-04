<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modificar categoria') }}
        </h2>
    </x-slot>
    <div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <form action="{{ route('editarCategoria')  }}" method="post" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-3 sm:col-span-3">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre de la categoria</label>
                                <input type="hidden" name="id" id="id" value="{{$data->id}}">
                                <input type="text" name="name" id="name" wire:model='name' value="{{$data->name}}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <label for="name" class="block text-sm font-medium text-gray-700 py-2">Imagen de la categoria</label>
                                <img src="{{ URL::asset('app/archivos/categorias/'.$data->imagen) }}" class="flex-shrink-0 w-28"/>
                                <input type="file" name="imagen" accept="image/*">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mt-2  border border-blue-500 rounded" type="submit">Guardar</button>
                                <a href="/categorias" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 mt-2  border border-red-500 rounded">Cancelar</a>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
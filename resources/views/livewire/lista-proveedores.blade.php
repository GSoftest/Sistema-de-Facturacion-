<div class="flex flex-col justify-center items-center">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Proveedores') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="shadow overflow-hidden sm:rounded-md">

        <div class="px-4 py-5 bg-white sm:p-6">
        <a class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 border border-green-500 rounded"
        href="/proveedores/nuevo">Nuevo</a>

    <x-table>
            <table class="text-center">
             <thead class="border-b bg-gray-800">
                 <tr>
                     <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                         Nombre
                     </th>
                     <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                         Acción
                     </th>
                 </tr>
             </thead class="border-b">
         </table>


     </x-table>
        </div>
        </div>
        </div>
    </div>
</div>

<div>
    <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             {{ __('Lista de servicio técnico') }}
         </h2>
     </x-slot>

     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="shadow overflow-hidden sm:rounded-md">

        <div class="px-4 py-5 bg-white sm:p-6">
        <x-table>
            <table class="text-center">
             <thead class="border-b bg-gray-800">
             <tr>
                     <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                         Recibo
                     </th>
                     <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                         fecha
                     </th>
                     <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                        Abono
                     </th>
                     <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                         Monto pendiente
                     </th>
                 </tr>
             </thead class="border-b">
             <tbody>
             @foreach ($servicios as $servicio)
                     <tr class="bg-white border-b">
                         <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                             {{ $servicio->id_recibo }}</td>
                         <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            {{ $servicio->fecha }}</td>
                         </td>
                         <td class="text-sm text-gray-900 font-light whitespace-nowrap">
                             {{ $servicio->abono }}
                         </td>
                         <td class="text-sm text-gray-900 font-light whitespace-nowrap">
                             {{ $servicio->monto_pendiente }}
                         </td>
                         <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                         </td>
                     </tr class="bg-white border-b">
                 @endforeach
             </tbody>
         </table>

         <div class="mt-4">
                        {{ $servicios->links() }}
               </div>
         </x-table>
         </div>
        </div>
        </div>
    </div>
</div>

<x-app-layout>
   <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sistema de facturación') }}
        </h2>
    </x-slot>-->


    <div class="flex flex-col justify-center items-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12 inline-grid grid-cols-4 gap-4 text-center">
            

                <a  href="/clientes">
                <div class="px-4 py-4 bg-white sm:p-6 w-72 hover:shadow-2xl">
                    <div class="px-4 py-4">
                        <i class="fa-solid fa-users fa-3x" style="color: blue;"></i>
                    </div>
                    <label for=""><strong>Clientes</strong></label>
                </div>
                </a>

                <a  href="/productos">
                <div class="px-4 py-4 bg-white sm:p-6 w-72 hover:shadow-2xl">
                    <div class="px-4 py-4">
                        <i class="fa-brands fa-product-hunt fa-3x" style="color: red;"></i>
                    </div>
                    <label for=""><strong>Productos</strong></label>
                </div>
                </a>
    
                <a  href="/categorias">
                <div class="px-4 py-4 bg-white sm:p-6 w-72 hover:shadow-2xl">
                <div class="px-4 py-4"><i class="fa-solid fa-dice-d6 fa-3x" style="color: green;"></i></div>
                    <label for=""><strong>Categorías</strong></label>
                </div>
                </a>

                <a  href="/iva">
                <div class="px-4 py-4 bg-white sm:p-6 w-72 hover:shadow-2xl">
                    <div class="px-4 py-4">
                    <i class="fa-solid fa-percent fa-3x"></i>
                    </div>
                    <label for=""><strong>Iva</strong></label>
                </div>
                </a>
        </div>
    </div>
    <div class="flex flex-col justify-center items-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12 inline-grid grid-cols-4 gap-4 text-center">
      
                <a  href="/caja">
                <div class="px-4 py-4 bg-white sm:p-6 w-72 hover:shadow-2xl">
                    <div class="px-4 py-4">
                        <i class="fa-solid fa-cash-register fa-3x" style="color: purple;"></i>
                    </div>
                    <label for=""><strong>Ventas</strong></label>
                </div>
                </a>
    
                <a  href="/servicioTecnico">
                <div class="px-4 py-4 bg-white sm:p-6 w-72 hover:shadow-2xl">
                <div class="px-4 py-4"><i class="fa-solid fa-user-group fa-3x" style="color: #d28919;"></i></div>
                    <label for=""><strong>Servicio Técnico</strong></label>
                </div>
                </a>


                <a  href="/listaServicioTecnico">
                <div class="px-4 py-4 bg-white sm:p-6 w-72 hover:shadow-2xl">
                <div class="px-4 py-4"><i class="fa-solid fa-list fa-3x" style="color: #48dad2;"></i></div>
                    <label for=""><strong>Registro de servicios</strong></label>
                </div>
                </a>


                <a  href="/tasa">
                <div class="px-4 py-4 bg-white sm:p-6 w-72 hover:shadow-2xl">
                <div class="px-4 py-4"><i class="fa-solid fa-dollar-sign fa-3x" style="color: #0337aa;"></i></div>
                    <label for=""><strong>Tasa</strong></label>
                </div>
                </a>

            <!--    <a  href="/iva">
                <div class="px-4 py-5 bg-white sm:p-6 w-72 hover:shadow-2xl">
                <div class="px-4 py-5"><i class="fa-solid fa-chart-line fa-3x" style="color: purple;"></i></div>
                    <label for=""><strong>Estadísticas</strong></label>-->
                    <!--<label for=""><strong>{{$categorias}}</strong></label>-->
                    
              <!--  </div>
                </a>-->
        </div>
    </div>
</x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
     <!-- Fonts -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
   <link rel="stylesheet" href="{{ URL::asset('/css/style.css'); }}">
    <!-- Styles -->
  <!--  {!! Html::style('/css/style.css') !!} -->
 
</head>

<body>
    <header>
    <div class="flex items-center w-1/5">
        <img src="{{ URL::asset('/app/archivos/logo.jpg'); }}" class="w-1/5"/>
    </div>

    <div id="details" class="clearfix">
        <div id="invoice">
          <h1>INVOICE</h1>
          <div class="date">Date of Invoice: {{$data['fecha']}}</div>
        </div>
      </div>

    </header>

    <section>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-1 gap-1 justify-items-stretc py-2">
                            <div class="justify-self-end">

                                <label for="recibo" class="block text-sm font-medium text-gray-700">N° Recibo</label>
                               </div>
                    </div>


                        <div class="grid grid-cols-4 gap-4">
                            
                            <div>
                                <label for="identificacion" class="block text-sm font-medium text-gray-700">Cédula o RIF</label>
                                <h4 >{{$data['identificacion']}}</h4>
                              </div>
                   
                         
                        </div>
                        <div class="grid grid-cols-4 gap-4 py-2">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre o Razón Social</label>
                                <h4 >{{$data['name']}}</h4>
                           </div>
                            <div>
                                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                <h4 >{{$data['telefono']}}</h4>
                               </div>
                        </div>

                        <div class="grid grid-cols-2 gap-2 py-2">
                        <div>
                            <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                            <h4 >{{$data['direccion']}}</h4>
                        </div>
                        </div>

                        <div class="py-2">
                            <label for="descripcion_equipo" class="block text-sm font-medium text-gray-700">Descripción del Equipo y Falla</label>
                              <h4 >{{$data['descripcion_equipo']}}</h4>
                        </div>


                        <div class="grid grid-cols-4 gap-4 py-2">
                            <div>
                                <label for="monto_sin_iva" class="block text-sm font-medium text-gray-700">Monto</label>
                                  <h4 >{{$data['monto_sin_iva']}}</h4>
                                <div class="py-2">
                            <label for="id_iva" class="block text-sm font-medium text-gray-700">Iva</label>
                            
                            </div>
                            <div class="py-2">
                                <label for="monto_con_iva" class="block text-sm font-medium text-gray-700">Monto Total</label>
                                <h4 >{{$data['monto_con_iva']}}</h4>
                               </div>

                            <div class="py-2">
                                <label for="abono" class="block text-sm font-medium text-gray-700">Abono</label>
                                <h4 >{{$data['abono']}}</h4>
                                   </div>
                            <div class="py-2">
                                <label for="monto_pendiente" class="block text-sm font-medium text-gray-700">Monto Pendiente</label>
                                <h4 >{{$data['monto_pendiente']}}</h4>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </section>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                <tr>
                    <th>Descripción del Equipo y Falla</th>
                    <th>Abono</th>
                    <th>Monto</th>
                </tr>
                </thead>
                <tbody>
                
                    <tr>
                        <td></td>
                        <td></td>
                        <td>$</td>
                    </tr>
                
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3" class="text-right">Subtotal</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Descuento</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Subtotal con descuento</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Impuestos</td>
                    <td>></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">
                        <h4>Total</h4></td>
                    <td>
                        <h4></h4>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>


    <table class="border-separate border border-slate-500 ...">
  <thead>
    <tr>
      <th class="border border-slate-600 ...">State</th>
      <th class="border border-slate-600 ...">City</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="border border-slate-700 ...">Indiana</td>
      <td class="border border-slate-700 ...">Indianapolis</td>
    </tr>
    <tr>
      <td class="border border-slate-700 ...">Ohio</td>
      <td class="border border-slate-700 ...">Columbus</td>
    </tr>
    <tr>
      <td class="border border-slate-700 ...">Michigan</td>
      <td class="border border-slate-700 ...">Detroit</td>
    </tr>
  </tbody>
</table>


</body>
</html>
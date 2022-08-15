<table class="w-full border m:table-fixed">
                <thead class="border-b bg-gray-800">
                 <tr>
                    <th scope="col" class="text-sm font-medium text-white border-r">
                        Factura
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        RIF/CI
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        Nombre/Razón Social
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        Monto Total Bruto
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        Monto Total IVA
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        Monto Total Neto
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                        Fecha de la Venta
                     </th>
                     <th scope="col" class="text-sm font-medium text-white border-r">
                         &nbsp;
                     </th>
                 </tr>
                </thead>
                <tbody>
                    @foreach ($ventas as $venta)
                    <tr class="border-b">
                    <td class="w-44 border-r text-gray-700 mr-3 text-center">
                    @foreach ($factura as $fac)
                    @if($fac->id_venta == $venta->id) 
                        {{$fac['lpad(numero_factura, 15, 0)']}}
                    @endif
                    @endforeach
                    </td>
                    <td class="w-44 border-r text-gray-700 mr-3 text-center">
                    @foreach ($cliente as $clien)
                    @if($clien->id == $venta->id_cliente) 
                        {{$clien->identificacion}}
                    @endif
                    @endforeach
                    </td>
                    <td class="w-44 border-r text-gray-700 mr-3 text-left">
                    @foreach ($cliente as $clien)
                    @if($clien->id == $venta->id_cliente) 
                        {{$clien->name}}
                    @endif
                    @endforeach
                    </td>
                    <td class="w-32 border-r appearance-none text-gray-700 mr-3 text-right">{{$venta->sub_total}}</td>
                    <td class="w-32 border-r appearance-none text-gray-700 mr-3 text-right">{{$venta->iva}}</td>
                    <td class="w-32 border-r appearance-none text-gray-700 mr-3 text-right">{{$venta->total}}</td>
                    <td class="w-28 border-r appearance-none text-gray-700 mr-3 text-center">
                        {{date('d/m/Y',strtotime($venta->fecha))}}
                    </td>
                    <td class="w-16 border-r text-center">
                    @foreach ($factura as $fac)
                    @if($fac->id_venta == $venta->id) 
                    <button class="py-2" type="button" wire:click="download('{{$fac->nombre_factura}}')" title="Descargar Factura"><i class="fa fa-download fa-sm" style="color: green;" aria-hidden="true"></i></button>
                    @endif
                    @endforeach
                </td>
                    </tr>
                    @endforeach
                </tbody>
</table> 
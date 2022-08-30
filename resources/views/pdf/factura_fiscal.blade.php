<?php
$medidaTicket = 180;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            font-size: 7px;
            font-family: 'DejaVu Sans', serif;
        }

        h1 {
            font-size: 10px;
        }

        .ticket {
            margin: 2px;
        }

        td,
        th,
        tr,
        table .borde{
            border-top: 1px solid black;
            border-collapse: collapse;
            margin: 0 auto;
        }

        td,
        th,
        tr,
        table .sinborde{
            border: hidden;
            margin: 0 auto;
            font-size: 7px;
        }

        td.precio {
            text-align: right;
            font-size: 7px;
        }

        td.cantidad {
            font-size: 7px;
        }

        td.producto {
            text-align: center;
        }

        th {
            text-align: center;
        }


        .centrado {
            text-align: center;
            align-content: center;
        }

        .left {
            text-align: left;
            align-content: left;
        }

        .ticket {
            width: <?php echo $medidaTicket ?>px;
            max-width: <?php echo $medidaTicket ?>px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        * {
            margin: 0;
            padding: 0;
        }

        .ticket {
            margin: 0;
            padding: 0;
        }

        body {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="ticket centrado">
        <h1>SENIAT</h1>
        <h6>J-xxxxxxxxx</h6>
        <h6>Company Name</h6>
        <h6>Av xxxxxxx xxxxx,<br /> xxxxxx, Caracas <br />(Plaza Venezuela) Distrito Capital</h6>
        <h6>(0212) XXX-XX-XX</h6>
        <h6>company@example.com</h6>
        
<table class="sinborde" style="width: 100%;">
    <tbody>
        <tr class="sinborde">
            <td class="sinborde">CLIENTE</td>
            <td class="sinborde" colspan="2">{{$datapdf['name']}}</td>
        </tr>
        <tr class="sinborde">
            <td class="sinborde">CI/RIF</td>
            <td class="sinborde" colspan="2">{{$datapdf['identificacion']}}</td>
        </tr>
        <tr class="sinborde">
            <td class="sinborde">DIRECCIÓN</td>
            <td class="sinborde" colspan="2">{{$datapdf['direccion']}}</td>
        </tr>
        <tr class="sinborde">
            <td class="sinborde">TELÉFONO</td>
            <td class="sinborde" colspan="2">{{$datapdf['telefono']}}</td>
        </tr>
        <tr class="sinborde">
            <td class="sinborde">FACTURA N°</td>
            <td class="sinborde" colspan="2">{{$datapdf['factura']}}</td>
        </tr>
        <tr class="sinborde">
            <td class="sinborde">FECHA</td>
            <td class="sinborde" colspan="2">{{$datapdf['fecha']}} {{$datapdf['hora']}}</td>
        </tr>
    </tbody>
</table>
        <table class="borde" style="width: 100%;margin-top: 10px;">
            <thead class="borde">
                <tr class="centrado">
                    <th class="cantidad">CANT&nbsp;</th>
                    <th class="producto">PRODUCTO&nbsp;</th>
                    <th></th>
                    <th class="precio">TOTAL</th>
                </tr>
            </thead>
            <tbody class="borde">
                @foreach($datapdf['productos'] as $key => $value)
                    <tr>
                        <td class="cantidad">{{$datapdf['cantidad'][$key]}}</td>
                        <td class="producto" colspan="2">{{$value}}&nbsp;&nbsp;&nbsp;({{$datapdf['impuestop'][$key] == 0 ? 'EX': 'GR'}})</td>
                        <td class="precio">{{$datapdf['totalp'][$key]}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>  
        <table class="sinborde" style="width: 100%;margin-top: 10px;"> 
            <tbody class="sinborde"> 
            <tr>
                <td class="cantidad" colspan="3">
                    <strong>SUBTOTAL Bs:</strong>
                </td>
                <td class="precio">
                    {{$datapdf['SubtotalF']}}
                </td>
            </tr>
            <tr>
                <td class="cantidad" colspan="3">
                    <strong>IVA {{$datapdf['porcentajeIva']}} % Bs:</strong>
                </td>
                <td class="precio">
                    {{$datapdf['ivaF']}}
                </td>
            </tr>
            <tr>
                <td class="cantidad" colspan="3">
                    <strong>TOTAL Bs:</strong>
                </td>
                <td class="precio">
                    {{$datapdf['total_bs']}}
                </td>
            </tr>
            @if($datapdf['total_igtf'] > '0,00')
            <tr>
                <td class="cantidad" colspan="3">
                    <strong>TOTAL IGTF Bs:</strong>
                </td>
                <td class="precio">
                    {{$datapdf['total_igtf']}}
                </td>
            </tr>
            
            <tr>
                <td class="cantidad" colspan="3">
                    <strong>GRAN TOTAL Bs:</strong>
                </td>
                <td class="precio">
                    {{$datapdf['gran_total']}}
                </td>
            </tr>
            @foreach($datapdf['tipo_metodo'] as $key => $value)
            <tr>
                <td class="cantidad" colspan="3">
                    <strong>{{str_replace('BS','',mb_strtoupper($value))}} Bs:</strong>
                </td>
                <td class="precio">
                    {{$datapdf['list_pago_bs'][$key]}}
                </td>
            </tr>
            @endforeach
            @endif
            </tbody>
        </table>
        <p class="centrado">¡GRACIAS POR SU COMPRA!
    </div>
</body>
</html>
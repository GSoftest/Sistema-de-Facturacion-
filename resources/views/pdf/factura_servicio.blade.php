<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    {!! Html::style('/css/style.css') !!}
</head>
<body>
    <header class="clearfix">

      <h1 class="lineaTop"></h1>
      <h1 class="factura">SENIAT</h1>
      <div class="companyfactura">
        <div>J-xxxxxxxxx</div>
        <div>Company Name</div>
        <div>Av xxxxxxx xxxxx,<br /> xxxxxx, Caracas <br />(Plaza Venezuela) Distrito Capital</div>
        <div>(0212) XXX-XX-XX</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>
      <h1 class="lineabottom"></h1>

      <div class="clearfix"></div>

      <div id="project">
        <div><span>CLIENTE</span> {{$datapdf['name']}}</div>
        <div><span>CI/RIF</span> {{$datapdf['identificacion']}}</div>
        <div><span>DIRECCIÓN</span>{{$datapdf['direccion']}}</div>
        <div><span>TELÉFONO</span>{{$datapdf['telefono']}}</div>
        <div><span>N° FACTURA</span>{{$datapdf['factura']}}</div>
        <div><span>FECHA</span>{{$datapdf['fecha_servicio']}}</div>
        <div><span>HORA</span>{{$datapdf['hora']}}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">SERVICIO</th>
            <th class="">DESCRIPCION</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="service">Servicio técnico</td>
            <td class="desc">{{$datapdf['descripcion_equipo']}}</td>
            <td class="unit">{{$datapdf['monto_sin_iva']}}</td>
          </tr>
          <tr>
            <td colspan="2">SUBTOTAL</td>
            <td class="total">{{$datapdf['monto_sin_iva']}}</td>
          </tr>
          <tr>
            <td colspan="2">IVA {{$datapdf['porcentajeIva']}}%</td>
            <td class="total">{{$datapdf['montoIva']}}</td>
          </tr>
          <tr>
            <td colspan="2" class="grand total">TOTAL</td>
            <td class="grand total">{{$datapdf['monto_con_iva']}}</td>
          </tr>
        </tbody>
      </table>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>
</html>
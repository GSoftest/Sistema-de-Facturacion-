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
      <div id="logo">
        <img src="{{ URL::asset('/app/archivos/logo.jpg'); }}">
      </div>
      <h1 class="recibo">Recibo</h1>
      <div id="company" class="clearfix">
        <div>J-xxxxxxxxx</div>
        <div>Company Name</div>
        <div>Av xxxxxxx xxxxx,<br /> xxxxxx, Caracas <br />(Plaza Venezuela) Distrito Capital</div>
        <div>(0212) XXX-XX-XX</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>
      <div id="project">
        <div><span>CLIENTE</span> {{$datapdf['name']}}</div>
        <div><span>CI/RIF</span> {{$datapdf['identificacion']}}</div>
        <div><span>TELÉFONO</span>{{$datapdf['telefono']}}</div>
        <div><span>DIRECCIÓN</span>{{$datapdf['direccion']}}</div>
        <div><span>N° RECIBO</span>{{$datapdf['recibo']}}</div>
        <div><span>FECHA</span>{{$datapdf['fecha_servicio']}}</div>
        <div><span>HORA</span>{{$datapdf['hora']}}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">SERVICIO</th>
            <th class="">DESCRIPCIÓN</th>
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
          <tr>
            <td colspan="2" class="grand">ABONO</td>
            <td class="grand total">{{$datapdf['abono']}}</td>
          </tr>
          <tr>
            <td colspan="2">MONTO PENDIENTE</td>
            <td class="total">{{$datapdf['monto_pendiente']}}</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>NOTA:</div>
        <div class="notice">Para poder retirar debe poseer el recibo.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>
</html>
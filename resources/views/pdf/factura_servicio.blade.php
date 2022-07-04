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
      <h1>Factura</h1>
      <div id="company" class="clearfix">
        <div>Company Name</div>
        <div>direccion,<br /> direccion, VZ</div>
        <div>(212) XXX-XX-XX</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>
      <div id="project">
        <div><span>CLIENTE</span> {{$data['name']}}</div>
        <div><span>CI/RIF</span> {{$data['identificacion']}}</div>
        <div><span>TELEFONO</span>{{$data['telefono']}}</div>
        <div><span>DIRECCION</span>{{$data['direccion']}}</div>
        <div><span>N° FACTURA</span></div>
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
            <td class="desc">{{$data['descripcion_equipo']}}</td>
            <td class="unit">{{$data['monto_sin_iva']}}</td>
          </tr>
          <tr>
            <td colspan="2">SUBTOTAL</td>
            <td class="total">{{$data['monto_sin_iva']}}</td>
          </tr>
          <tr>
            <td colspan="2">IVA {{$data['porcentajeIva']}}%</td>
            <td class="total">{{$data['montoIva']}}</td>
          </tr>
          <tr>
            <td colspan="2" class="grand total">TOTAL</td>
            <td class="grand total">{{$data['monto_con_iva']}}</td>
          </tr>
        </tbody>
      </table>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>
</html>
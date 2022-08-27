<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    {!! Html::style('/css/style.css') !!}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
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
        <div><span>FECHA</span>{{$datapdf['fecha']}}</div>
        <div><span>HORA</span>{{$datapdf['hora']}}</div>
      </div>
    </header>
    <main>
      <table class="table-fixed">
        <thead>
          <tr>
            <th class="service">CANTIDAD</th>
            <th class="service">PRODUCTOS</th>
            <th class="service">IMPUESTO</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
          @foreach($datapdf['productos'] as $key => $value)
          <tr>
            <td class="service">{{$datapdf['cantidad'][$key]}}</td>
            <td class="desc">{{$value}}</td>
            <td class="service">
              {{$datapdf['impuestop'][$key] == 0 ? 'EX': 'GR'}}
            </td>
            <td class="total">{{$datapdf['totalp'][$key]}}</td>
          </tr>
          @endforeach
          <tr>
            <td class="total"></td>
            <td colspan="2">SUBTOTAL Bs:</td>
            <td class="total">{{$datapdf['SubtotalF']}}</td>
          </tr>
          <tr>
            <td class="total"></td>
            <td colspan="2">IVA {{$datapdf['porcentajeIva']}} % Bs:</td>
            <td class="total">{{$datapdf['ivaF']}}</td>
          </tr>
          <tr>
            <td class="grand total"></td>
            <td colspan="2" class="grand">TOTAL Bs:</td>
            <td class="grand total">{{$datapdf['total_bs']}}</td>
          </tr>
          @if($datapdf['total_igtf'] > '0,00')
          <tr>
            <td class="total"></td>
            <td colspan="2">TOTAL IGTF Bs:</td>
            <td class="total">{{$datapdf['total_igtf']}}</td>
          </tr>
          @endif
          <tr>
            <td class="grand total"></td>
            <td colspan="2" class="grand total">GRAN TOTAL Bs:</td>
            <td class="grand total">{{$datapdf['gran_total']}}</td>
          </tr>
          @foreach($datapdf['tipo_metodo'] as $key => $value)
          <tr>
            <td class="total"></td>
            <td colspan="2">{{str_replace('BS','',mb_strtoupper($value))}} Bs:&nbsp;</td>
            <td class="total">{{$datapdf['list_pago_bs'][$key]}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>




      
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>
</html>
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
        <div><span class="titulo">CLIENTE</span> {{$datapdf['name']}}</div>
        <div><span class="titulo">CI/RIF</span> {{$datapdf['identificacion']}}</div>
        <div><span class="titulo">DIRECCIÓN</span>{{$datapdf['direccion']}}</div>
        <div><span class="titulo">TELÉFONO</span>{{$datapdf['telefono']}}</div>
        <div><span class="titulo">N° FACTURA</span>{{$datapdf['factura']}}</div>
        <div><span class="titulo">FECHA</span>{{$datapdf['fecha']}}</div>
        <div><span class="titulo">HORA</span>{{$datapdf['hora']}}</div>
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
        </tbody>
      </table>
      <div id="project">
        <div><span class="titulo">SUBTOTAL Bs:</span><span class="texto">{{$datapdf['SubtotalF']}}</span></div>
        <div><span class="titulo">IVA {{$datapdf['porcentajeIva']}} % Bs:</span><span class="texto">{{$datapdf['ivaF']}}</span></div>
        <div><span class="titulo">TOTAL Bs:</span><span class="texto">{{$datapdf['total_bs']}}</span></div>
        <div><span class="titulo">TOTAL IGTF Bs:</span><span class="texto">{{$datapdf['total_igtf']}}</span></div>
        <div><span class="titulo">GRAN TOTAL Bs:</span><span class="texto">{{$datapdf['gran_total']}}</span></div>
        @foreach($datapdf['tipo_metodo'] as $key => $value)
          <div>
            <span class="titulo">{{str_replace('BS','',mb_strtoupper($value))}} Bs:&nbsp;</span><span class="texto">{{$datapdf['list_pago_bs'][$key]}}</span>
          </div>
          @endforeach
      </div>
      
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>
</html>
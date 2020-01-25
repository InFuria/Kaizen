<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <style>
        body {
            font-family: Nunito }

        .detail{
            text-align: end !important;
        }
    </style>
</head>
<body>
<div class="ticket" id="masterContent">
    <div>
        <div><img src="{{ asset("/images/logo-bw.png") }}" style="width: 130px; margin-left: 60px;"></div>
        <h4><strong>Nro de Orden: </strong>{{ $order->id }}</h4>
        <br>
        <h5 style="margin-top: -15px"><strong>Nro Factura: </strong>{{ $invoice->id }}</h5>
        <h5 style="margin-top: -10px">Fecha: {{ date( "d/m/Y", strtotime($invoice->created_at)) }} &nbsp; Hora: {{ date( "H:i:s", strtotime($invoice->created_at)) }}</h5>

    </div>

    <table>
        <hr>
        <thead>
        <tr style="font-size: 17px">
            <td><strong>Articulo</strong></td>
            <td><strong>Cant.</strong></td>
            <td style="padding-left: 10px"><strong>Precio</strong></td>
            <td style="padding-left: 20px; text-align: right"><strong>Sub Total</strong></td>
        </tr>
        </thead>
        <tbody>

        @foreach($product_detail as $product)
            <tr>
                <td>{{ $product->name  }}</td>
                <td>{{ $product->quantity  }}</td>
                <td style="padding-left: 10px">{{ $product->price }}</td>
                <td style="padding-left: 30px">{{ (integer) $product->quantity * (integer) $product->price  }}</td>
            </tr>
        @endforeach
        </tbody>

        <tfoot>
            <tr class="detail">
                <td colspan="3" style="padding-top: 20px"><strong>Total: </strong></td>
                <td style="padding-top: 20px">{{ $invoice->total }}</td>
            </tr>
            <tr class="detail">
                <td colspan="3"><strong>Recibido: </strong></td>
                <td>{{ $invoice->received }}</td>
            </tr>
            <tr class="detail">
                <td colspan="3"><strong>Su Vuelto: </strong></td>
                <td>{{ $change }}</td>
            </tr>
        </tfoot>
    </table>
    <hr>
    <div style="margin-top: 9px; margin-bottom: -15px">
        <h5 style="margin-bottom: -10px"><strong>Local: </strong>{{ $branch  }}</h5>
        <h5><strong>Cajero: </strong>{{ auth()->user()->name }}</h5>
        <h4>Gracias por su compra!</h4>
    </div>
    <p>--------------------------------------------</p>
    <p style="font-size: 13px; text-align: center">DOCUMENTO NO VALIDO COMO FACTURA</p>
</div>
</body>
</html>


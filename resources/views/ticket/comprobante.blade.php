<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style>
        body {
            font-family: Nunito }

        .ticket {
            width: 283px;
            max-width: 280px;
        }
        .detail{
            text-align: end !important;
        }

        /*img {
            max-width: inherit;
            width: inherit;
        }*/

    </style>
</head>
<body>
<div class="ticket">
    <div>
        <img src="../images/logo.png" style="width: 130px; margin-left: 60px;">

        {{--<h4 style="margin-top: 5;margin-left: 80px">Doña Rosa</h4>
        <h5 style="margin-top: -15px; margin-left: 55px">Empanadas Tucumanas</h5>--}}

        <h4><strong>Nro de Orden: {{ $order->id }}</strong></h4>
        <br>
        <h5 style="margin-top: -15px"><strong>Nro Factura: {{ $invoice->id }}</strong></h5>
        <h5 style="margin-top: -10px"><strong>Fecha: {{ date( "d/m/Y", strtotime($invoice->created_at)) }} </strong> &nbsp; <strong>Hora: {{ date( "H:i:s", strtotime($invoice->created_at)) }}</strong></h5>

    </div>

    <table>
        <hr>
        {{--<caption style="caption-side: top; /*margin-top: -20px; margin-bottom: -10px*/">===============================</caption>
        <caption style="caption-side: bottom; /*margin-top: 5px; margin-bottom: -10px*/">===============================</caption>--}}
        <thead>
        <tr style="font-size: 17px">
            <td {{--style="margin-right: -15px"--}}><strong>Articulo</strong></td>
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
        <h5 style="margin-bottom: -10px"><strong>Local: {{ $branch  }}</strong></h5>
        <h5><strong>Cajero: {{ auth()->user()->name }}</strong></h5>
        <h4>Gracias por su compra!</h4>
    </div>
    <p>----------------------------------------------------</p>
    <p style="font-size: 13px; text-align: center">DOCUMENTO NO VALIDO COMO FACTURA</p>
</div>
</body>
</html>


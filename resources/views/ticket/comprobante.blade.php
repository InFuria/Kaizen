<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style>
        body {
            font-family: DejaVu Sans, serif, sans-serif !important; }

        /*
        table {

            border-collapse: separate;
            border-spacing: 10px 5px;
        }
/*
        td.producto,
        th.producto {
            width: 75px;
            max-width: 75px;
        }

        td.cantidad,
        th.cantidad {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.precio,
        th.precio {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        .centrado {
            text-align: center;
            align-content: center;
            margin-left: 25px;
        }
*/
        .ticket {
            width: 283px;
            max-width: 280px;
        }
        .detail{
            text-align: left;
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
        <h4>Doña Rosa</h4>
        <h5 style="margin-left: -30px; margin-top: -15px">Empanadas Tucumanas</h5>

        <h5><strong>Nro Factura: {{ $invoice->id }}</strong></h5>
        <h5 style="margin-top: -10px"><strong>Fecha: {{ date( "d/m/Y", strtotime($invoice->created_at)) }} </strong> &nbsp; <strong>Hora: {{ date( "H:i:s", strtotime($invoice->created_at)) }}</strong></h5>

    </div>

    <table>
        <caption style="caption-side: top; margin-top: -20px; margin-bottom: -10px">===============================</caption>
        <caption style="caption-side: bottom; margin-top: 5px; margin-bottom: -10px">===============================</caption>
        <thead>
        <tr style="font-size: 17px">
            <td style="margin-right: -15px"><strong>Articulo</strong></td>
            <td><strong>Cant.</strong></td>
            <td><strong>Precio</strong></td>
            <td><strong>Sub Total</strong></td>
        </tr>
        </thead>
        <tbody>
        @foreach($product_detail['products'] as $product)
            <tr>
                <td>{{ $product['name']  }}</td>
                <td>{{ $product['quantity']  }}</td>
                <td>{{ $product['price']  }}</td>
                <td>{{ (integer) $product->quantity*(integer) $product->price  }}</td>
            </tr>
        @endforeach

        <tr class="detail">
            <th>Total: {{ $invoice->total }}</th>
        </tr>
        <tr class="detail">
            <th>Recibido: {{ $invoice->received }}</th>
        </tr>
        <tr class="detail">
            <th>Su Vuelto: {{ $change }}</th>
        </tr>
        </tbody>
    </table>
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

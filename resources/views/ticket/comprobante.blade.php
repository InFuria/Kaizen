<html>
<head>
    <style>
        /** {
            font-family: 'Times New Roman';
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

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
            width: 155px;
            max-width: 155px;
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
        <img src="../images/logo.png" style="width: 100px; margin-left: 45px;">
        {{--<h4>Doña Rosa</h4>
        <h5 style="margin-left: -30px; margin-top: -15px">Empanadas Tucumanas</h5>--}}

        <h6><strong>Telefono: </strong>+595 995 643-434</h6>
    </div>

    <table>
        <thead>
        <tr>
            <th>CANT</th>
            <th>PRODUCTO</th>
            <th>$$</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1.00</td>
            <td>CHEETOS VERDES 80 G</td>
            <td>$8.50</td>
        </tr>
        <tr>
            <td>2.00</td>
            <td>KINDER DELICE</td>
            <td>$10.00</td>
        </tr>
        <tr>
            <td>1.00</td>
            <td>COCA COLA 600 ML</td>
            <td>$10.00</td>
        </tr>

        <tr>
            <td></td>
            <td>TOTAL</td>
            <td>$28.50</td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>

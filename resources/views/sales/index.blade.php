@extends('layouts.app')

@section('title', 'Venta')

@section('content')
    <h2 class="">
        Registrar nueva venta <small class="text-black-50">( {{ $user->name }} )</small>
    </h2>

    <div class="card">
        <div class="card-body">
            <div>
                @if(!isset($client))
                    {!! Form::open(['route' => 'sales.index', 'method' => 'GET', 'id' => 'clientDetail']) !!}
                    @csrf
                    {!! Form::label('client', 'Cliente: ', ['class' => 'form-control-lg']) !!}
                    {!! Form::text('client', isset($client) ? $client->ci : null, ['class' => 'form-control btn-lg', 'placeholder' => 'Ingrese el CI del Cliente']) !!}

                    <button type="submit" class="btn btn-success btn-lg text-white mt-4">REGISTRAR</button>
                    <a type="button" href="{{ route('users.create') }}" class="btn btn-info btn-lg text-white mt-4">CREAR CLIENTE</a>

                    {!! Form::close() !!}
                @else
                    <label><strong>Cliente: </strong></label>
                    <input class="form-control btn-lg" style="width: 350px;" value="{{ $client->name }}" disabled>

                    <br>

                    <div class="row">
                        <div class="form-group col-2">
                            <label><strong>Tipo de Comprobante: </strong></label>
                            <select class="form-control" style="width: 150px" disabled>
                                <option value="init">...</option>
                                <option value="ticket">Ticket</option>
                                <option value="invoice">Factura</option>
                            </select>
                        </div>

                        <div class="form-group col-2">
                            <label><strong>Metodo de pago: </strong></label>
                            <select class="form-control" style="width: 150px" disabled>
                                <option value="init">...</option>
                                <option value="cash">Efectivo</option>
                                <option value="plastic">Tarjeta</option>
                            </select>
                        </div>

                        <div class="form-group col-2">
                            <label><strong>Codigo de Sucursal: </strong></label>
                            <input class="form-control" style="width: 350px;" value="{{ $branch->code }}" disabled>
                        </div>
                    </div>

                @endif
            </div>
        </div>
    </div>

    <br>

    @if(isset($client))
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'sales.store', 'method' => 'POST', 'id' => 'frmProducto']) !!}
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="form-group col-3">
                            <label><strong>Producto: </strong></label>
                            {!! Form::select('product', isset($products) ? $products : ['name' => '...'], null, ['class' => 'form-control btn-lg', 'id' => 'product']) !!}
                        </div>

                        <div class="form-group col-1">
                            <label><strong>Cantidad: </strong></label>
                            {!! Form::number('quantity', null, ['class' => 'form-control btn-lg', 'id' => 'quantity', 'min' => 1]) !!}
                        </div>

                        <div class="form-group" style="width: 120px;">
                            <label><strong>Precio: </strong></label>
                            {!! Form::text('price', null, ['class' => 'form-control btn-lg', 'id' => 'price', 'disabled' => 'disabled']) !!}
                        </div>

                        <div class="form-group col-1">
                            <label><strong>Stock: </strong></label>
                            {!! Form::number('stock', null, ['class' => 'form-control btn-lg', 'id' => 'stock', 'disabled' => 'disabled']) !!}
                        </div>

                        {!! Form::hidden('client', isset($client) ? $client : null) !!}

                        <div class="form-group col-5">
                            <button class="btn btn-success btn-lg" type="button" id="btnAdd" onclick="addProduct()"
                                    style="margin-top: 30px">Agregar
                            </button>
                            <a class="btn btn-warning btn-lg" href="{{ route('sales.index', ['client' => $client->ci]) }}" style="margin-top: 30px" onclick="{{ session(["products"=>[]]) }}">Limpiar</a>

                            <a class="btn btn-danger btn-lg" href="{{ route('sales.index') }}" style="margin-top: 30px" onclick="{{ session(["products"=>[]]) }}">Cancelar</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div>
                        <table class="table table-hover table-bordered" style="font-size: 17px">
                            <thead>
                            <tr>
                                <th scope="col">Articulo</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio Unitario</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody id="tblProducts">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="row">
                <div class="col-12 mt-3 mb-3">
                    <label class="form-control-lg">Total: </label>
                    <input class="form-control-lg" type="number" id="totalPrice" disabled>

                    <label class="form-control-lg">Recibido: </label>
                    <input class="form-control-lg" type="number" id="received">

                    <label class="form-control-lg">Vuelto: </label>
                    <input class="form-control-lg" type="number" id="change" disabled>

                    <button type="submit" class="btn btn-success btn-lg float-right">Procesar</button>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('js')
    <script>

        $('.table-hover').hide();

        $('#product').click(function () {
            var urls = 'sales';
            var dato = $('#product').val();

            $('#quantity').val(1);

            $.ajax({
                url: urls,
                type: 'GET',
                data: {id: dato},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json'
                },
                success: function (data) {
                    console.log(data);

                    $('#stock').val(data['quantity']); //quatity viene de la tabla stock
                    $('#price').val(data['price'] + ' Gs');
                },
                error: function () {
                    console.log('error');// solo ingresa a esta parte
                }
            });

        });

        function addProduct() {
            let product = $('#product').val();
            let price = $('#price').val();
            let quantity = $('#quantity').val();
            let token = $("#frmProducto input[name=_token]").val();

            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '/sales/addProduct',
                data: {
                    'product': product,
                    'price': price,
                    'quantity': quantity,
                    '_token': token
                }
            }).done(function (response) {
                if (response.data == 1) {
                    console.log('La cantidad ingresada supera al stock');
                } else {
                    console.log('La transaccion esta disponible');
                    getProducts();
                    $('#quantity').val(1);
                }
            })
        }

        function getProducts() {
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: '/sales/getProducts',
            }).done(function (response) {
                $('#tblProducts').empty();
                let suma = 0;
                $.each(response, function (i, e) {
                    let priceSub = parseInt(e.price)*parseInt(e.quantity);
                    suma += priceSub;

                    $('.table-hover').show();

                    $('#tblProducts').append("<tr id='" + e.id +"'><td>" + e.name + "</td><td>" + e.quantity + "</td><td>" + e.price + "</td><td>" + priceSub +
                        "</td><td><a class='btn btn-danger' onclick='removeProduct(" + e.id + ")'><i class=\"fas fa-times fa-1x text-white\"></i></a></td></tr>");
                });
                $('#totalPrice').val(suma);
            });
        }

        $('#received').on('keyup', function () {

            let received = $(this).val();
            let total =  $('#totalPrice').val();

            let calculated = received - total;

            $('#change').val(calculated);
        });

        function removeProduct(id){
            $('#' + id).remove();

            $.ajax({
                type: 'get',
                dataType: 'json',
                url: '/sales/removeProduct',
                data: {'id': id}
            }).done(function (response) {
                getProducts();
            });
        }

        getProducts();
    </script>
@append

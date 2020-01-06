@extends('layouts.app')

@section('title', 'Arqueo de Caja')

@section('content')
    <h2 class="">
        Arqueo de Caja
    </h2>

    <div class="card">
        <div class="card-body">

            <div id="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 border" id="sys">
                            <div class="card-header" style="margin-left: -16px; margin-top: -1px; margin-right: -18px">
                                <h4>SISTEMA</h4>
                            </div>
                            <div class="card-body" id="sys_info">
                                <div class="bg-light text-black-50 text-center border" id="message"
                                     style="font-size: 20px">
                                    <p>Por favor cargue los ingresos del turno para realizar la comparacion con los
                                        datos del sistema.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 border" id="fisic">
                            <div class="card-header" style="margin-left: -16px; margin-top: -1px; margin-right: -18px">
                                <h4>FISICO</h4>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['route' => ['till.audit', $till->id], 'method' => 'POST', 'id' => 'frmClose']) !!}
                                @csrf

                                <div class="form-group">
                                    {!! Form::label('declared_cash', 'Total en fisico (Guaraníes): ') !!}
                                    {!! Form::input('number', 'declared_cash', null, ['class' => 'form-control btn-lg', 'id' => 'product', 'placeholder' => 'Ingrese el total en caja', 'min' => 0]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('password', 'Contraseña: ') !!}
                                    {!! Form::password('password', ['class' => 'form-control btn-lg', 'placeholder' => 'Ingrese su contraseña para validar la operacion', 'required']) !!}
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning btn-block" form="frmClose" id="send"><a>INGRESAR ARQUEO</a>
                        </button>

                        <a href="{{ route('till.index') }}" class="btn btn-secondary btn-block">VOLVER</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#frmClose').submit(function (event) {
            event.preventDefault();
            var url = '/till/{!! $till->id !!}/audit';

            var newForm = '<div class="row">' +
                '<label class="form-control">Total en caja (Desde la última apertura): </label><input class="form-control-lg" value="" id="registered" disabled>' +
                '<label class="form-control mt-3">Total Ingresado por el cajero: </label><input class="form-control-lg mt-3" value="" id="declared" disabled>' +
                '<label class="form-control mt-3">Estado del Arqueo:</label><h4 class="rounded" id="cashStatus"></h4>' +
                '</div>';

            $.ajax({
                url: url,
                type: 'post',
                data: $('form').serialize(), // Remember that you need to have your csrf token included
                dataType: 'json',
            }).done(function (response) {

                $('div.alert strong').val(response.success);

                $('#message').remove();
                $('#fisic').remove();
                $('#sys').removeClass('col-6').addClass('col-12');
                $('#send').remove();

                var status = '';
                switch (response.status) {
                    case 'Normal':
                        status = 'bg-success p-3';
                        break;
                    case 'Faltante':
                        status = 'bg-danger p-3';
                        break;
                    case 'Sobrante':
                        status = 'bg-warning p-3';
                        break;
                }

                $('#sys_info').append(newForm);
                $('#cashStatus').addClass(status).text(response.status);
                $('#registered').val(response.audit.registered_cash);
                $('#declared').val(response.audit.declared_cash);
            });
        });
    </script>
@append

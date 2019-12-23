@extends('layouts.app')

@section('title', 'Venta')

@section('content')
    <h2 class="">
        Registro de Venta
    </h2>

    <div class="card">
        <div class="card-body">
            <div class="float-right col-5" style="border-left: solid black 1px; height: 110px">
                <button class="form-control text-white col-5 btn btn-info mr-5">PRODUCTOS DISPONIBLES</button>
            </div>

            <div>
                <label class="form-control-lg">Usuario</label>
                <input class="form-control-sm">
            </div>


            <div>
                <label class="form-control-lg">Cliente&nbsp;</label>
                <input class="form-control-sm" type="number" placeholder="Ingrese el CI del cliente">
                <button class="btn btn-success btn-sm text-white">REGISTRAR</button>
            </div>

            <hr>

            <div>
                <button class="btn btn btn-warning btn-sm">AGREGAR PRODUCTO</button>
                <button class="btn btn-secondary btn-sm">CANCELAR ORDEN</button>
            </div>

            {!! Form::open(['route' => 'sales.store', 'method' => 'POST']) !!}
                @include('sales.partials._form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('js')
    //agregar que el sidebar se esconda
@append

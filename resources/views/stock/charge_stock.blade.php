@extends('layouts.app')

@section('title', 'Stock')

@section('content')
    <h2 class="">
        Carga de Stock
    </h2>

    <div class="card">
        <div class="card-body">

            <div id="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'stock.store', 'method' => 'POST', 'id' => 'frmCash']) !!}
                    @csrf

                    <div class="form-group">
                        {!! Form::label('product', 'Productos') !!}
                        {!! Form::select('product', isset($products) ? $products : ['name' => '...'], null, ['class' => 'form-control btn-lg', 'id' => 'product']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('quantity', 'Cantidad: ') !!}
                        {!! Form::input('number', 'quantity', null, ['class' => 'form-control btn-lg', 'placeholder' => 'Ingrese el la cantidad del producto que desea ingresar', 'min' => 1]) !!}
                    </div>

                    <hr>

                    <div class="form-group">
                        {!! Form::label('password', 'Contraseña: ') !!}
                        {!! Form::password('password', ['class' => 'form-control btn-lg', 'placeholder' => 'Ingrese su contraseña para validar la operacion', 'required']) !!}
                    </div>

                    <button type="submit" class="btn btn-warning btn-block"><a>CARGAR</a></button>

                    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-block">VOLVER</a>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@append

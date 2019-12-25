@extends('layouts.app')

@section('title', 'Caja')

@section('content')
    <h2 class="">
        Extracto de Caja
    </h2>

    <div class="card">
        <div class="card-body">

            <div id="card">
                <div class="card-body">
                    {!! Form::model($till, ['route' => ['till.extraction', $till->id], 'method' => 'POST', 'id' => 'extractionForm']) !!}
                    @method('PATCH')
                    @csrf

                    <div class="form-group">
                        {!! Form::label('user', 'Usuario') !!}
                        {!! Form::select('user', $user, ['class' => 'form-control', 'id' => 'selectedUser']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('mount', 'Monto a retirar: ') !!}
                        {!! Form::input('number', 'mount', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el monto de dinero que quiere retirar (sin puntos ni simbolos)']) !!}
                    </div>

                    <hr>

                    <div class="form-group">
                        {!! Form::label('password', 'Contraseña: ') !!}
                        {!! Form::password('password', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su contraseña para validar la operacion', 'required']) !!}
                    </div>

                    <button type="submit" class="btn btn-warning btn-block"><a>RETIRAR</a></button>

                    <a href="{{ route('till.index') }}" class="btn btn-secondary btn-block">VOLVER</a>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')

@append

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
                        <div class="col-6 border">
                            <div class="card-header" style="margin-left: -16px; margin-top: -1px; margin-right: -18px">
                                <h4>SISTEMA</h4>
                            </div>
                            <div class="card-body">
                                <div class="bg-light text-black-50 text-center border" id="message" style="font-size: 20px">
                                    <p>Por favor cargue los ingresos del turno para realizar la comparacion con los datos del sistema.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 border">
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

                        <button type="submit" class="btn btn-warning btn-block" form="frmClose"><a>INGRESAR ARQUEO</a></button>

                        <a href="{{ route('till.index') }}" class="btn btn-secondary btn-block">VOLVER</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@append

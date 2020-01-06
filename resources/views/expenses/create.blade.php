@extends('layouts.app')

@section('title', 'Registro de Gasto')

@section('content')
    <h2 class="">
        Gestión de Gastos <small class="text-black-50 font-italic">Crear</small>
    </h2>

    <div class="card col-6">
        <div class="card-body">
            {!! Form::open(['route' => 'expenses.store', 'method' => 'POST']) !!}
            @include('expenses.partials._form', ['btnLabel' => 'REGISTRAR'])
            {!! Form::close() !!}
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong><br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

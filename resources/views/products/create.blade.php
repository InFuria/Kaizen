@extends('layouts.app')

@section('title', 'Creacion de Producto')

@section('content')
    <h2 class="">
        Gestión de Productos <small class="text-black-50 font-italic">Crear</small>
    </h2>

    <div class="card col-xl-6 col-lg-10">
        <div class="card-body">
            {!! Form::open(['route' => 'products.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            @include('products.partials._form', ['btnLabel' => 'REGISTRAR'])
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

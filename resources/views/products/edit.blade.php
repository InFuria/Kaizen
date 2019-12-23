@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
    <h2 class="">
        Gestión de Productos <small class="text-black-50 font-italic">Editar</small>
    </h2>

    <div class="card col-6">
        <div class="card-body">
            {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            @method('PATCH')

            @include('products.partials._form', ['btnLabel' => 'ACTUALIZAR'])
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

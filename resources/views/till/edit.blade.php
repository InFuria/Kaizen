@extends('layouts.app')

@section('title', 'Editar Caja')

@section('content')
    <h2 class="">
        Gestión de Caja <small class="text-black-50 font-italic">Editar</small>
    </h2>

    <div class="card col-xl-6 col-lg-10">
        <div class="card-body">
            {!! Form::model($user, ['route' => ['till.update', $user->id], 'method' => 'POST']) !!}
            @method('PATCH')

            @include('till.partials._form', ['btnLabel' => 'ACTUALIZAR'])
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

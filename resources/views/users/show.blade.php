@extends('layouts.app')

@section('title', 'Detalle de Usuario')

@section('content')
    <h2 class="">
        Gestión de Usuarios <small class="text-black-50 font-italic">Detalle</small>
    </h2>

    <div class="row">
        <div class="col-8">
            <div class="card bg-light">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <img src="https://i-love-png.com/images/user-ready-spotteron-citizen-science-43537.png" alt="" class="img-rounded img-responsive" style="width: 200px; height: 200px">
                        </div>
                        <div class="col-8 ml-1">
                            <h4>{{ $user->name }}
                                <small class="text-black-50 font-italic">
                                    (<cite title="address">{{ $user->username }}
                                        <i class="glyphicon glyphicon-map-marker"></i>
                                    </cite>)
                                </small>
                            </h4>
                            <p>
                                <label class="font-weight-bolder font-italic">Email: </label>
                                <i class="glyphicon glyphicon-envelope"></i>
                                &nbsp; {{ $user->email }}
                                <br>

                                <label class="font-weight-bolder font-italic">Telefono: </label>
                                <i class="glyphicon glyphicon-globe"></i>
                                &nbsp; {{ $user->phone }}
                                <br>

                                <label class="font-weight-bolder font-italic">Direccion: </label>
                                <i class="glyphicon glyphicon-globe"></i>
                                &nbsp; {{ $user->address }}
                                <br>

                                <label class="font-weight-bolder font-italic">Descripcion: </label>
                                <i class="glyphicon glyphicon-gift"></i>
                                &nbsp; {{ $user->description }}
                            </p>

                            @if($user->status == 1)
                                <label class="btn btn-success rounded" style="margin-top: -15px";>Habilitado</label>
                            @else
                                <label class="btn btn-danger rounded" style="margin-top: -15px";>Deshabilitado</label>
                            @endif
                            <br/>

                        @if(is_array($roles))
                                @foreach($roles as $role)
                                    <label class="btn btn-primary rounded mt-1" style="margin-top: -15px";>{{ $role }}</label>
                                @endforeach
                            @else
                                <label class="btn btn-primary rounded mt-1" style="margin-top: -15px";>{{ $roles }}</label>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            <a href="{{ route('users.index') }}" class="btn btn-secondary btn-block mt-2">VOLVER</a>
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

@extends('layouts.app')

@section('title', 'Detalle de Usuario')

@section('content')
    <h2 class="">
        Gestión de Productos <small class="text-black-50 font-italic">Detalle</small>
    </h2>

    <div class="row">
        <div class="col-8">
            <div class="card bg-light">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <img src="https://image.flaticon.com/icons/png/512/26/26393.png" alt="" class="img-rounded img-responsive" style="width: 200px; height: 200px">
                        </div>
                        <div class="col-8 ml-1">
                            <h4>{{ $product->name }}
                                <small class="text-black-50 font-italic">
                                    (<cite title="address">{{ $product->slug }}
                                        <i class="glyphicon glyphicon-map-marker"></i>
                                    </cite>)
                                </small>
                            </h4>
                            <p>
                                <label class="font-weight-bolder font-italic">Descripcion: </label>
                                <i class="glyphicon glyphicon-envelope"></i>
                                &nbsp; {{ $product->description }}
                                <br>

                                <label class="font-weight-bolder font-italic">Costo Base: </label>
                                <i class="glyphicon glyphicon-globe"></i>
                                &nbsp; {{ $product->cost }}
                                <br>

                                <label class="font-weight-bolder font-italic">Precio de venta: </label>
                                <i class="glyphicon glyphicon-globe"></i>
                                &nbsp; {{ $product->price }}
                                <br>

                                <label class="font-weight-bolder font-italic">Tipo de Producto: </label>
                                <i class="glyphicon glyphicon-gift"></i>
                                &nbsp; {{ $product->type }}
                            </p>
                        </div>
                    </div>

                </div>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-secondary btn-block mt-2">VOLVER</a>
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

@extends('layouts.app')

@section('title', 'Productos')

@section('content')
    <h2 class="">
        Listado de Stock <small>({{ $branch }})</small>
    </h2>

    @if(isset($stock) && count($stock) > 0)
        <div class="card mt-3">
            <div class="card-body pt-3 pb-0">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Identificador</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stock as $product)
                        <tr>
                            <td>{{ $product->slug  }}</td>
                            <td>{{ $product->name  }}</td>
                            <td>{{ $product->description  }}</td>
                            <td>{{ $product->quantity  }}</td>
                            <td>

                                <a type="button" class="btn btn-success fas fa-dolly-flatbed" title="Cargar Stock" href="{{ route('stock.charge') }}"></a>
                                <a type="button" class="btn btn-warning fas fa-wrench" title="Ajustes de Stock" href="{{ route('stock.adjustment') }}"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <hr>

        <div class="alert alert-danger mt-3">
            No se han encontrado resultados.
        </div>
    @endif
@endsection


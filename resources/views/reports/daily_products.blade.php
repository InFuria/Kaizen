@extends('layouts.app')

@section('title', 'Reportes')

@section('css')
    @media (min-width: 1920px){
    #contentBody {
    margin-left: -70px;
    }
    }

    @media (max-width: 1080px){
    #contentBody {
    margin-left: 50px;
    }
    }
@endsection

@section('content')
    <h2 class="">
        Productos vendidos por dia
    </h2>

    <div class="card">
        <div class="card-body border rounded bg-dark text-white p-1" id="search_form">
            {!! Form::open(['route' => 'reports.daily_products', 'method' => 'GET']) !!}
            @include('reports.partials._form', ['route' => 'reports.daily_products'])
            {!! Form::close() !!}
        </div>
    </div>

@if(isset($data) && ! empty($data)  && count($data) > 0)
    <div class="mt-4">
        <div class="card">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Sub Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->slug }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->sub }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="card mt-1">
        <div class="card-body">
            <div class="alert alert-danger m-0 float-left">
                No se han encontrado resultados.
            </div>
        </div>
    </div>
@endif
@endsection

@section('js')
    <script>
        $('#day').datepicker({
                format: "dd/mm/yyyy",
                language: "es",
                autoclose: true,
                todayHighlight: true

            }
        );
    </script>
@append

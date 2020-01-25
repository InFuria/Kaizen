@extends('layouts.app')

@section('title', 'Reportes')

@section('content')
    <h2 class="">
        Detalle de transacciones por sucursal
    </h2>

    <div class="card">
        <div class="card-body border rounded bg-dark text-white p-0">
            {!! Form::open(['route' => 'reports.tillHistory', 'method' => 'GET', 'id' => 'tillHistory']) !!}
            @include('reports.partials._range_form', ['route' => 'reports.tillHistory'])
            {!! Form::close() !!}
        </div>
    </div>

    @if(isset($results) && ! empty($results) && count($results) > 0)
        <div class="mt-4">
            <div class="card">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Usuario</th>
                        <th scope="col">Sucursal</th>
                        <th scope="col">Caja</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Caja pre-transaccion</th>
                        <th scope="col">Caja pos-transaccion</th>
                        <th scope="col">Fecha</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($results as $key => $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->branch }}</td>
                            <td>{{ $item->till_id }}</td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->cash_before_op }}</td>
                            <td>{{ $item->cash_after_op }}</td>
                            <td>{{ $item->created_at }}</td>
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
        $('#start').datepicker({
                format: "dd/mm/yyyy",
                language: "es",
                autoclose: true,
                todayHighlight: true
            }
        );

        $('#end').datepicker({
                format: "dd/mm/yyyy",
                language: "es",
                autoclose: true,
                todayHighlight: true
            }
        );
    </script>
@append

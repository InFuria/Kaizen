@extends('layouts.app')

@section('title', 'Reportes')

@section('content')
    <h2 class="">
        Detalle de ventas
    </h2>

    <div class="card">
        <div class="card-body border rounded bg-dark text-white p-0">
            {!! Form::open(['route' => 'reports.daily', 'method' => 'GET']) !!}
            @include('reports.partials._form', ['route' => 'reports.daily'])
            {!! Form::close() !!}
        </div>
    </div>

@if(isset($final) && ! empty($final) && count($final) > 0)
    <div class="mt-4">
        <div class="card">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Ventas</th>
                </tr>
                </thead>
                <tbody>
                @foreach($final as $key => $item)
                    <tr>
                        <td>
                            <div class="accordion" id="accordion{{ $item['invoice_id'] }}">
                                <div class="card">
                                    <button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapse{{ $item['invoice_id'] }}"
                                            aria-expanded="true" aria-controls="collapse{{ $item['invoice_id'] }}">
                                        <strong class="h5 text-black-50">Factura Nro: {{ $item['invoice_id'] }} | </strong><i class="text-black-50">({{ $item['created'] }})</i>
                                    </button>

                                    <div id="collapse{{ $item['invoice_id'] }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion{{ $item['invoice_id'] }}" style="margin-top: -25px">
                                        <div class="card-body" style="padding-bottom: 0">
                                            <strong class="h5 mb-2"><u>Cajero: {{ $item['name'] }}</u></strong><br class="mb-5">
                                            <strong>{{ $item['quantity'] }}</strong>
                                            {{ $item['product'] }}:
                                            {{ $item['sub_total'] }}
                                            <br>
                                            @if($item[0] != null)
                                                @foreach($item[0] as $key => $value)
                                                    <strong>{{ $value['quantity'] }}</strong>
                                                    {{ $value['product'] }}:
                                                    {{ $value['sub_total'] }}
                                                    <br>
                                                @endforeach
                                            @endif
                                            <hr>
                                            <strong class="h5">Total: {{ $item['total'] }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
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

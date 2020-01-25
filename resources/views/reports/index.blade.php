@extends('layouts.app')

@section('title', 'Reportes')

@section('content')
    <h2 class="">
        Reportes del Sistema
    </h2>

    <div class="card" style="height: 640px">
        <div class="card-body">

            <a href="{{ route('reports.daily_products') }}" class="card bg-light mb-3 col-12 text-black-50">
                <div class="row">
                    <div class="border text-center rounded" style="padding: 18px; width: 90px !important;"><i class="fas fa-calendar-check fa-3x"></i></div>
                    <div class="col-sm-10 col-xl-10 mt-4">
                        <h3 class="card-title">Productos vendidos por dia</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('reports.daily') }}" class="card bg-light mb-3 col-12 text-black-50">
                <div class="row">
                    <div class="border text-center rounded" style="padding: 18px; width: 90px !important;"><i class="fas fa-clipboard-list fa-3x"></i></div>
                    <div class="col-sm-10 col-xl-10 mt-4">
                        <h3 class="card-title">Detalle de ventas</h3>
                    </div>
                </div>
            </a>

            <a href="{{ route('reports.tillHistory') }}" class="card bg-light mb-3 col-12 text-black-50">
                <div class="row">
                    <div class="border text-center rounded" style="padding: 18px; width: 90px !important;"><i class="far fa-folder-open fa-3x"></i></div>
                    <div class="col-sm-10 col-xl-10 mt-4">
                        <h3 class="card-title">Historial de transacciones por sucursal</h3>
                    </div>
                </div>
            </a>

        </div>
    </div>
@endsection

@section('js')
    <script>
        /*$(document).ready(function () {
            $('#footer').addClass('fixed-bottom');
        });*/
    </script>
@append

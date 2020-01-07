@extends('layouts.app')

@section('title', 'Reportes')

@section('content')
    <h2 class="">
        Reportes del Sistema
    </h2>

    <div class="card" style="height: 640px">
        <div class="card-body d-flex align-items-stretch">
            {{--HORRIBLE--}}
            {{--<div class="card row col-sm-12 col-xl-12">

                <a href="{{ route('reports.daily') }}">
                    <div class="card-header text-center" style="color: black">
                        <i class="far fa-calendar-check fa-3x"></i>
                        <h4>VENTA DIARIA</h4>
                    </div>
                </a>

                <a style="color: black">
                    <div class="card-header text-center">
                        <i class="fas fa-tools fa-3x"></i>
                        <h4>PROXIMAMENTE MAS REPORTES!</h4>
                    </div>
                </a>

            </div>--}}
        </div>
    </div>
@endsection

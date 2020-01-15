@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <div>
        <p style="font-size: 30px">PROXIMAMENTE</p>
    </div>
@endsection

@section('js')
    <script>
        $('.dash').addClass('active');

        $(document).ready(function () {
            $('#footer').addClass('fixed-bottom');
        });
    </script>
@endsection

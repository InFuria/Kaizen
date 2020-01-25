@extends('layouts.app')

@section('title', 'Inicio')

@section('css')
    body {
        background: url({{ asset('images/logo.png') }}) center fixed no-repeat;
        background-size: 450px 350px;
    }
@endsection

@section('content')
    {{--<div>
        <img src="{{ asset('images/logo.png') }}" width="600px" height="500px">
    </div>--}}
@endsection

@section('js')
    <script>
        $('.dash').addClass('active');
    </script>
@endsection

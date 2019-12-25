@extends('layouts.app')

@section('title', 'Caja')

@section('content')
    <h2 class="">
        Gestion de Caja <small class="text-black-50">Aporte</small>
    </h2>

    <div class="card">
        <div class="card-body">
            <h4>Sucursal actual: <small><i>{{ $branch->name }} </i></small>@if(isset($selectedTill))<small class="text-black-50"><i>( Caja n° {{ $selectedTill->id }} )</i></small>@endif</h4>
            @if(isset($selectedTill) && $selectedTill->status == 0)
                <label class="bg-danger rounded">&nbsp;Cerrada&nbsp;</label>
            @else
                <label class="bg-success rounded">&nbsp;Abierta&nbsp;</label>
            @endif
            <hr>

            <div id="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
@endsection

@include('till.partials._confirmModal')

@section('js')
    <script>
        /*$('#confirmModal').on('show.bs.modal', function (event) {
            var button  = $(event.relatedTarget);
            var modal   = $(this);

            var id = button.data('id');
            var content = $('#status h4').text();
            var message = 'Este proceso actualizara el estado de la caja.';

            modal.find('#modal-message').text(message);
            modal.find('#myForm #till_id').val(id);
            modal.find('#myForm').attr('action', '/till/' + id + '/status');
        });

        $('#final-options').hide();

        $(document).ready(function () {
            @if(/*! isset($selectedTill)*/)
            $('#defaultModal').modal({
                show: true
            });
            @else
            $('#final-options').show();
            @endif
        });*/
    </script>
@append

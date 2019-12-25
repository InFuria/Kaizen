@extends('layouts.app')

@section('title', 'Caja')

<style>
    /*.fa-toggle-off {
        color: black;
    }*/
</style>

@section('content')
    <h2 class="">
        Gestion de Caja
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

            <div id="final-options" type="hidden">
                <div class="card row">
                    <a href="{{ route('till.status', ['till' => $selectedTill->id]) }}" id="status" data-toggle="modal" data-target="#confirmModal" data-id="{{ $selectedTill->id }}">
                        <div class="card-header">
                            @if(isset($selectedTill) && $selectedTill->status == 0)
                                <i class="fas fa-toggle-off fa-5x"></i>
                                <h4>Apertura de Caja</h4>
                            @else
                                <i class="fas fa-toggle-on fa-5x"></i>
                                <h4>Cierre de caja</h4>
                            @endif
                        </div>
                    </a>

                    <hr>

                    <a type="button" href="{{ route('till.extract', ['till' => $selectedTill->id]) }}" id="extraction">
                        <div class="card-header">
                            <i class="fas fa-hand-holding-usd fa-5x"></i>
                            <h4>Extracto de caja</h4>
                        </div>
                    </a>

                    <hr>

                    <a href="{{ route('till.charge') }}" id="deposit">
                        <div class="card-header">
                            <i class="fas fa-donate fa-5x"></i>
                            <h4>Aporte de caja</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('till.partials._confirmModal')

@section('js')
    <script>
        $('#confirmModal').on('show.bs.modal', function (event) {
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
            @if(! isset($selectedTill))
            $('#defaultModal').modal({
                show: true
            });
            @else
            $('#final-options').show();
            @endif
        });
    </script>
@append

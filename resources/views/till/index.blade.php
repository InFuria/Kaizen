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
            @if(isset($selectedTill))
            <div class="row">
                <div class="col-10 col-sm-9">
                    <h4>@if(isset($branch))<i>{{ $branch->name }} </i>@endif @if(isset($selectedTill))<small class="text-black-50 border"><i>( Caja n° {{ $selectedTill->id }} )</i></small>@endif</h4>
                    @if(isset($selectedTill) && $selectedTill->status == 0)
                        <label class="bg-danger rounded">&nbsp;Cerrada&nbsp;</label>
                    @else
                        <label class="bg-success rounded">&nbsp;Abierta&nbsp;</label>
                    @endif

                    <button type="submit" form="flush" class="btn btn-warning btn-sm border">Cambiar de Caja</button>

                    <form action="{{ route('till.index') }}" method="GET" id="flush" hidden>
                        @csrf
                        <input id="flush" name="flush" value="1">
                    </form>
                </div>

                <div class="card-header bg-info rounded col-sm-3">
                    <label>Saldo Actual: </label>
                    <h4><i class="fas fa-dollar-sign"></i> {{ number_format($selectedTill->actual_cash, 2, ",", ".") }} Gs.</h4>
                </div>
            </div>
            <hr>

            <div class="container" id="final-options">
                <div class="row">
                    <div class="card col-6 p-0">
                            <a href="{{ route('till.status', ['till' => $selectedTill->id]) }}" id="status" data-toggle="modal" data-target="#confirmModal" data-id="{{ $selectedTill->id }}">
                                <div class="card-header" id="statusOptions">
                                    @if(isset($selectedTill) && $selectedTill->status == 0)
                                        <i class="fas fa-toggle-off fa-4x"></i>
                                        <h4>Apertura de Caja</h4>
                                    @else
                                        <i class="fas fa-toggle-on fa-4x"></i>
                                        <h4>Cierre de caja</h4>
                                    @endif
                                </div>
                            </a>


                            <a href="{{ route('till.cashCount', ['till' => $selectedTill->id]) }}" id="count">
                                <div class="card-header">
                                    <i class="fas fa-balance-scale fa-4x"></i>
                                    <h4>Arqueo de Caja</h4>
                                </div>
                            </a>
                    </div>

                    <div class="card col-6 p-0">
                        <a href="{{ route('till.extract', ['till' => $selectedTill->id]) }}" id="extraction">
                            <div class="card-header">
                                <i class="fas fa-hand-holding-usd fa-4x"></i>
                                <h4>Extracto de caja</h4>
                            </div>
                        </a>


                        <a href="{{ route('till.charge', ['till' => $selectedTill->id]) }}" id="deposit">
                            <div class="card-header">
                                <i class="fas fa-donate fa-4x"></i>
                                <h4>Aporte de caja</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection

@include('till.partials._confirmModal')

@if(session('till') === null)
    @include('till.partials._selectTill')
@endif

@section('js')
    <script>
        @if(session('till') === null)
            $('#selectModal').modal('show');
        @endif

        $('#confirmModal').on('show.bs.modal', function (event) {
            var button  = $(event.relatedTarget);
            var modal   = $(this);

            var id = button.data('id');
            var content = $('#status h4').text();
            var message = 'Este proceso actualizara el estado de la caja.';

            modal.find('#modal-message').text(message);
            modal.find('#myForm #till_id').val(id);
            modal.find('#myForm').attr('action', '/till/' + id + '/status');

            /*if( $('#statusOptions i').hasClass('fas fa-toggle-off fa-5x')){
                $('#openCash').show();
            }*/
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

@csrf

<div class="row">
    <div class="form-group col-lg-4 col-xl-2 col-3 ml-3">
        <label for="day">Desde: </label>
        <div class="input-group date" {{--data-date-format="dd-mm-yyyy"--}}>
            {!! Form::text('start', isset($start) ? $start : date('d/m/Y'), ['class' => 'form-control datepicker', 'id' => 'start']) !!}

            <div class="input-group-addon bg-light rounded-right">
                <span class="fas fa-calendar-alt p-2 px-3 text-black-50"></span>
            </div>
        </div>
    </div>

    <div class="form-group col-lg-4 col-xl-2 col-3">
        <label for="day">Hasta: </label>
        <div class="input-group date" {{--data-date-format="dd-mm-yyyy"--}}>
            {!! Form::text('end', isset($end) ? $end : date('d/m/Y'), ['class' => 'form-control datepicker', 'id' => 'end']) !!}

            <div class="input-group-addon bg-light rounded-right">
                <span class="fas fa-calendar-alt p-2 px-3 text-black-50"></span>
            </div>
        </div>
    </div>

    <div class="form-group col-lg-3 col-xl-2 col-3 ml-xl-0 mr-sm-5">
        {!! Form::label('branch_id', 'Sucursal') !!}
        {!! Form::select('branch_id', isset($branches) ? $branches : ['name' => '...'], null, ['class' => 'form-control', 'id' => 'branches']) !!}
    </div>

    <div class="form-group col-2 col-xl-1 ml-xl-0 ml-sm-3 mt-sm-0">
        <br>
        <button type="submit" form="tillActions" class="btn btn-warning btn-block mt-2"><a>Buscar</a></button>
    </div>

    <div class="form-group col-2 col-xl-1">
        <br>
        <a href="{{ route($route) }}" class="btn btn-secondary btn-block mt-2">Volver</a>
    </div>
</div>

@csrf

<div class="row">
    <div class="form-group col-4 col-lg-4 col-xl-3 ml-3">
        <label for="day">Fecha: </label>
        <div class="input-group date" {{--data-date-format="dd-mm-yyyy"--}}>
            {!! Form::text('day', isset($day) ? $day : date('d/m/Y'), ['class' => 'form-control datepicker', 'id' => 'day']) !!}

            <div class="input-group-addon bg-light rounded-right">
                <span class="fas fa-calendar-alt p-2 px-3 text-black-50"></span>
            </div>
        </div>
    </div>

    <div class="form-group col-3 col-lg-3 col-xl-2">
        {!! Form::label('branch_id', 'Sucursal') !!}
        {!! Form::select('branch_id', isset($branches) ? $branches : ['name' => '...'], null, ['class' => 'form-control', 'id' => 'branches']) !!}
    </div>

    <div class="form-group col-2 col-lg-2 col-xl-2">
        <br>
        <button type="submit" class="btn btn-warning btn-block mt-2"><a>Buscar</a></button>
    </div>

    <div class="form-group col-2 col-lg-2 col-xl-2">
        <br>
        <a href="{{ route($route) }}" class="btn btn-secondary btn-block mt-2">Volver</a>
    </div>
</div>

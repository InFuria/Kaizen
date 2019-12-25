@csrf

<div class="form-group">
    {!! Form::label('branch_id', 'Sucursal') !!}
    {!! Form::number('branch_id', isset($till) ? $till->branch_id : null, ['class' => 'form-control', 'placeholder' => 'Ingrese el numero de sucursal']) !!}
</div>

<button type="submit" class="btn btn-warning btn-block"><a>{!! $btnLabel !!}</a></button>

<a href="{{ route('users.index') }}" class="btn btn-secondary btn-block">VOLVER</a>

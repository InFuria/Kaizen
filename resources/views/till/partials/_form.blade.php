@csrf

<div class="form-group">
    {!! Form::label('branch_id', 'Sucursal') !!}

    {!! Form::select('branch_id', isset($branches) ? $branches : ['name' => '...'], null, ['class' => 'form-control btn-lg', 'id' => 'branch_id']) !!}
</div>

<button type="submit" class="btn btn-warning btn-block"><a>{!! $btnLabel !!}</a></button>

<a href="{{ route('till.index') }}" class="btn btn-secondary btn-block">VOLVER</a>

@csrf

<div class="form-group">
    {!! Form::label('slug', 'Identificador') !!}
    {!! Form::text('slug', isset($role) ? $role->slug : null, ['class' => 'form-control', 'placeholder' => 'Ingrese el identificador del rol. (Ejemplo: cashier)']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', isset($role) ? $role->name : null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del rol']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descripcion del  Rol') !!}
    {!! Form::textarea('description', isset($role) ? $role->description : null, ['class' => 'form-control', 'rows' => '5']) !!}
</div>

<button type="submit" class="btn btn-warning btn-block"><a>{!! $btnLabel !!}</a></button>

<a href="{{ route('roles.index') }}" class="btn btn-secondary btn-block">VOLVER</a>

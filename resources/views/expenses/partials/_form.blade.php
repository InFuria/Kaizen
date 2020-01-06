@csrf

<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', isset($expenses) ? $expenses->name : null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del servicio en que se gasto']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descripcion') !!}
    {!! Form::text('description', isset($expenses) ? $expenses->description : null, ['class' => 'form-control', 'placeholder' => 'Ingrese una descripcion del gasto', 'type' => 'text']) !!}
</div>

<div class="form-group">
    {!! Form::label('cost', 'Costo') !!}
    {!! Form::number('cost', isset($expenses) ? $expenses->cost : null, ['class' => 'form-control', 'placeholder' => 'Ingrese el costo del gasto']) !!}
</div>

<div class="form-group">
    {!! Form::label('expenses_category', 'Categoria') !!}
    {!! Form::select('expenses_category', isset($categories) ? $categories : ['name' => '...'], null, ['class' => 'form-control btn-lg', 'id' => 'categories']) !!}
</div>

<button type="submit" class="btn btn-warning btn-block"><a>{!! $btnLabel !!}</a></button>

<a href="{{ action('TillController@index') }}" class="btn btn-secondary btn-block">VOLVER</a>

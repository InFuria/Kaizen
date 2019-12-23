@csrf

<div class="form-group">
    {!! Form::label('slug', 'Identificador') !!}
    {!! Form::text('slug', isset($product) ? $product->slug : null, ['class' => 'form-control', 'placeholder' => 'Ingrese el codigo identificador del producto']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', isset($product) ? $product->name : null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del producto']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descripcion') !!}
    {!! Form::text('description', isset($product) ? $product->description : null, ['class' => 'form-control', 'placeholder' => 'Ingrese una descripcion del producto', 'type' => 'text']) !!}
</div>

<div class="form-group">
    {!! Form::label('image', 'Imagen') !!}
    <br>
    {!! Form::file('image', isset($product) ? $product->image : null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('cost', 'Costo') !!}
    {!! Form::number('cost', isset($product) ? $product->cost : null, ['class' => 'form-control', 'placeholder' => 'Ingrese el costo base del producto']) !!}
</div>

<div class="form-group">
    {!! Form::label('price', 'Precio Final') !!}
    {!! Form::number('price', isset($product) ? $product->price : null, ['class' => 'form-control', 'placeholder' => 'Ingrese el precio final del producto']) !!}
</div>

<div class="form-group">
    {!! Form::label('type', 'Tipo de producto') !!}
    {!! Form::text('type', isset($product) ? $product->type : null, ['class' => 'form-control', 'placeholder' => 'Ingrese su contraseña']) !!}
</div>

<button type="submit" class="btn btn-warning btn-block"><a>{!! $btnLabel !!}</a></button>

<a href="{{ route('products.index') }}" class="btn btn-secondary btn-block">VOLVER</a>

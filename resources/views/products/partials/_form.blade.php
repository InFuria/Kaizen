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

<div class="form-group" hidden>
    {!! Form::label('image', 'Imagen') !!}
    <br>
    {!! Form::file('image', isset($product) ? $product->image : null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('price', 'Precio en Guaraníes') !!}
    {!! Form::number('price', isset($product) ? $product->price : null, ['class' => 'form-control', 'placeholder' => 'Ingrese el precio del producto en guaranies']) !!}
</div>

<div class="form-group">
    {!! Form::label('price_br', 'Precio en Reales') !!}
    {!! Form::number('price_br', isset($product) ? $product->price_br : null, ['class' => 'form-control', 'placeholder' => 'Ingrese el precio del producto en reales']) !!}
</div>

<div class="form-group">
    {!! Form::label('price_usd', 'Precio en Dolares') !!}
    {!! Form::number('price_usd', isset($product) ? $product->price_usd : null, ['class' => 'form-control', 'placeholder' => 'Ingrese precio del producto en dolares']) !!}
</div>

<div class="form-group">
    {!! Form::label('type', 'Tipo de producto') !!}
    {!! Form::text('type', isset($product) ? $product->type : null, ['class' => 'form-control', 'placeholder' => 'Ingrese su contraseña']) !!}
</div>

<button type="submit" class="btn btn-warning btn-block"><a>{!! $btnLabel !!}</a></button>

<a href="{{ route('products.index') }}" class="btn btn-secondary btn-block">VOLVER</a>

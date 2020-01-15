@csrf

<div class="form-group">
    {!! Form::label('ci', 'Cedula') !!}
    {!! Form::number('ci', isset($user) ? $user->ci : null, ['class' => 'form-control', 'placeholder' => 'Ingrese su cedula o documento de identidad']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', isset($user) ? $user->name : null, ['class' => 'form-control', 'placeholder' => 'Ingrese su nombre completo']) !!}
</div>

<div class="form-group">
    {!! Form::label('username', 'Nombre de Usuario') !!}
    {!! Form::text('username', isset($user) ? $user->username : null, ['class' => 'form-control', 'placeholder' => 'Ingrese su nombre de usuario para el sistema']) !!}
</div>

<div class="form-group">
    {!! Form::label('phone', 'Telefono') !!}
    {!! Form::text('phone', isset($user) ? $user->phone : null, ['class' => 'form-control', 'placeholder' => 'Ingrese su telefono personal']) !!}
</div>

<div class="form-group">
    {!! Form::label('address', 'Direccion') !!}
    {!! Form::text('address', isset($user) ? $user->address : null, ['class' => 'form-control', 'placeholder' => 'Ingrese su direccion']) !!}
</div>

<div class="form-group">
    {!! Form::label('branch_id', 'Sucursal') !!}
    {!! Form::select('branch_id', isset($branches) ? $branches : ['name' => '...'], null, ['class' => 'form-control', 'id' => 'branch_id']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email', isset($user) ? $user->email : null, ['class' => 'form-control', 'placeholder' => 'Ingrese su correo electronico']) !!}
</div>

<div class="form-group">
    {!! Form::label('password', 'Contraseña') !!}
    {!! Form::input('password', 'password', isset($user) ? $user->password : null, ['class' => 'form-control', 'placeholder' => 'Ingrese su contraseña']) !!}
</div>

<div class="form-group">
    {!! Form::label('password_confirmation', 'Validacion de Contraseña') !!}
    {!! Form::input('password', 'password_confirmation', isset($user) ? $user->password : null, ['class' => 'form-control', 'placeholder' => 'Ingrese su contraseña nuevamente']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descripcion de usuario') !!}
    {!! Form::textarea('description', isset($user) ? $user->description : null, ['class' => 'form-control', 'rows' => '5']) !!}
</div>

<button type="submit" class="btn btn-warning btn-block"><a>{!! $btnLabel !!}</a></button>

<a href="{{ route('users.index') }}" class="btn btn-secondary btn-block">VOLVER</a>

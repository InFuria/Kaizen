@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
    <h2 class="">
        Gestión de Usuarios
    </h2>

    <div class="card">
        <div class="card-header" style="background-color: moccasin">
            <h5>Panel de Control</h5>
        </div>

        <div class="card-body">
            <a href="{{ route('users.create') }}" class="btn btn-success">Crear Usuario</a>
        </div>
    </div>

    @if(isset($users) && count($users) > 0)
        <div class="card mt-3">
            <div class="card-body pt-3 pb-0">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Ci</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Email</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Ultima Modificacion</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->ci  }}</td>
                        <td>{{ $user->name  }}</td>
                        <td>{{ $user->phone  }}</td>
                        <td>{{ $user->address  }}</td>
                        <td>{{ $user->email  }}</td>
                        <td>
                            @if($user->status == 1)
                                <label class="btn btn-success btn-sm rounded">Habilitado</label>
                            @else
                                <label class="btn btn-danger btn-sm rounded">Deshabilitado</label>
                            @endif
                        </td>
                        <td>{{ $user->updated_at  }}</td>
                        <td>
                            <a type="button" class="btn btn-light fas fa-user-circle" title="Ver detalles de usuario" href="{{ route('users.show', ['user' => $user->id]) }}"></a>
                            <a type="button" class="btn btn-success fas fa-user-edit" title="Editar usuario" href="{{ route('users.edit', ['user' => $user->id]) }}"></a>
                            <a type="button" class="btn btn-danger fas fa-user-times" title="Eliminar usuario"></a>

                            @if($user->status == 1)
                                <a type="button" class="btn btn-warning fas fa-user-alt-slash" id="btnBan"
                                   title="Deshabilitar usuario"
                                   data-type="deshabilitar"
                                   data-toggle="modal"
                                   data-target="#defaultModal"
                                   data-id="{!! $user->id !!}"
                                   data-username="{!! $user->username !!}"
                                >
                                </a>
                            @else
                                <a type="button" class="btn btn-success fas fa-user-alt-slash" id="btnBan"
                                   title="Habilitar usuario"
                                   data-type="habilitar"
                                   data-toggle="modal"
                                   data-target="#defaultModal"
                                   data-id="{!! $user->id !!}"
                                   data-username="{!! $user->username !!}"
                                >
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="alert alert-danger mt-3">
            No se han encontrado resultados.
        </div>
    @endif
@endsection

@include('users.partials._defaultModal')

@section('js')
    <script>
        $('#defaultModal').on('show.bs.modal', function (event) {
            var button  = $(event.relatedTarget); // Button that triggered the modal
            var modal   = $(this);
            var title   = button.attr('title');
            var type    = button.data('type');
            var user  = button.data('id');
            var username  = button.data('username');
            var message = 'Esta seguro que desea ' + type + ' al usuario ' + username + '?';

            var btnType = type.substring( 0, 1 ).toUpperCase();
            btnType = btnType + type.substring(1);

            modal.find('.modal-title').text(title);
            modal.find('#modal-message').text(message);
            modal.find('#confirm').text(btnType).addClass(type === 'habilitar' ? 'btn-success' : 'btn-danger');
            modal.find('#myForm').attr('action', '/users/' + user + '/ban');
        });
    </script>
@append

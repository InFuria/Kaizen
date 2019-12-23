@extends('layouts.app')

@section('title', 'Roles')

@section('content')
    <h2 class="">
        Gestión de Roles
    </h2>

    <div class="card">
        <div class="card-header" style="background-color: moccasin">
            <h5>Panel de Control</h5>
        </div>

        <div class="card-body">
            <a href="{{ route('roles.create') }}" class="btn btn-success">Crear un Rol</a>
        </div>
    </div>

    @if(isset($roles) && count($roles) > 0)
        <div class="card mt-3">
            <div class="card-body pt-3 pb-0">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Identificador</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Ultima Modificacion</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name  }}</td>
                            <td>{{ $role->slug  }}</td>
                            <td>{{ $role->description  }}</td>
                            <td>{{ $role->updated_at  }}</td>
                            <td>
                                {{--<a type="button" class="btn btn-light fas fa-user-circle" title="Ver detalles del Rol" href="{{ route('roles.show', ['role' => $role->id]) }}"></a>--}}
                                <a type="button" class="btn btn-success fas fa-edit" title="Editar Rol" href="{{ route('roles.edit', ['role' => $role->id]) }}"></a>
                                {{--<a type="button" class="btn btn-danger fas fa-user-times" title="Eliminar Rol"></a>--}}
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

{{--@include('users.partials._defaultModal')

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
@append--}}

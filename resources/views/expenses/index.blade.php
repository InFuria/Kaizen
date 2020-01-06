@extends('layouts.app')

@section('title', 'Gastos')

@section('content')
    <h2 class="">
        Gestion de Gastos
    </h2>

    <div class="card">
        <div class="card-header" style="background-color: moccasin">
            <h5>Panel de Control</h5>
        </div>

        <div class="card-body">
            <a href="{{ route('expenses.create') }}" class="btn btn-success">Ingresar Gasto</a>
        </div>
    </div>

    @if(isset($expenses) && count($expenses) > 0)
        <div class="card mt-3">
            <div class="card-body pt-3 pb-0">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Sucursal</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Costo</th>
                        <th scope="col">Categoria</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($expenses as $exp)
                        <tr>
                            <td>{{ $exp->branch }}</td>
                            <td>{{ $exp->description  }}</td>
                            <td>{{ $exp->cost  }}</td>
                            <td>{{ $exp->category  }}</td>
                            {{--<td>
                                <a type="button" class="btn btn-light fas fa-info-circle" title="Ver detalles del producto" href="{{ route('products.show', ['product' => $product->id]) }}"></a>
                                <a type="button" class="btn btn-success fas fa-pen-square" title="Editar producto" href="{{ route('products.edit', ['product' => $product->id]) }}"></a>
                                <a type="button" class="btn btn-danger fas fa-trash" id="btnDelete"
                                   title="Eliminar producto"
                                   data-toggle="modal"
                                   data-target="#defaultModal"
                                   data-product="{!! $product->id !!}"
                                   data-name="{!! $product->name !!}"
                                >
                                </a>
                            </td>--}}
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

{{--@include('products.partials._defaultModal')

@section('js')
    <script>
        $('#defaultModal').on('show.bs.modal', function (event) {
            var button  = $(event.relatedTarget);
            var modal   = $(this);
            var title   = button.attr('title');
            var product  = button.data('product');
            var name  = button.data('name');
            var message = 'Esta seguro que desea eliminar el producto ' + name + '?';

            modal.find('.modal-title').text(title);
            modal.find('#modal-message').text(message);
            modal.find('#myForm').attr('action', '/products/' + product);
        });
    </script>
@append--}}

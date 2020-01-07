@extends('layouts.app')

@section('title', 'Productos')

@section('content')
    <h2 class="">
        Gestion de Productos
    </h2>

    <div class="card">
        <div class="card-header" style="background-color: moccasin">
            <h5>Panel de Control</h5>
        </div>

        <div class="card-body">
            <a href="{{ route('products.create') }}" class="btn btn-success">Crear Producto</a>
        </div>
    </div>

    @if(isset($products) && count($products) > 0)
        <div class="card mt-3">
            <div class="card-body pt-3 pb-0">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Identificador</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Precio Guaranies</th>
                        <th scope="col">Precio Reales</th>
                        <th scope="col">Precio Dolares</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->slug  }}</td>
                            <td>{{ $product->name  }}</td>
                            <td>{{ $product->description  }}</td>
                            <td>{{ $product->price  }}</td>
                            {{--<td>{{ $product->price_br  }}</td>
                            <td>{{ $product->price_usd  }}</td>--}}
                            <td>{{ ucfirst($product->category)  }}</td>
                            <td>
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

@include('products.partials._defaultModal')

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
@append

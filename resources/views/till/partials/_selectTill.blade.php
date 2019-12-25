<div id="defaultModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title"></h3>
            </div>
            <div class="modal-body">
                <h4>Ingrese el ID de la caja que desea operar: </h4>
                <form action="{{ route('till.index') }}" method="POST" id="myForm">
                    @csrf
                    <select id="select-till" name="till" class="form-control" placeholder="Seleccione una caja" required>
                        <option id="init" value="">...</option>
                        @foreach($till as $item)
                            <option value="{{$item->id}}">{{$item->id }}</option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="modal-footer">
                <button type="submit" form="myForm" id="confirm" class="btn btn-success">Seleccionar</button>
                <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

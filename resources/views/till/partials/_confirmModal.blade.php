<div id="confirmModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title"></h3>
            </div>
            <div class="modal-body">
                <h4>Gestion de cajero</h4>
                <form action="" method="POST" id="myForm">
                    @csrf
                    <h5 id="modal-message"></h5>
                    <input id="till_id" name="id" type="hidden" value="">

                    <hr>
                    <label class="form-group">Ingrese un monto de apertura: </label>
                    <input class="form-control" name="op_cash" type="number" required>

                    <br>

                    <label class="form-group" id="passLbl">Ingrese su contraseña: </label>
                    <input class="form-control" name="password" type="password">
                </form>
            </div>

            <div class="modal-footer">
                <button type="submit" form="myForm" id="confirm" class="btn btn-success">Confirmar</button>
                <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

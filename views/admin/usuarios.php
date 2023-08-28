<h1 class="text-center">Administración de usuarios</h1>
<div class="row">
    <div class="col table-responsive">
        <table id="tablaUsuarios" class="table table-bordered table-hover">

        </table>
    </div>
</div>

<div class="modal fade" id="modalPassword" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="tituloModalPassword" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModalPassword">Modificar Contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id='formPassword'>
                    <input type="hidden" name="usu_id" id='usu_id'>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="usu_password">Contraseña</label>
                            <input type="password" name="usu_password" id="usu_password" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="usu_password2">Confirmar contraseña</label>
                            <input type="password" name="usu_password2" id="usu_password2" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" form="formPassword" class="btn btn-warning">Modificar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= asset('./build/js/admin/usuarios.js') ?>"></script>
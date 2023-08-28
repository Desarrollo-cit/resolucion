<h1 class="text-center">Registro de usuarios</h1>
<div class="row justify-content-center">
    <form class="col-lg-4 border rounded bg-light px-3 py-4">
        <div class="row mb-3">
            <div class="col">
                <label for="usu_catalogo">Catálogo del usuario</label>
                <input type="text" name="usu_catalogo" id="usu_catalogo" class="form-control">
            </div>
        </div>
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
        <div class="row">
            <div class="col">
                <button class="btn btn-primary w-100">Registrarse</button>
            </div>
        </div>
    </form>
</div>
<script src="<?= asset('./build/js/registro/index.js') ?>"></script>
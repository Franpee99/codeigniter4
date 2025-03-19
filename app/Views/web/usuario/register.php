<?= $this->extend('Layouts/web') ?>

<?= $this->section('contenido') ?>


<div>
    <h1>Registrate!</h1>

    <?= view('partials/_form_error') ?>

    <form action="<?= route_to('usuario.register_post') ?>" method="post">
        <div>
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" required>
        </div>
        <div>
            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" required>
        </div>
        <br>
        <button type="submit">Registrar</button>
    </form>
</div>


<?= $this->endSection() ?>

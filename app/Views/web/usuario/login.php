<?= $this->extend('Layouts/web') ?>

<?= $this->section('contenido') ?>


<div>
    <h1>Iniciar sesión</h1>

    <?= view('partials/_form_error') ?>

    <form action="<?= route_to('usuario.login_post') ?>" method="post">
        <div>
            <label for="email">Email o usuario</label>
            <input type="text" id="email" name="email" required>
        </div>
        <div>
            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" required>
        </div>
        <br>
        <button type="submit">Iniciar sesión</button>
    </form>
</div>


<?= $this->endSection() ?>

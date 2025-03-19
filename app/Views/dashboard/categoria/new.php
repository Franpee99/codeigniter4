<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('contenido') ?>

    <?= view('partials/_session') ?>

    <form action="/dashboard/categoria/create" method="post">
        <?= view('/dashboard/categoria/_form', ['op' => 'Crear']) ?>
    </form>
</body>

<?= $this->endSection() ?>

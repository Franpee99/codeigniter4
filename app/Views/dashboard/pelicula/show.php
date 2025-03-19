<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('contenido') ?>

    <h1><?= $pelicula->titulo ?></h1>
    <h2><?= $pelicula->descripcion ?></h2>

<?= $this->endSection() ?>

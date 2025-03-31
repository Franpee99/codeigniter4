<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('contenido') ?>

    <h1><?= $pelicula->titulo ?></h1>
    <h2><?= $pelicula->descripcion ?></h2>


    <ul>
        <?php foreach ($imagenes as $i) : ?>
            <li><? $i->imagen ?></li>
        <?php  endforeach?>
    </ul>

<?= $this->endSection() ?>

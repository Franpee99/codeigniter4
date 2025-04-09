<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('contenido') ?>

    <h1><?= $pelicula->titulo ?></h1>
    <h2><?= $pelicula->descripcion ?></h2>

    <h3>Imagenes</h3>
    <ul>
        <?php foreach ($imagenes as $i) : ?>
            <li><? $i->imagen ?></li>
        <?php  endforeach?>
    </ul>

    <h3>Etiquetas</h3>
    <?php foreach ($etiquetas as $e) : ?>
        <form action="<?= base_url("dashboard/pelicula/etiqueta_delete/" . $pelicula->id . "/" . $e->id) ?>" method="post">
            <?= csrf_field() ?>
            <button type="submit"><?= $e->titulo ?></button>
        </form>
    <?php endforeach ?>

<?= $this->endSection() ?>

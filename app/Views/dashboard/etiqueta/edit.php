<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('titulo') ?><?= $titulo ?><?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1><?= $titulo ?></h1>
</div>

<form action="<?= base_url('Dashboard/Etiqueta/update/' . $etiqueta->id) ?>" method="POST">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" value="<?= old('titulo', $etiqueta->titulo) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="<?= base_url('Dashboard/Etiqueta') ?>" class="btn btn-secondary">Cancelar</a>
</form>
<?= $this->endSection() ?>

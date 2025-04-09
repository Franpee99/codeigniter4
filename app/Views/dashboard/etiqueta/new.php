<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('titulo') ?><?= $titulo ?><?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1><?= $titulo ?></h1>
</div>

<form action="<?= base_url('Dashboard/Etiqueta/create') ?>" method="POST">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" value="<?= old('titulo') ?>" required>
    </div>

    <div class="mb-3">
        <label for="categoria_id" class="form-label">Categoría</label>
        <select class="form-select" id="categoria_id" name="categoria_id" required>
            <option value="">Seleccione una categoría</option>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria->id ?>" <?= old('categoria_id') == $categoria->id ? 'selected' : '' ?>>
                    <?= $categoria->titulo ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="<?= base_url('Dashboard/Etiqueta') ?>" class="btn btn-secondary">Cancelar</a>
</form>

<?= $this->endSection() ?>

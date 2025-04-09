<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('titulo') ?><?= $titulo ?><?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1><?= $titulo ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('Dashboard/Etiqueta/new') ?>" class="btn btn-sm btn-outline-primary">
            Crear Etiqueta
        </a>
    </div>
</div>

<?php if (session()->getFlashdata('mensaje')): ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('mensaje') ?>
    </div>
<?php endif; ?>

<div class="table-responsive">
    <table id="tablaEtiquetas" class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etiquetas as $etiqueta): ?>
                <tr>
                    <td><?= $etiqueta->id ?></td>
                    <td><?= $etiqueta->titulo ?></td>
                    <td><?= $etiqueta->categoria_titulo ?></td>
                    <td>
                        <a href="<?= base_url('Dashboard/Etiqueta/edit/' . $etiqueta->id) ?>" class="btn btn-sm btn-warning">Editar</a>
                        <form class="form-eliminar" data-id="<?= $etiqueta->id ?>" method="post">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables CSS y JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            const tabla = $('#tablaEtiquetas').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
                }
            });

            // Interceptar el submit del form de eliminación
            $('.form-eliminar').on('submit', function (e) {
                e.preventDefault();

                const form = $(this);
                const id = form.data('id');


                $.ajax({
                    url: `/dashboard/etiqueta/delete/${id}`,
                    method: 'POST',
                    data: {
                        '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                    },
                    success: function () {
                        const row = form.closest('tr');
                        tabla.row(row).remove().draw();
                    }
                });
            });
        });
    </script>
<?= $this->endSection() ?>

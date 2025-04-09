<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('contenido') ?>

<?= $this->section('header') ?>
    Listado de peliculas
<?= $this->endSection() ?>

<a href="/dashboard/pelicula/new">Crear</a>

<table id="tablaPeliculas" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Categoría</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($peliculas as $pelicula): ?>
            <tr>
                <td><?= $pelicula->id ?></td>
                <td><?= $pelicula->titulo ?></td>
                <td><?= $pelicula->categoria ?></td>
                <td><?= $pelicula->descripcion ?></td>
                <td>
                    <a href="/dashboard/pelicula/show/<?= $pelicula->id ?>">show</a>
                    <a href="/dashboard/pelicula/edit/<?= $pelicula->id ?>">Editar</a>
                    <a href="/dashboard/pelicula/etiquetas/<?= $pelicula->id ?>">Tag</a>

                    <form class="form-eliminar" data-id="<?= $pelicula->id ?>" method="post">
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables CSS y JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            const tabla = $('#tablaPeliculas').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
                }
            });

            // Interceptar el submit del form de eliminación
            $('.form-eliminar').on('submit', function (e) {
                e.preventDefault(); // Evita el envío normal

                const form = $(this);
                const id = form.data('id');


                $.ajax({
                    url: `/dashboard/pelicula/delete/${id}`,
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

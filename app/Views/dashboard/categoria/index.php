<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('header') ?>
    Listado de categorias
<?= $this->endSection() ?>


<?= $this->section('contenido') ?>

    <a href="/dashboard/categoria/new">Crear</a>

    <table id="tablaCategorias" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria): ?>
                <tr>
                    <td><?php echo $categoria->id; ?></td>
                    <td><?php echo $categoria->titulo; ?></td>
                    <td>
                        <a href="/dashboard/categoria/show/<?= $categoria->id ?>">show</a>
                        <a href="/dashboard/categoria/edit/<?= $categoria->id ?>">Editar</a>

                        <form class="form-eliminar" data-id="<?= $categoria->id ?>" method="post">
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
        let tabla;

        $(document).ready(function() {
            tabla = $('#tablaCategorias').DataTable({
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
                    url: `/dashboard/categoria/delete/${id}`,
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

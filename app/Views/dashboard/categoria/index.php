<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('header') ?>
    Listado de categorias
<?= $this->endSection() ?>


<?= $this->section('contenido') ?>

    <a href="/dashboard/categoria/new">Crear</a>

    <table border="1">
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

                        <form action="/dashboard/categoria/delete/<?= $categoria->id ?>" method="post">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?= $this->endSection() ?>

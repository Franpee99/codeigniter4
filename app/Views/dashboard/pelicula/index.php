<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peliculas</title>
</head>
<body>
    <h1>Listado</h1>

    <?= view('partials/_session') ?>

    <a href="/dashboard/pelicula/new">Crear</a>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($peliculas as $pelicula): ?>
                <tr>
                    <td><?php echo $pelicula['id']; ?></td>
                    <td><?php echo $pelicula['titulo']; ?></td>
                    <td><?php echo $pelicula['descripcion']; ?></td>
                    <td>
                        <a href="/dashboard/pelicula/show/<?= $pelicula['id'] ?>">show</a>
                        <a href="/dashboard/pelicula/edit/<?= $pelicula['id'] ?>">Editar</a>

                        <form action="/dashboard/pelicula/delete/<?= $pelicula['id']  ?>" method="post">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

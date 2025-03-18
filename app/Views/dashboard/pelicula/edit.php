<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar pelicula</title>
</head>
<body>

    <?= view('partials/_session') ?>

    <form action="/dashboard/pelicula/update/<?= $pelicula['id'] ?>" method="post">
        <?= view('/dashboard/pelicula/_form', ['op' => 'Actualizar']) ?>
    </form>
</body>
</html>

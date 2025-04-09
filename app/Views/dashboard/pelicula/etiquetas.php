<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('contenido') ?>

<form action="<?= base_url("dashboard/pelicula/etiquetas_post/" . $pelicula->id) ?>" method="post">
    <?= csrf_field() ?>


        <label for="">Categorías</label>
        <select name="categoria_id" id="categoria_id">
                <option value=""></option>
                <?php foreach ($categorias as $c) : ?>
                        <option value="<?= $c->id ?>" <?= (isset($_GET['categoria_id']) && $_GET['categoria_id'] == $c->id) ? 'selected' : '' ?>>
                                <?= $c->titulo ?>
                        </option>
                <?php endforeach ?>
        </select>

        <label for="">Etiquetas</label>
        <select name="etiqueta_id" id="etiqueta_id">
                <option value=""></option>
                <?php foreach ($etiquetas as $e) : ?>
                        <option value="<?= $e->id ?>"><?= $e->titulo ?></option>
                <?php endforeach ?>
        </select>

        <button type="submit">Enviar</button>

        <script>
                function disableButton() {
                                const submitButton = document.querySelector('button[type=submit]');
                                const etiquetaSelect = document.querySelector('[name=etiqueta_id]');
                                etiquetaSelect.addEventListener('change', function() {
                                                submitButton.disabled = !etiquetaSelect.value;
                                });
                                submitButton.disabled = !etiquetaSelect.value;
                }

                document.querySelector('[name=categoria_id]').addEventListener('change', function() {
                                window.location.href = '<?= route_to('pelicula.etiquetas', $pelicula->id) ?>?categoria_id=' + this.value;
                });

                disableButton();
        </script>
</form>
<?= $this->endSection() ?>

<label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?= old('titulo', $pelicula['titulo']) ?>"><br><br>
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" id="descripcion">
            <?= old('descripcion', $pelicula['descripcion']) ?>
        </textarea><br><br>
        <button type="submit"><?= $op ?></button>

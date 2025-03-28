<label for="titulo">Título:</label>
<input type="text" id="titulo" name="titulo" value="<?= old('titulo', $pelicula->titulo) ?>"><br><br>

<label for="categoria_id">Categoria</label>

<select name="categoria_id" id="categoria_id">
        <option value=""></option>
        <?php foreach ($categorias as $c) : ?>
                <option <?= $c->id == old('categoria_id', $pelicula->categoria_id) ?: 'selected' ?> value="<?= $c->id ?>"><?= $c->titulo ?></option>
        <?php endforeach ?>
</select>

<label for="descripcion">Descripción</label>
        <textarea name="descripcion" id="descripcion">
            <?= old('descripcion', $pelicula->descripcion) ?>
        </textarea><br><br>
<button type="submit"><?= $op ?></button>

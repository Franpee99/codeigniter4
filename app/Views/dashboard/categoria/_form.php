<label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?= old('titulo', $categoria['titulo']) ?>"><br><br>
                                                                <!-- old -> coge el valor que pone el usuario al intentar crear/editar el formulario
                                                                     $categoria['titulo'] -> en caso de no haber un old coge el valor por defecto de la BD que tuviera -->
        <button type="submit"><?= $op ?></button>

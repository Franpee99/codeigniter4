<?php

namespace App\Models;

use CodeIgniter\Model;

class ImagenModel extends Model
{
    protected $table            = 'imagenes';
    protected $primaryKey       = 'id';
    protected $returnType = 'object';

    protected $allowedFields    = ['imagen', 'extension', 'data'];

    // Funcion de prueba relacion mucho a mucho pelicula - imagen
    public function getPeliculasById($id){
        return $this->select("p.*")
            ->join('pelicula_imagen as pi', 'pi.pelicula_id = imagenes.id')
            ->join('peliculas as p', 'p.id = pi.pelicula_id')
            ->where('imagenes.id', $id)
            ->findAll();
    }
}

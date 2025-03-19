<?php
namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;

class Pelicula extends ResourceController{

    protected $modelName = 'App\Models\PeliculaModel';
    protected $format = 'json';

    public function index(){
        return $this->respond($this->model->findAll());
    }

}

<?php
namespace App\Controllers\Api;

use App\Models\PeliculaModel;
use CodeIgniter\RESTful\ResourceController;

class Pelicula extends ResourceController{

    protected $modelName = 'App\Models\PeliculaModel';
    protected $format = 'json';

    public function index(){
        return $this->respond($this->model->findAll());
    }

    public function show($id = null){
        return $this->respond($this->model->find($id));
    }

    public function create(){

        if($this->validate('peliculas')){
            $id = $this->model->insert([
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion'),
            ]);

        } else {
           return $this->respond($this->validator->getErrors(), 400);
        }

        return $this->respond($id);
    }

    public function update($id = null){

        if($this->validate('peliculas')){
            $this->model->update($id, [
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion'),
            ]);

        } else {
            return $this->respond($this->validator->getErrors(), 400);
        }

        return $this->respond($id);
    }

    public function delete($id = null){

        $this->model->delete($id);

        return $this->respond('ok');
    }

}

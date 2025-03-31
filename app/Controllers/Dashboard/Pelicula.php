<?php

namespace App\Controllers\Dashboard;
use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\PeliculaModel;

class Pelicula extends BaseController
{

    public function test($id){
        echo 'hola'.' '.$id;
    }

    public function index()
    {
        $peliculaModel = new PeliculaModel();

        $data = [
            'peliculas' => $peliculaModel->select('peliculas.*, categorias.titulo as categoria')->join('categorias', 'categorias.id = peliculas.categoria_id')->find()
        ];

        return view('/dashboard/pelicula/index', $data);
    }

    public function new(){

        $categoriaModel = new CategoriaModel();

        echo view('/dashboard/pelicula/new',[
            'pelicula' => new PeliculaModel(),
            'categorias' => $categoriaModel->find()
        ]);
    }

    public function create(){
        $peliculaModel = new PeliculaModel();

        if($this->validate('peliculas')){
            $peliculaModel->insert([
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion'),
                'categoria_id' => $this->request->getPost('categoria_id'),
            ]);

        } else {
            session()->setFlashdata([
                'validacion' => $this->validator //validator trabaja conjunto validate de arriba
            ]);

            return redirect()->back()->withInput();
        }

        return redirect()->to('/dashboard/pelicula')->with('mensaje', 'Pelicula creada exitosamente.');
    }

    public function show($id){

        $peliculaModel = new PeliculaModel();

        return view('dashboard/pelicula/show',[
            'pelicula' => $peliculaModel->find($id),
            'imagenes' => $peliculaModel->getImagenById($id),
        ]);
    }

    public function edit($id){
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();

        return view('dashboard/pelicula/edit',[
            'pelicula' => $peliculaModel->find($id),
            'categorias' => $categoriaModel->find(),
        ]);
    }

    public function update($id){
        $peliculaModel = new PeliculaModel();

        if($this->validate('peliculas')){
            $peliculaModel->update($id, [
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion'),
                'categoria_id' => $this->request->getPost('categoria_id'),
            ]);

        } else {
            session()->setFlashdata([
                'validacion' => $this->validator //validator trabaja conjunto validate de arriba
            ]);

            return redirect()->back()->withInput();
        }


       return redirect()->back()->with('mensaje', 'Pelicula modificada exitosamente.');
    }

    public function delete($id){
        $peliculaModel = new PeliculaModel();

        $peliculaModel->delete($id);

        return redirect()->back()->with('mensaje', 'Pelicula borrada exitosamente.');
    }
}

<?php

namespace App\Controllers\Dashboard;
use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\PeliculaEtiquetaModel;
use App\Models\PeliculaModel;

class Pelicula extends BaseController
{

    public function index()
    {
        $peliculaModel = new PeliculaModel();

        $data = [
            'peliculas' => $peliculaModel->select('peliculas.*, categorias.titulo as categoria')->join('categorias', 'categorias.id = peliculas.categoria_id')->find()
        ];

        return view('/dashboard/pelicula/index', $data);
    }

    public function etiquetas($id){
        $categoriaModel = new CategoriaModel();
        $etiquetaModel = new EtiquetaModel();
        $peliculaModel = new PeliculaModel();

        $etiquetas = [];

        if ($this->request->getGet("categoria_id")) {
            $etiquetas = $etiquetaModel
            ->where('categoria_id', $this->request->getGet('categoria_id'))
            ->findAll();
        }

        echo view('dashboard/pelicula/etiquetas',[
            'pelicula' => $peliculaModel->find($id),
            'categorias' => $categoriaModel->findAll(),
            'etiquetas' => $etiquetas,
        ]);
    }

    public function etiquetas_post($id){
        $peliculaEtiquetaModel = new PeliculaEtiquetaModel();

        $etiquetaId = $this->request->getPost('etiqueta_id');
        $peliculaId = $id;

        $peliculaEtiqueta = $peliculaEtiquetaModel->where('etiqueta_id', $etiquetaId)->where('pelicula_id', $peliculaId)->first();

        if(!$peliculaEtiqueta){
            $peliculaEtiquetaModel->insert([
                'pelicula_id' => $peliculaId,
                'etiqueta_id' => $etiquetaId,
            ]);
        }
        return redirect()->back();
    }

    public function etiqueta_delete($id, $etiquetaId){
        $peliculaEtiqueta = new PeliculaEtiquetaModel();
        $peliculaEtiqueta->where('etiqueta_id', $etiquetaId)
            ->where('pelicula_id', $id)->delete();

        return redirect()->back()->with('mensaje', 'Etiqueta eliminada');
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
            'etiquetas'=> $peliculaModel->getEtiquetasById($id),
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

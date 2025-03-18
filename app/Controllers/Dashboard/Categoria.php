<?php

namespace App\Controllers\Dashboard;
use App\Controllers\BaseController;

use App\Models\CategoriaModel;

class Categoria extends BaseController
{
    public function index()
    {
        $categoriaModel = new CategoriaModel();

        return view('/dashboard/categoria/index',[
            'categorias' => $categoriaModel->findAll(),
        ]);
    }

    public function new(){
        echo view('/dashboard/categoria/new',[
            'categoria' => [
                'titulo' => '',
            ]
        ]);
    }

    public function create(){
        $categoriaModel = new CategoriaModel();

        $categoriaModel->insert([
            'titulo' => $this->request->getPost('titulo'),
        ]);

        return redirect()->to('/dashboard/categoria')->with('mensaje', 'Categoria creada exitosamente.');
    }

    public function show($id){

        $categoriaModel = new CategoriaModel();

        return view('categoria/show',[
            'categoria' => $categoriaModel->find($id),
        ]);
    }

    public function edit($id){
        $categoriaModel = new CategoriaModel();

        return view('/dashboard/categoria/edit',[
            'categoria' => $categoriaModel->find($id),
        ]);
    }

    public function update($id){
        $categoriaModel = new CategoriaModel();

        $categoriaModel->update($id, [
            'titulo' => $this->request->getPost('titulo'),
        ]);

        return redirect()->back()->with('mensaje', 'Categoria modificada exitosamente.');
    }

    public function delete($id){
        $categoriaModel = new CategoriaModel();

        $categoriaModel->delete($id);

        session()->setFlashdata('mensaje', 'Categoria eliminada exitosamente.');

        return redirect()->back();
        // return redirect()->back()->with('mensaje', 'Categoria eliminada exitosamente.');
    }
}

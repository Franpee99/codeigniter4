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
            'categoria' => new CategoriaModel()
        ]);
    }

    public function create(){
        $categoriaModel = new CategoriaModel();

        if ($this->validate('categorias')){ //validate nos devuelve un booleano
            $categoriaModel->insert([
                'titulo' => $this->request->getPost('titulo'),
            ]);

        } else {
            session()->setFlashdata([
                'validacion' => $this->validator //validator trabaja conjunto validate de arriba, aqui se guarda los errores de la valiacion
            ]);

            return redirect()->back()->withInput(); //withInput para pasar los valores del old
        }

        return redirect()->to('/dashboard/categoria')->with('mensaje', 'Categoria creada exitosamente.');
    }

    public function show($id){

        $categoriaModel = new CategoriaModel();

        return view('/dashboard/categoria/show',[
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

        if ($this->validate('categorias')){
            $categoriaModel->update($id, [
                'titulo' => $this->request->getPost('titulo'),
            ]);

        } else {
            session()->setFlashdata([
                'validacion' => $this->validator //validator trabaja conjunto validate de arriba
            ]);

            return redirect()->back()->withInput(); //withInput para pasar los valores del old
        }

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

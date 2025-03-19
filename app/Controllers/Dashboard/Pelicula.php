<?php

namespace App\Controllers\Dashboard;
use App\Controllers\BaseController;

use App\Models\PeliculaModel;

class Pelicula extends BaseController
{

    public function test($id){
        echo 'hola'.' '.$id;
    }

    public function index()
    {
        $peliculaModel = new PeliculaModel();

        return view('/dashboard/pelicula/index',[
            'peliculas' => $peliculaModel->findAll(),
        ]);
    }

    public function new(){
        echo view('/dashboard/pelicula/new',[
            'pelicula' => [
                'titulo' => '',
                'descripcion' => '',
            ]
        ]);
    }

    public function create(){
        $peliculaModel = new PeliculaModel();

        if($this->validate('peliculas')){
            $peliculaModel->insert([
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion'),
            ]);

        } else {
            session()->setFlashdata([
                'validacion' => $this->validator //validator trabaja conjunto validate de arriba
            ]);

            return redirect()->back();
        }

        return redirect()->to('/dashboard/pelicula')->with('mensaje', 'Pelicula creada exitosamente.');
    }

    public function show($id){

        $peliculaModel = new PeliculaModel();

        return view('dashboard/pelicula/show',[
            'pelicula' => $peliculaModel->find($id),
        ]);
    }

    public function edit($id){
        $peliculaModel = new PeliculaModel();

        return view('dashboard/pelicula/edit',[
            'pelicula' => $peliculaModel->find($id),
        ]);
    }

    public function update($id){
        $peliculaModel = new PeliculaModel();

        if($this->validate('peliculas')){
            $peliculaModel->update($id, [
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion'),
            ]);

        } else {
            session()->setFlashdata([
                'validacion' => $this->validator //validator trabaja conjunto validate de arriba
            ]);

            return redirect()->back();
        }


       return redirect()->back()->with('mensaje', 'Pelicula modificada exitosamente.');
    }

    public function delete($id){
        $peliculaModel = new PeliculaModel();

        $peliculaModel->delete($id);

        return redirect()->back()->with('mensaje', 'Pelicula borrada exitosamente.');
    }
}

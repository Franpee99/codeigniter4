<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use CodeIgniter\HTTP\ResponseInterface;

class Etiqueta extends BaseController
{
    protected $etiquetaModel;

    public function __construct()
    {
        $this->etiquetaModel = new EtiquetaModel();
    }

    public function index()
    {
        $data = [
            'titulo' => 'Listado de Etiquetas',
            'etiquetas' => $this->etiquetaModel
                ->select('etiquetas.*, categorias.titulo as categoria_titulo')
                ->join('categorias', 'categorias.id = etiquetas.categoria_id')
                ->findAll()
        ];

        return view('dashboard/etiqueta/index', $data);
    }

    public function new()
    {
        $categoriaModel = new CategoriaModel();

        $data = [
            'titulo' => 'Crear Etiqueta',
            'categorias' => $categoriaModel->findAll(),
        ];

        return view('dashboard/etiqueta/new', $data);
    }

    public function create()
    {
        $rules = [
            'titulo' => 'required|min_length[3]|max_length[255]|is_unique[etiquetas.titulo]',
            'categoria_id' => 'required|is_not_unique[categorias.id]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->etiquetaModel->insert([
            'titulo' => $this->request->getPost('titulo'),
            'categoria_id' => $this->request->getPost('categoria_id'),
        ]);

        return redirect()->to('/dashboard/etiqueta')->with('mensaje', 'Etiqueta creada exitosamente');
    }



    public function edit($id = null)
    {
        $etiqueta = $this->etiquetaModel->find($id);

        if ($etiqueta === null) {
            return redirect()->to('/dashboard/etiqueta')->with('error', 'Etiqueta no encontrada');
        }

        $data = [
            'titulo' => 'Editar Etiqueta',
            'etiqueta' => $etiqueta
        ];

        return view('dashboard/etiqueta/edit', $data);
    }

    public function update($id = null)
    {
        $rules = [
            'titulo' => "required|min_length[3]|max_length[255]|is_unique[etiquetas.titulo,id,$id]"
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->etiquetaModel->update($id, [
            'titulo' => $this->request->getPost('titulo')
        ]);

        return redirect()->to('/dashboard/etiqueta')->with('mensaje', 'Etiqueta actualizada exitosamente');
    }

    public function delete($id = null)
    {
        $etiqueta = $this->etiquetaModel->find($id);

        if ($etiqueta === null) {
            return redirect()->to('/dashboard/etiqueta')->with('error', 'Etiqueta no encontrada');
        }

        $this->etiquetaModel->delete($id);

        return redirect()->to('/dashboard/etiqueta')->with('mensaje', 'Etiqueta eliminada exitosamente');
    }
}

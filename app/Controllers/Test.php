<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function index()
    {
        return "Funciona Test::index()";
    }

    public function saludo()
    {
        return "Hola desde saludo()";
    }
}

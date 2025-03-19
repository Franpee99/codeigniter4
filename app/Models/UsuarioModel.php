<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';

    protected $allowedFields    = ['usuario', 'email', 'contrasena'];

    //Encriptar la contraseña
    public function contrasenaHash($contrasenaHash){
        return password_hash($contrasenaHash, PASSWORD_DEFAULT);
    }

    //Comparar la contraseña en texto plano con el de esa contraseña en hash
    public function contrasenaVerificar($contrasena, $contrasenaHash){
        return password_verify($contrasena, $contrasenaHash);
    }
}

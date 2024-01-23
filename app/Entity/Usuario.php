<?php

namespace App\Entity;

use \App\Db\Database;
use PDO;

class Usuario
{
public $id;
public $nome;
public $email;
public $senha;

//metodo responsavel por cadastar
public function cadastar()
{
    //insere um novo usuario
    $obDatabase = new Database('usuarios');
    $this->id = $obDatabase->insert([
        'nome' => $this->nome,
        'email' => $this->email,
        'senha' => $this->senha
    ]);
return true;
}
}
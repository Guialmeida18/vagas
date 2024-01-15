<?php

namespace App\Entity;

use \App\Db\Database;
use PDO;

class Vaga
{
    public $id;
    public $titulo;
    public $descricao;
    public $ativo;
    public $data;

    public function cadastrar()
    {
        $this->data = date('Y-m-d-H:m:s');

        $obDatabase = new Database("vagas");
        $this->id = $obDatabase->insert([
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'ativo' => $this->ativo,
            'data' => $this->data,
        ]);
        return true;
    }

    //metodo responsavel por atualizar a vaga no banco
    public function atualizar()
    {
        return (new Database('vagas'))->update('id =' . $this->id, [
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'ativo' => $this->ativo,
            'data' => $this->data

        ]);
    }

    public function excluir()
    {
        return (new Database('vagas'))->delete('id =' . $this->id);
    }

//metodo responsavel por obter a vaga do banco de dados
    public static function getVagas($where = null, $order = null, $limit = null)
    {

        return (new Database('vagas'))->select($where, $order, $limit)->fetchALL(PDO::FETCH_CLASS, self::class);

    }

//metodo responsavel por buscar uma vaga com base no seu id
    public static function getVaga($id)
    {
        return (new Database('vagas'))->select('id = ' . $id)->fetchObject(self::class);
    }
}

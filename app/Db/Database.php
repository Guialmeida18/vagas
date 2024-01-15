<?php
//O código está definindo um namespace chamado App\Entity.
namespace App\Db;

use \PDO;
use \PDOException;

class Database
{
    const Host = 'mysql';
    const Name = 'central_vagas';
    const User = 'root';
    const Pass = '1234';

    private $table;

    private $connection;

    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setconnect();
    }

    private function setconnect()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::Host . ';dbname=' . self::Name, self::User, self::Pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    //metodo utilizado parta execultar querys dentro do banco
    public function execute($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    //metodo responsavel por inserir dados no banco
    public function insert($values)
    {
        //dados da query
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');

        //monta a query
        $query = 'INSERT INTO ' . $this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';
        //execulta o insert
        $this->execute($query, array_values($values));
        //retorna o id inserido
        return $this->connection->lastInsertId();
    }

    // metodo responsavel por execultar uma consulta no branco
    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        //dados da query
        $where = !empty($where) ? 'WHERE ' . $where : '';
        $where = !empty($order) ? 'ORDER BY ' . $order : '';
        $where = !empty($limit) ? 'LIMIT ' . $limit : '';

//monta a query
        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

//execulta a query
        return $this->execute($query);
    }

    // metodo responsavel por execultar a atualiuzação no banco de dados
    public function update($where, $values)
    {
        $fields = array_keys($values);
        $query = 'UPDATE ' . $this->table . ' SET ' . implode('=?,', $fields) . '=?where ' . $where;

//execultar a query
        $this->execute($query, array_values($values));
        return true;
    }

    public function delete($where)
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;

        $this->execute($query);
        return true;
    }
}
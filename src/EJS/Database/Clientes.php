<?php
namespace EJS\Database;
use PDO;

class Clientes {

    private $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }

    public function read($complemento = null){
        try{
            $sql = "select * from clientes ". $complemento;
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }catch (\PDOException $ex){
            die($ex->getMessage());
        }
        return $registros;
    }
} 
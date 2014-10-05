<?php

namespace EJS\Database;

use PDO;

abstract class Conexao {

    private static $dsn     = 'mysql:host=localhost;dbname=poo_projeto04';
    private static $usuario = 'root';
    private static $senha   = 'root';

    private static function connect(){
        try{
            $pdo = new \PDO(self::$dsn, self::$usuario, self::$senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch (\PDOException $ex){
            die($ex->getMessage());
        }
    }

    public static function getConnection(){
        return self::connect();
    }
} 
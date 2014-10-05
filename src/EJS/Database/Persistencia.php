<?php
namespace EJS\Database;


use EJS\Cliente\ClienteAbstract;
use PDO;

class Persistencia {

    private $pdo;

    public function __construct(\PDO $pdo){
        try{
            if($pdo instanceof \PDO):
                $this->pdo = $pdo;
            endif;
        }catch (\PDOException $ex){
            die($ex->getMessage());
        }
    }

    public function persist(ClienteAbstract $cliente){

        try{
            $this->pdo->beginTransaction();
            $sql = "INSERT INTO clientes(id, nome, cpfcnpj, email, endereco, grau_importancia, tipo, endereco_cobranca, cidade_cobranca, celular, sede)
                  values (null, :nome, :cpfcnpj, :email, :endereco, :grauImportancia, :tipo, :enderecoCobranca, :cidadeCobranca, :celular, :sede)";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":nome", $cliente->getNome());
            $stmt->bindValue(":cpfcnpj", $cliente->getCpfcnpj());
            $stmt->bindValue(":email", $cliente->getEmail());
            $stmt->bindValue(":endereco", $cliente->getEndereco());
            $stmt->bindValue(":grauImportancia", $cliente->getGrauImportancia());
            $stmt->bindValue(":tipo", $cliente->getTipo());
            $stmt->bindValue(":enderecoCobranca", $cliente->getEnderecoCobranca());
            $stmt->bindValue(":cidadeCobranca", $cliente->getCidadeCobranca());

            if($cliente->getTipo() == "PF"){
                $stmt->bindValue(":celular", $cliente->getCelular());
                $stmt->bindValue(":sede", null);
            }else{
                $stmt->bindValue(":sede", $cliente->getSede());
                $stmt->bindValue(":celular", null);
            }

            $stmt->execute();

            $this->pdo->lastInsertId();
        }catch (\PDOException $ex){
            die($ex->getMessage());
        }
    }

    public function flush(){
        try{
            $this->pdo->commit();
        } catch (PDOException $ex){
            die($ex->getMessage());
        }
    }

} 
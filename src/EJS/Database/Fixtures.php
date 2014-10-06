<?php
namespace EJS\Database;
use EJS\Cliente\ClienteAbstract;
use PDO;

class Fixtures {

    /*Variáveis auxiliares*/
    private $dbname  = 'poo_projeto04';
    private $tabela  = 'clientes';

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

    public function createDatabase(){
        try{
            //Criando a Base de Dados
            $this->pdo->exec("DROP DATABASE IF EXISTS {$this->dbname}");
            $this->pdo->exec("CREATE DATABASE IF NOT EXISTS {$this->dbname}");
            $this->pdo->exec("use $this->dbname");
            print("Criado o banco de dados [{$this->dbname}]<br>");
        }catch (\PDOException $ex){
            die($ex->getMessage());
        }
    }

    public function createTable(){
        try{
            //Criando a Tabela
            $this->pdo->exec("DROP TABLE IF EXISTS {$this->dbname}");
            $comando ="CREATE table {$this->tabela}(
                    id INT( 10 ) AUTO_INCREMENT NOT NULL PRIMARY KEY,
                    nome VARCHAR( 255 ) NULL,
                    cpfcnpj VARCHAR( 255 ) NULL,
                    email VARCHAR( 255 ) NULL,
                    endereco VARCHAR( 255 ) NULL,
                    grau_importancia VARCHAR( 255 ) NULL,
                    tipo VARCHAR( 255 ) NULL,
                    endereco_cobranca VARCHAR( 255 ) NULL,
                    cidade_cobranca VARCHAR( 255 ) NULL,
                    celular VARCHAR( 255 ) NULL,
                    sede VARCHAR ( 255 ) NULL
                );";
            $this->pdo->exec($comando);
            print("Criada a tabela [{$this->tabela}]<br>");
        }catch (\PDOException $ex){
            die($ex->getMessage());
        }
    }

    public function persist(ClienteAbstract $cliente){

        try{
            if($cliente instanceof ClienteAbstract):

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
            endif;
        }catch (\PDOException $ex){
            $this->pdo->rollBack();
            die($ex->getMessage());
        }
    }

    public function flush(){
        try{
            echo "Persistindo objeto cliente ID ".$this->pdo->lastInsertId()."<br/>";
            $this->pdo->commit();
        } catch (PDOException $ex){
            $this->pdo->rollBack();
            die($ex->getMessage());
        }
    }
}
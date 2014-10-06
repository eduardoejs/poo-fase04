<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
date_default_timezone_set('America/Sao_Paulo');

require_once 'autoload.php';

$fix = new \EJS\Database\Fixtures(\EJS\Database\Conexao::getConnection());

$fix->createDatabase();
$fix->createTable();

$cliente = new \EJS\Cliente\Tipos\PessoaFisica("Maria da Graça", "123.456.789-78", "Av Central", "m@mail.com", "3", "PF");
$cliente->setEnderecoCobranca(null)
    ->setCidadeCobranca(null)
    ->setCelular(null)
;
$fix->persist($cliente);
$fix->flush();

$cliente = new \EJS\Cliente\Tipos\PessoaFisica("Eduardo Silva", "222.666.888-99", "Rua Cbcd", "ed@br.mail.com", "5", "PF");
$cliente->setEnderecoCobranca(null)
    ->setCidadeCobranca(null)
    ->setCelular("12 99100-9876")
;
$fix->persist($cliente);
$fix->flush();

$cliente = new \EJS\Cliente\Tipos\PessoaJuridica("Jose da Silva", "001.999.876/0001-99", "Alameda XPTO", "email@uol.com.br", "2", "PJ");
$cliente->setEnderecoCobranca("Alameda XPTO ZZ, 10")
    ->setCidadeCobranca("São Paulo")
    ->setSede("SP")
;
$fix->persist($cliente);
$fix->flush();

$cliente = new \EJS\Cliente\Tipos\PessoaFisica("Paulo Batuta", "345.654.120-88", "Av SouzaLima", "batuta@hotmail.com", "1", "PF");
$cliente->setEnderecoCobranca(null)
    ->setCidadeCobranca(null)
    ->setCelular("11 88223-9876")
;
$fix->persist($cliente);
$fix->flush();

$cliente = new \EJS\Cliente\Tipos\PessoaFisica("Marlene Cilene", "123.765.998-99", "Av Centenário", "mc@ig.com.br", "1", "PF");
$cliente->setEnderecoCobranca(null)
    ->setCidadeCobranca(null)
    ->setCelular("14 99123-0076")
;
$fix->persist($cliente);
$fix->flush();

$cliente = new \EJS\Cliente\Tipos\PessoaFisica("Catarina Santos", "123.568.003-91", "Travessa do Carmo", "csantos@yahoo.com", "3", "PF");
$cliente->setEnderecoCobranca("Rua ABC, 100")
    ->setCidadeCobranca("Campinas")
    ->setCelular("15 89023-9000")
;
$fix->persist($cliente);
$fix->flush();

$cliente = new \EJS\Cliente\Tipos\PessoaJuridica("Joao John", "12.456.789/0011-22", "Av dos Expedicionários", "john@mail.com", "5", "PJ");
$cliente->setEnderecoCobranca(null)
    ->setCidadeCobranca(null)
    ->setSede("SP")
;
$fix->persist($cliente);
$fix->flush();

$cliente = new \EJS\Cliente\Tipos\PessoaFisica("Eulália Batista", "222.222.345-98", "Av Turmalina", "batista@r7.com", "4", "PF");
$cliente->setEnderecoCobranca(null)
    ->setCidadeCobranca(null)
    ->setCelular("11 98181-4553")
;
$fix->persist($cliente);
$fix->flush();

$cliente = new \EJS\Cliente\Tipos\PessoaFisica("Zuleide Aparecida", "111.111.111-11", "Rua Castello Branco", "zap@uol.com.br", "1", "PF");
$cliente->setEnderecoCobranca(null)
    ->setCidadeCobranca(null)
    ->setCelular("14 99677-8765")
;
$fix->persist($cliente);
$fix->flush();

$cliente = new \EJS\Cliente\Tipos\PessoaJuridica("Cida Castanheira", "12.455.876/0001-99", "Rua Gonçalves Dias", "cast@gmail.com", "2", "PJ");
$cliente->setEnderecoCobranca("Rua Gonçalves Dias, 100")
    ->setCidadeCobranca("Bauru")
    ->setSede("SP")
;
$fix->persist($cliente);
$fix->flush();
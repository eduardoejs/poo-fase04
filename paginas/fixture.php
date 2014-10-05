<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
date_default_timezone_set('America/Sao_Paulo');

require_once 'autoload.php';

$fix = new \EJS\Database\Fixtures(\EJS\Database\Conexao::getConnection());

$fix->createDatabase();
$fix->createTable();

<?php

$host = '127.0.0.1'; 
$db   = 'jobs';      
$user = 'root';      
$pass = '';          
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Esta linha cria a variável $pdo que será usada em outros arquivos
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Em um ambiente de produção, é melhor logar o erro do que exibi-lo na tela.
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
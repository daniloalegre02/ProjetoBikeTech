<?php

$dsn = 'mysql:host=localhost;dbname=bicicletaria';
$user = 'root';
$senha = '';

try {
    $conexao = new PDO($dsn, $user, $senha);
    return $conexao;
}
catch(PDOException $e) {
    echo 'Erro ao conectar com o banco de dados';
}
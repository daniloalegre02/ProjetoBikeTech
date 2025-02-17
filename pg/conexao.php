<?php
function Conexao()
{
    //----NÃO coloque SESSION_START() nos arquivos que VÃO usar a CONEXAO.PHP-----
    session_start();

/*     $dsn = 'mysql:host=galacticabsg;dbname=hubsap45_bd_bicicletaria';
    $user = 'jonhson';
    $senha = '123456'; */

    
    $dsn = 'mysql:host=localhost;dbname=hubsap45_bd_bicicletaria';
    $user = 'root';
    $senha = '';
    global $conexao;

    try {
        $conexao = new PDO($dsn, $user, $senha);
        return $conexao;
    } catch (PDOException $e) {
        echo 'Erro ao conectar com o banco de dados';
    }
}

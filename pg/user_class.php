<?php
class Usuario
{

    function login($email, $senha)
    {
        global $conexao;

        //Acessa a tabela cliente e recebe os dados do parametro: "$email" e "$senha"
        $sql = "SELECT * FROM tblcliente WHERE cliEmail = :email and cliSenha = :senha";
        $sql = $conexao->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();

        //Valida se os dados existem
        if ($sql->rowCount() > 0) {
            //Acessa esse dado
            $dado = $sql->fetch(PDO::FETCH_ASSOC);
            //Atribui este dado à SESSION
            $_SESSION['idCliente'] = $dado['idCliente'];
            return true;
        } else {
            return false;
        }
    }
}

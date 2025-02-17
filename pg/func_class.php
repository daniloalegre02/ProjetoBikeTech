<?php
class Funcionario
{

    function login($email, $senha)
    {
        global $conexao;

        //Acessa a tabela funcionário e recebe os dados do parametro: "$email" e "$senha"
        $sql = "SELECT * FROM tblfuncionario WHERE funEmail = :email and funSenha = :senha";
        $sql = $conexao->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();

        //Valida se os dados existem
        if ($sql->rowCount() > 0) {
            //Acessa esse dado
            $dado = $sql->fetch(PDO::FETCH_ASSOC);
            //Atribui este dado à SESSION
            $_SESSION['idFuncionario'] = $dado['idFuncionario'];
            return true;
        } else {
            return false;
        }
    }
}

<?php
    try {
        require "conexao.php";
        // executa user_class.php
        require "user_class.php";
        // executa func_class.php
        require "func_class.php";
        $conexao = Conexao();
        $user = new Usuario();
        $func = new Funcionario();
        $email = addslashes(($_POST['email']));
        $senha = addslashes(($_POST['senha']));

        //Verifica se a conta é de um cliente
        //Se a condição $sql->rowCount() > 0 for true redireciona para cliente.html
        if ($user->login($email, $senha) == true) {
            if (isset($_SESSION['idCliente'])) {
                header('Location: cliente.html');
            }
        //Verifica se a conta é de um funcionário
        //Se a condição $sql->rowCount() > 0 for true redireciona para funcionario.html
        } else  if($func->login($email, $senha) == true){
            if (isset($_SESSION['idFuncionario'])) {
                header('Location: funcionario.html');
            }
        } else {
            header('Location: login.php?login=erro');
        }
    } catch (PDOException $e) {
        echo 'Mensagem de ERRO: ' . $e->getMessage();
    }

?>
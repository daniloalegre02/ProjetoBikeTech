<?php

    /* VALIDAÇÃO DOS CAMPOS */
    require_once "conexao.php";
    $conexao = Conexao();
    try {
        /*----- verifica se o email já existe no sistema -----*/
        //verifica na tabela Cliente
        $sql_cli_email = "SELECT * FROM tblcliente WHERE cliEmail = :email";
        $cli_email = $conexao->prepare($sql_cli_email);
        $cli_email->bindValue(':email', $_POST['email']);
        $cli_email->execute();
        $verif_cli_email = $cli_email->fetch(PDO::FETCH_ASSOC);
        
        //verifica na tabela Funcionário
        $sql_fun_email = "SELECT * FROM tblfuncionario WHERE funEmail = :email";
        $fun_email = $conexao->prepare($sql_fun_email);
        $fun_email->bindValue(':email', $_POST['email']);
        $fun_email->execute();
        $verif_fun_email = $fun_email->fetch(PDO::FETCH_ASSOC);

        /*----- verifica se o cpf já existe no sistema -----*/
        //verifica na tabela Cliente
        $sql_cli_cpf = "SELECT * FROM tblcliente WHERE cliCpf = :cpf";
        $cli_cpf = $conexao->prepare($sql_cli_cpf);
        $cli_cpf->bindValue(':cpf', $_POST['cpf']);
        $cli_cpf->execute();
        $verif_cli_cpf = $cli_cpf->fetch(PDO::FETCH_ASSOC);
        
        //verifica na tabela Funcionário
        $sql_fun_cpf = "SELECT * FROM tblfuncionario WHERE funCpf = :cpf";
        $fun_cpf = $conexao->prepare($sql_fun_cpf);
        $fun_cpf->bindValue(':cpf', $_POST['cpf']);
        $fun_cpf->execute();
        $verif_fun_cpf = $fun_cpf->fetch(PDO::FETCH_ASSOC);

        /* ------ verifca se o estado corresponde com a cidade ----- */
        $sqlVerCid = "SELECT * FROM tblcidade WHERE cidNome = :n and cidIdUf = :u";
        $verCid = $conexao->prepare($sqlVerCid);
        $verCid->bindValue(':n', $_POST['cidade']);
        $verCid->bindValue(':u', $_POST['estado']);
        $verCid->execute();
        $resCidade = $verCid->fetch(PDO::FETCH_ASSOC);
        
        // ----- EXECUTA SE TUDO ESTIVER CORRETO -----
        if($verif_cli_email['cliEmail'] !== $_POST['email'] && 
           $verif_cli_cpf['cliCpf'] !== $_POST['cpf'] &&
           $verif_fun_email['funEmail'] !== $_POST['email'] && 
           $verif_fun_cpf['funCpf'] !== $_POST['cpf'] &&
           $verCid->rowCount() > 0) 
        {
        /* ----- define valor para o campo cliIdCidade ----- */
        $idCidade = $resCidade['idCidade'];

        //----- Inseri os dados na tblcliente -----
        $sql = "INSERT INTO tblcliente
        (cliNome, cliEndereco, cliIdCidade, cliCpf, cliTelefone, cliEmail, cliSenha)
        VALUES (:n, :e, :c, :cp, :t, :em, :s)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':n', $_POST['nome']);
        $stmt->bindValue(':e', $_POST['endereco']);
        $stmt->bindValue(':c', $idCidade);
        $stmt->bindValue(':cp', $_POST['cpf']);
        $stmt->bindValue(':t', $_POST['telefone']);
        $stmt->bindValue(':em', $_POST['email']);
        $stmt->bindValue(':s', $_POST['senha']);
        $stmt->execute();

        //----- Passa valor para a SESSION -----
        $consulta = "SELECT * FROM tblcliente WHERE cliNome = :n and cliEndereco = :e and cliIdCidade = :c and cliCpf = :cp and cliTelefone = :t and cliEmail = :em and cliSenha = :s";
        $consulta = $conexao->prepare($consulta);
        $consulta->bindValue(':n', $_POST['nome']);
        $consulta->bindValue(':e', $_POST['endereco']);
        $consulta->bindValue(':c', $idCidade);
        $consulta->bindValue(':cp', $_POST['cpf']);
        $consulta->bindValue(':t', $_POST['telefone']);
        $consulta->bindValue(':em', $_POST['email']);
        $consulta->bindValue(':s', $_POST['senha']);
        $consulta->execute();
        //Acessa esse dado
        //A informação do $consulta vira uma ARRAY
        /*
        Por questões de memória usar:
        PDO::FETCH_ASSOC
        Usa a posição da ARRAY pelo nome da coluna(BANCO DE DADOS)
        */
        $dados = $consulta->fetch(PDO::FETCH_ASSOC);
        //SESSION recebe o registro do campo "idCliente"
        $_SESSION['idCliente'] = $dados['idCliente'];
        header('Location: cliente.html');
        } 
        /* msg de erro na correspondência da cidade com o estado */
        else if($verCid->rowCount() == 0)
        {
            header('Location: cadastro.php?cadastro=cid_error');
        }
        /* msg de erro para email e cpf já cadastrados */ 
        else if($verif_cli_email['cliEmail'] == $_POST['email'] || 
                $verif_cli_cpf['cliCpf'] == $_POST['cpf'] ||
                $verif_fun_email['funEmail'] == $_POST['email'] ||
                $verif_fun_cpf['funCpf'] == $_POST['cpf'])
        {
            header('Location: cadastro.php?cadastro=erro_email_cpf');
        } 
        /* msg de erro para erro tanto na cidade, uf, email e cpf */
        if (($verif_cli_email['cliEmail'] == $_POST['email'] || 
            $verif_cli_cpf['cliCpf'] == $_POST['cpf'] ||
            $verif_fun_email['funEmail'] == $_POST['email'] ||
            $verif_fun_cpf['funCpf'] == $_POST['cpf']) &&
            $verCid->rowCount() == 0)
        {
        header('Location: cadastro.php?cadastro=erro_geral');
        }

    } catch (PDOException $e) {
        echo 'Mensagem de erro:' . $e->getMessage();
    }
?>
<?php
  if (!empty($_POST)) {
  require_once "conexao.php";
  $conexao = Conexao();


  try {
    //inseri o registro na tblbicicleta
    $sqlBicicleta = "INSERT INTO tblbicicleta
 (bicModelo, bicAnoFab, bicCor, bicIdCliente)
  VALUES(:m, :a, :c, :ic)";

    $cmdBicicleta = $conexao->prepare($sqlBicicleta);
    $cmdBicicleta->bindValue(':m', $_POST['modelo']);
    $cmdBicicleta->bindValue(':a', $_POST['anofab']);
    $cmdBicicleta->bindValue(':c', $_POST['cor']);
    $cmdBicicleta->bindValue(':ic', $_POST['idCliente']);
    $cmdBicicleta->execute();

    // Analisa registros da tblbicicleta
    $sqlBicicleta = "SELECT * FROM tblbicicleta WHERE bicIdCliente = :ic";
    $cmdBicicleta = $conexao->prepare($sqlBicicleta);
    $cmdBicicleta->bindValue(':ic', $_POST['idCliente']);
    $cmdBicicleta->execute();
    //Transforma $cmd em uma ARRAY
    $registroBic = $cmdBicicleta->fetch(PDO::FETCH_ASSOC);
    $_SESSION['idBicicleta'] = $registroBic['idBicicleta'];


    //inseri o registro na tblproduto
    $sqlProduto = "INSERT INTO tblproduto
  (proNome, proValor, proDescricao, proIdCliente)
  VALUES('Manutenção', :v, :d, :ic)";
    $cmd = $conexao->prepare($sqlProduto);
    $cmd->bindValue(':v', $_POST['valor']);
    $cmd->bindValue(':d', $_POST['descprob']);
    $cmd->bindValue(':ic', $_POST['idCliente']);
    $cmd->execute();

  } catch (PDOException $e) {
    echo 'Mensagem de ERRO: ' . $e->getMessage();
  }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manutenção</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/manutencao.css">
</head>

<body class="containerBody">
  <!-- Navbar -->
  <header>
    <nav class="bg bgNavbar">
      <div class="container">
        <div class="navElementos">
          <a href="#"><img src="../img/logo_bicicletaria.png" alt="logo" width="100%" height="100%" /></a>
          <div class="navConteudo">
            <div class="paiOptionNav">
              <a href="#" class="optionNavbar">Manutenção</a>
              <a href="contato.php" class="optionNavbar">Contato</a>
            </div>
            <form class="" role="search">
              <input class="pesquisar" type="search" placeholder="Pesquisar" aria-label="Search" />
            </form>
          </div>

          <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #ffc107">
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" style="color: #ffc107" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
              </svg>
            </button>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="deslog.php">Sair
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16" style="color: red">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                  </svg>
                </a>
              </li>
            </ul>
          </div>
        </div>

        <!-- Navbar para dispositivos móveis -->
        <div class="menuIcon">
          <button data-bs-toggle="collapse" data-bs-target=".mobileNavElement">
            <img src="../img/menuNavbarIcon.png" alt="ícone de menu" class="img-fluid" width="50" height="50" />
          </button>
        </div>

        <div class="mobileNavElement collapse">
          <div class="conteudo navConteudo">
            <div class="paiOptionNav">
              <a href="#" class="optionNavbar">Manutenção</a>
              <a href="contato.php" class="optionNavbar">Contato</a>
            </div>
            <div class="conteudo">
              <form class="" role="search">
                <input class="pesquisar" type="search" placeholder="Pesquisar" aria-label="Search" />
              </form>
            </div>
          </div>

          <div class="conteudo">
            <div class="dropdown">
              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #ffc107">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" style="color: #ffc107" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg>
              </button>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="deslog.php">Sair
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16" style="color: red">
                      <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                      <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                    </svg>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <!-- Formulário -->
  <main>
    <div class="bgMain">
      <h1 class="text-center titleForm">Cadastrar bicicleta na manutenção</h1>
      <div class="customForm">
        <form method="post" action="#">
          <label>Adicionar id do cliente</label>
          <input type="number" name="idCliente" class="clienteCustom" required>
          <a href="listaCliente.php" class="linkStyle">Visualizar clientes</a>
          <label>Modelo</label>
          <input type="text" name="modelo" class="modeloCustom" required>

          <div class="formElementPai">
            <div class="formElementFilho1">
              <label>Cor</label>
              <input type="text" name="cor" class="corCustom" required>
            </div>
            <div class="formElementFilho2">
              <label>Ano fab.</label>
              <input type="text" name="anofab" id="anofab" class="anofabCustom" pattern=".{4}" title="Quantidade de caracteres inválida" required>
            </div>
          </div>

          <label>Descrição do problema</label>
          <textarea name="descprob" cols="30" rows="10" required></textarea>
          <label>Valor</label>
          <input type="text" name="valor" id="valor" class="valorCustom" placeholder="formato 00.00" required>
          <input type="submit" value="Enviar" class="btn btn-warning mt-3 btnCustom">

        </form>
        <a href="funcionario.html"><button class="btn btn-warning mt-3 btnCustom">Voltar
          </button>
        </a>
      </div>

    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <script>
    $('#anofab').mask('0000');
    $('#valor').mask('00000.00', { reverse: true });
  </script>
</body>

</html>
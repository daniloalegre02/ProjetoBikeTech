<?php

session_start();

if(count($_POST) > 0) {
  require_once "conexao.php";

  //$conexao = conexao();

  try {
    //inserir dados na tabela marca
    $sqlMarca = "INSERT INTO tblmarca(marNome) VALUES(:mn)";
    $stmtMarca->$conexao->prepare($sqlMarca);
    $stmtMarca->bindValue(':mn', $_POST['marca']);
    $stmtMarca->execute();

    //puxar o ID de cada registro da tabela marca para que possa ser inserido na tabela bicicleta
    $result_marca = "SELECT * FROM tblMarca";
    $resultado_marca = mysqli_query($conexao, $result_marca);
    while($row_marca = mysqli_fetch_assoc($resultado_marca)){
      if($row_marca['marNome'] == $_POST['marca']) {
        $idMarca = $row_marca['idMarca'];
      }

    }

    /*$sql = "INSERT INTO tblbicicleta(bicIdMarca, bicModelo, bicAnoFab, bicCor, bicMarcha, bicIdCliente, bicDescProblem) VALUES (:ma, :mo, :an, co, :ma, :ic, :dp)";

    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':ma', $idMarca);
    $stmt->bindValue(':mo', $_POST['modelo']);
    $stmt->bindValue(':an', $_POST['anofab']);
    $stmt->bindValue(':co', $_POST['cor']);
    $stmt->bindValue(':ma', $_POST['marcha']);
    $stmt->bindValue(':ic', $_SESSION['login']);
    $stmt->bindValue(':dp', $_POST['descprob']);
    $stmt->execute();*/
  }
  catch(PDOException $e) {
    echo 'Mensagem de erro:' . $e->getMessage();
  }
}
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manutenção</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../pg/manutencao.css">
</head>
<body>
    <header>
        <nav class="bg m-3">
          <div class="container">
            <div class="navElementos">
              <a href="#"><img src="../img/logo_bicicletaria.png" alt="logo"></a>
              <div class="navConteudo">
                <div class="paiOptionNav">
                  <a href="#" class="optionNavbar">Peças</a>
                  <a href="#" class="optionNavbar">Manutenção</a>
                  <a href="#" class="optionNavbar">Contato</a>
                </div>
                <form class="" role="search">
                  <input class="pesquisar" type="search" placeholder="Pesquisar"  aria-label="Search">
                </form>
              </div>
              
    
            <div class="dropdown">
              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #ffc107;">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" style="color: #ffc107;" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Sair</a></li>
              </ul>
            </div>
            </div>
    
            <div class="menuIcon">
              <button data-bs-toggle="collapse" data-bs-target=".mobileNavElement"><img src="../img/menuNavbarIcon.png" alt="ícone de menu" class="img-fluid" width="50" height="50"></button>
            </div>
    
    
            <div  class="mobileNavElement collapse">
              <div class="conteudo navConteudo">
                <div class="paiOptionNav">
                  <a href="#" class="optionNavbar">Peças</a>
                  <a href="#" class="optionNavbar">Manutenção</a>
                  <a href="#" class="optionNavbar">Contato</a>
                </div>
                <div class="conteudo">
                  <form class="" role="search">
                    <input class="pesquisar" type="search" placeholder="Pesquisar"  aria-label="Search">
                  </form>
                </div>
              </div>
              
              <div class="conteudo">
            <div class="dropdown">
              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #ffc107;">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" style="color: #ffc107;" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Sair</a></li>
              </ul>
            </div>
            </div>
          </div>
          </div>
        </nav>
        </header>

        <div class="bg m-3">
            <h1 class="display-6 text-center titleForm">Cadastrar bicicleta na manutenção</h1>
            <div class="customForm">

                <form method="post" action="#">
                    <label>Marca</label>
                    <input type="text" name="marca" style="width: 150px;" required>
                    <label>Modelo</label>
                    <input type="text" name="modelo" style="width: 300px;" required>
                    <label>Ano de fabricação</label>
                    <input type="number" name="anofab" style="width: 100px;" required>
                    <label>Cor</label>
                    <input type="text" name="cor" style="width: 150px;" required>
                    <label>Marcha</label>
                    <div class="checkboxGroup">
                        <input class="boxRadio" type="radio" name="marcha" value="sim" required><label class="radioLabel">Sim</label>
                        <input class="boxRadio" type="radio" name="marcha" value="nao" required><label class="radioLabel">Não</label>
                    </div>
                    <label>Descrição do problema</label>
                    <textarea name="descprob" cols="30" rows="10"></textarea>

                    <button class="btn btn-warning mt-3 btnCustom">Enviar
                    </button>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
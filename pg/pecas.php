<?php
//----- INCOMPLETO -----
require_once "conexao.php";
$conexao = Conexao();

if (!empty($_POST)) {

  try {
    $data = date('Y/m/d');
    $dataEntrega = '2023-12-20';

    //Buscar o registro na tblProduto
    $sqlProduto = "SELECT * FROM tblProduto WHERE proNome = :n and proValor = :v and proDescricao = :d and proIdCliente = :ic ORDER BY idProduto DESC limit 1";
    $cmd = $conexao->prepare($sqlProduto);
    $cmd->bindValue(':n', $_POST['proNome']);
    $cmd->bindValue(':v', $_POST['proValor']);
    $cmd->bindValue(':d', $_POST['proDescricao']);
    $cmd->bindValue(':ic', $_SESSION['idCliente']);
    $cmd->execute();
    //Transforma $cmd em uma ARRAY
    $registroPro = $cmd->fetch(PDO::FETCH_ASSOC);
    //Definição da SESSION proValor, para ser usado na hora do pagamento
    $_SESSION['idProduto'] = $registroPro['idProduto'];


    //inseri o registro na tblproduto
    $sqlProduto = "INSERT INTO tblproduto
                (proNome, proValor, proDescricao, proIdCliente)
                VALUES(:n, :v, :d, :ic)";
    $cmd = $conexao->prepare($sqlProduto);
    $cmd->bindValue(':n', $_POST['proNome']);
    $cmd->bindValue(':v', $_POST['proValor']);
    $cmd->bindValue(':d', $_POST['proDescricao']);
    $cmd->bindValue(':ic', $_SESSION['idCliente']);
    $cmd->execute();

    //----- INSERÇÃO DOS DADOS NA TABELA VENDA -----
    $sql = 'INSERT INTO tblvenda
        (venIdProduto, venFormaPagamento, venPagamento, venParcelas, venDtPagamento, venFormRetirada, venDtEntrega)
        VALUES(:ip, :fm, :pg, :pa, :dp, :fr, :de)';
    $cmd = $conexao->prepare($sql);
    $cmd->bindValue(':ip', $_SESSION['idProduto']);
    $cmd->bindValue(':fm', $_POST['formPagamento']);
    $cmd->bindValue(':pg', $_POST['modPagamento']);
    $cmd->bindValue(':pa', $_POST['parcelas']);
    $cmd->bindValue(':dp', $data);
    $cmd->bindValue(':fr', $_POST['formRetirada']);
    $cmd->bindValue(':de', $dataEntrega);
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
  <title>Pag. Peças</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/pecas.css">
</head>

<body class="containerBody">

  <!-- Navbar -->
  <header>
    <nav class="bgNavbar">
      <div class="container">
        <div class="navElementos">
          <a href="#" class="navImage"><img src="../img/logo_bicicletaria.png" alt="logo" width="100%" height="100%" /></a>
          <div class="navConteudo">
            <div class="paiOptionNav">
              <a href="#" class="optionNavbar">Peças</a>
              <a href="manVerPagar.php" class="optionNavbar">Manutenção</a>
              <a href="contato.html" class="optionNavbar">Contato</a>
            </div>
            <form class="" role="search">
              <input class="pesquisar" type="search" placeholder="Pesquisar" aria-label="Search" />
            </form>
          </div>

          <div class="dropdown">
            <button class="btn dropdown-toggle perfil" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"  fill="currentColor"
                class="bi bi-person-circle perfil" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                <path fill-rule="evenodd"
                  d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
              </svg>
            </button>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="deslog.php">Sair
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-box-arrow-left" viewBox="0 0 16 16" style="color: red">
                    <path fill-rule="evenodd"
                      d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                    <path fill-rule="evenodd"
                      d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
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
              <a href="#" class="optionNavbar">Peças</a>
              <a href="manVerPagar.php" class="optionNavbar">Manutenção</a>
              <a href="contato.html" class="optionNavbar">Contato</a>
            </div>
            <div class="conteudo">
              <form class="" role="search">
                <input class="pesquisar" type="search" placeholder="Pesquisar" aria-label="Search" />
              </form>
            </div>
          </div>

          <div class="conteudo">
            <div class="dropdown">
              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                style="color: #ffc107">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" style="color: #ffc107"
                  fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                  <path fill-rule="evenodd"
                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg>
              </button>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="deslog.php">Sair
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-box-arrow-left" viewBox="0 0 16 16" style="color: red">
                      <path fill-rule="evenodd"
                        d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                      <path fill-rule="evenodd"
                        d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
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


  <!-- Cards -->
  <main class="bgMain">
    <h1 class="text-center" style="color: #ffc107; text-shadow: 0 0 5px #000000;">Peças</h1>
    <div class="CardsContent">

      <div class="col-12 col-md-6 col-lg-3 paiCards">
        <div class="card h-100">

          <img src="../img/pedal_peca.jpg" class="card-img-top" alt="">
          <div class="card-body">
            <h5 class="card-title" style="text-decoration: none ;color: black ;">Pedal</h5>
            <p class="card-text" style="text-decoration: none ;color: black ;">SGODDE 1Pair Bicycle Pedals 3 Bearings
              Platform Bicycle Flat Non-Slip Outdoor Cycling Flat Pedals</p>
              <button type="button" class="btn btn-primary"
              style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .95rem;"
              data-bs-toggle="modal" data-bs-target="#exampleModal01">Comprar</button>
            </div>
          </div>
        </div>

          <!-- Vertically centered modal -->

          <div class="modal fade" id="exampleModal01" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Comprar</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="#" method="post">

                    <label>Nome</label>
                    <input readonly class="col-md-3" name="proNome" value="Pedal"> <br>
                    <label>Valor</label>
                    <input readonly name="proValor" value="40.00"> <br>
                    <label>Descrição</label>
                    <input readonly name="proDescricao"
                      value="SGODDE 1Pair Bicycle Pedals 3 Bearings Platform Bicycle Flat Non-Slip Outdoor Cycling Flat Pedals">
                    <br>
                    <label class="form-label">Forma de Pagamento</label>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="formPagamento" id="flexRadioDefault1" value="A vista">
                        <input class="form-check-input" type="radio" name="formPagamento" id="flexRadioDefault1" value="A vista">
                        <label class="form-check-label" for="flexRadioDefault1">A vista</label>
                      </div>





                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="formPagamento" id="flexRadioDefault2"
                        value="A prazo">
                      <label class="form-check-label" for="flexRadioDefault2">
                        A prazo
                      </label>
                    </div>

                    <label class="form-label mt-2">Pagamento</label>
                    <select class="form-select" aria-label="Default select example" name="modPagamento" required>
                      <option selected>Selecione</option>
                      <option value="Débito">Débito</option>
                      <option value="Crédito">Crédito</option>
                      <option value="Pix">Pix</option>
                    </select>

                      <label class="form-label mt-2">Parcelas</label>
                      <select class="form-select" aria-label="Default select example" name="parcelas" id="parcelas"
                        required>
                        <option value="0">Nenhum</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                      </select>


                      <label class="form-label mt-2">Forma de Retirada</label>
                      <select class="form-select" aria-label="Default select example" name="formRetirada" required>
                        <option selected>Selecione</option>
                        <option value="Entrega">Entrega</option>
                        <option value="Retirada">Retirada</option>
                      </select>








                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>


                      <input type="button" data-bs-toggle="modal" data-bs-target="#exampleModal01-2" value="Comprar"
                        class="btn btn-warning">



                    </div>


                </div>
              </div>
            </div>
          </div>

      <!-- Button trigger modal -->


      <!-- Modal -->
      <div class="modal fade" id="exampleModal01-2" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>
                Seu produto foi comprado com sucesso!
              </p>
            </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-warning">Confirmar</button>
              </div>
          </div>
        </div>
      </div>
      </form>













      <div class="col-12 col-md-6 col-lg-3 paiCards">
        <div class="card h-100">

          <img src="../img/suspensao_peca.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title" style="text-decoration: none ;color: black ;">Suspensão</h5>
            <p class="card-text" style="text-decoration: none ;color: black ;">Garfo Aro 29 Suspensão Aço Canela 38mm
              Amortecedor 80mm Bike Ahead 28,6</p>
            <button type="button" class="btn btn-primary"
              style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .95rem;"
              data-bs-toggle="modal" data-bs-target="#exampleModal02">Comprar</button>
          </div>


          <div class="modal fade" id="exampleModal02" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Comprar</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="#" method="post">
                    <label>Nome</label>
                    <input readonly name="proNome" value="Suspenção"> <br>
                    <label>Valor</label>
                    <input readonly name="proValor" value="25.50"> <br>
                    <label>Descrição</label>
                    <input readonly name="proDescricao"
                      value="Garfo Aro 29 Suspensão Aço Canela 38mm Amortecedor 80mm Bike Ahead 28,6"> <br>
                    <label class="form-label">Forma de Pagamento</label>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="formPagamento" id="flexRadioDefault1"
                        value="A vista">
                      <label class="form-check-label" for="flexRadioDefault1">
                        A vista
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="formPagamento" id="flexRadioDefault2"
                        value="A prazo">
                      <label class="form-check-label" for="flexRadioDefault2">
                        A prazo
                      </label>
                    </div>

                    <div>

                      <label class="form-label mt-2">Pagamento</label>
                      <select class="form-select" aria-label="Default select example" name="modPagamento" required>
                        <option selected>Selecione</option>
                        <option value="Débito">Débito</option>
                        <option value="Crédito">Crédito</option>
                        <option value="Pix">Pix</option>
                      </select>
                      
                    </div>
                    <div>

                      <label class="form-label mt-2">Parcelas</label>
                        <select class="form-select" aria-label="Default select example" name="parcelas" id="parcelas"
                        required>
                        <option value="0">Nenhum</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                        </select>
                      </div>
                        


                        <label class="form-label mt-2">Forma de Retirada</label>
                        <select class="form-select" aria-label="Default select example" name="formRetirada" required>
                          <option selected>Selecione</option>
                          <option value="Entrega">Entrega</option>
                          <option value="Retirada">Retirada</option>
                        </select>
                        


                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                  <a data-bs-toggle="modal" data-bs-target="#exampleModal02-2">
                    <input type="button" value="Comprar" class="btn btn-warning">
                  </a>


                </div>


              </div>
            </div>
          </div>

          <!-- Button trigger modal -->


          <!-- Modal -->
          <div class="modal fade" id="exampleModal02-2" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>
                    Seu produto foi comprado com sucesso!
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-warning">Confirmar</button>
                </div>
              </div>
            </div>
          </div>

          </form>


        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-3 paiCards">
        <div class="card h-100">

          <img src="../img/guidao_peca.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title" style="text-decoration: none ;color: black ;">Guidão</h5>
            <p class="card-text" style="text-decoration: none ;color: black ;">Guidao Renthal Bike Mtb Fatbar V2
              800Mm-Rise 20Mm-Fatbar 31.8Mm</p>
            <button type="button" class="btn btn-primary"
              style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .95rem;"
              data-bs-toggle="modal" data-bs-target="#exampleModal03">Comprar</button>
          </div>

          <div class="modal fade" id="exampleModal03" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Comprar</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="#" method="post">
                    <label>Nome</label>
                    <input readonly name="proNome" value="Guidão"> <br>
                    <label>Valor</label>
                    <input readonly name="proValor" value="80.50"> <br>
                    <label>Descrição</label>
                    <input readonly name="proDescricao"
                      value="Guidao Renthal Bike Mtb Fatbar V2 800Mm-Rise 20Mm-Fatbar 31.8Mm"> <br>
                    <label class="form-label">Forma de Pagamento</label>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="formPagamento" id="flexRadioDefault1"
                        value="A vista">
                      <label class="form-check-label" for="flexRadioDefault1">
                        A vista
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="formPagamento" id="flexRadioDefault2"
                        value="A prazo">
                      <label class="form-check-label" for="flexRadioDefault2">
                        A prazo
                      </label>
                    </div>

                    <label class="form-label mt-2">Pagamento</label>
                    <select class="form-select" aria-label="Default select example" name="modPagamento" required>
                      <option selected>Selecione</option>
                      <option value="Débito">Débito</option>
                      <option value="Crédito">Crédito</option>
                      <option value="Pix">Pix</option>
                    </select>


                    <label class="form-label mt-2">Parcelas</label>
                    <select class="form-select" aria-label="Default select example" name="parcelas" id="parcelas"
                      required>
                      <option value="0">Nenhum</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                    </select>


                    <label class="form-label mt-2">Forma de Retirada</label>
                    <select class="form-select" aria-label="Default select example" name="formRetirada" required>
                      <option selected>Selecione</option>
                      <option value="Entrega">Entrega</option>
                      <option value="Retirada">Retirada</option>
                    </select>







                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                  <a data-bs-toggle="modal" data-bs-target="#exampleModal03-2">
                    <input type="button" value="Comprar" class="btn btn-warning">
                  </a>


                </div>


              </div>
            </div>
          </div>

          <!-- Button trigger modal -->


          <!-- Modal -->
          <div class="modal fade" id="exampleModal03-2" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>
                    Seu produto foi comprado com sucesso!
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-warning">Confirmar</button>
                </div>
              </div>
            </div>
          </div>

          </form>


        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-3 paiCards">
        <div class="card h-100">

          <img src="../img/freio_peca.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title" style="text-decoration: none ;color: black ;">Freio</h5>
            <p class="card-text" style="text-decoration: none ;color: black ;">Freio A Disco Hidráulico HighOne Par Bike
              Bicicleta Mtb</p>
            <button type="button" class="btn btn-primary"
              style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .95rem;"
              data-bs-toggle="modal" data-bs-target="#exampleModal04">Comprar</button>
          </div>
          <div class="modal fade" id="exampleModal04" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Comprar</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="#" method="post">
                    <label>Nome</label>
                    <input readonly name="proNome" value="Freio"> <br>
                    <label>Valor</label>
                    <input readonly name="proValor" value="30.20"> <br>
                    <label>Descrição</label>
                    <input readonly name="proDescricao" value="Freio A Disco Hidráulico HighOne Par Bike Bicicleta Mtb">
                    <br>
                    <label class="form-label">Forma de Pagamento</label>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="formPagamento" id="flexRadioDefault1"
                        value="A vista">
                      <label class="form-check-label" for="flexRadioDefault1">
                        A vista
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="formPagamento" id="flexRadioDefault2"
                        value="A prazo">
                      <label class="form-check-label" for="flexRadioDefault2">
                        A prazo
                      </label>
                    </div>

                    <label class="form-label mt-2">Pagamento</label>
                    <select class="form-select" aria-label="Default select example" name="modPagamento" required>
                      <option selected>Selecione</option>
                      <option value="Débito">Débito</option>
                      <option value="Crédito">Crédito</option>
                      <option value="Pix">Pix</option>
                    </select>


                    <label class="form-label mt-2">Parcelas</label>
                    <select class="form-select" aria-label="Default select example" name="parcelas" id="parcelas"
                      required>
                      <option value="0">Nenhum</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                    </select>

                    <label class="form-label mt-2">Forma de Retirada</label>
                    <select class="form-select" aria-label="Default select example" name="formRetirada" required>
                      <option selected>Selecione</option>
                      <option value="Entrega">Entrega</option>
                      <option value="Retirada">Retirada</option>
                    </select>







                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                  <a data-bs-toggle="modal" data-bs-target="#exampleModal04-2">
                    <input type="button" value="Comprar" class="btn btn-warning">
                  </a>


                </div>


              </div>
            </div>
          </div>

          <!-- Button trigger modal -->


          <!-- Modal -->
          <div class="modal fade" id="exampleModal04-2" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>
                    Seu produto foi comprado com sucesso!
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-warning">Confirmar</button>
                </div>
              </div>
            </div>
          </div>

          </form>


        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-3 paiCards">
        <div class="card h-100">

          <img src="../img/selim_peca.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title" style="text-decoration: none ;color: black ;">Selim</h5>
            <p class="card-text" style="text-decoration: none ;color: black ;">Banco bikeroo M-6254 AS Algodão 90%</p>
            <button type="button" class="btn btn-primary"
              style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .95rem;"
              data-bs-toggle="modal" data-bs-target="#exampleModal05">Comprar</button>
          </div>
          <div class="modal fade" id="exampleModal05" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel05">Comprar</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="#" method="post">
                    <label>Nome</label>
                    <input readonly name="proNome" value="Selim"> <br>
                    <label>Valor</label>
                    <input readonly name="proValor" value="120.00"> <br>
                    <label>Descrição</label>
                    <input readonly name="proDescricao" value="Banco bikeroo M-6254 AS Algodão 90%"> <br>
                    <label class="form-label">Forma de Pagamento</label>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="formPagamento" id="flexRadioDefault1"
                        value="A vista">
                      <label class="form-check-label" for="flexRadioDefault1">
                        A vista
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="formPagamento" id="flexRadioDefault2"
                        value="A prazo">
                      <label class="form-check-label" for="flexRadioDefault2">
                        A prazo
                      </label>
                    </div>


                    <label class="form-label mt-2">Pagamento</label>
                    <select class="form-select" aria-label="Default select example" name="modPagamento" required>
                      <option selected>Selecione</option>
                      <option value="Débito">Débito</option>
                      <option value="Crédito">Crédito</option>
                      <option value="Pix">Pix</option>
                    </select>


                    <label class="form-label mt-2">Parcelas</label>
                    <select class="form-select" aria-label="Default select example" name="parcelas" id="parcelas"
                      required>
                      <option value="0">Nenhum</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                    </select>



                    <label class="form-label mt-2">Forma de Retirada</label>
                    <select class="form-select" aria-label="Default select example" name="formRetirada" required>
                      <option selected>Selecione</option>
                      <option value="Entrega">Entrega</option>
                      <option value="Retirada">Retirada</option>
                    </select>







                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                  <a data-bs-toggle="modal" data-bs-target="#exampleModal05-2">
                    <input type="button" value="Comprar" class="btn btn-warning">
                  </a>


                </div>


              </div>
            </div>
          </div>

          <!-- Button trigger modal -->


          <!-- Modal -->
          <div class="modal fade" id="exampleModal05-2" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel05"></h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>
                    Seu produto foi comprado com sucesso!
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-warning">Confirmar</button>
                </div>
              </div>
            </div>
          </div>

          </form>

        </div>
      </div>


      <div class="col-12 col-md-6 col-lg-3 paiCards">
        <div class="card h-100">

          <img src="../img/caboFreio_peca.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title" style="text-decoration: none ;color: black ;">Cabo de freio</h5>
            <p class="card-text" style="text-decoration: none ;color: black ;">Stens 290-213 Control Cable For Mtd Lawn
              Mowers Garden Tractors</p>
            <button type="button" class="btn btn-primary"
              style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .95rem;"
              data-bs-toggle="modal" data-bs-target="#exampleModal06">Comprar</button>
          </div>
          <div class="modal fade" id="exampleModal06" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Comprar</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="#" method="post">
                    <label>Nome</label>
                    <input readonly name="proNome" value="Cabo de freio"> <br>
                    <label>Valor</label>
                    <input readonly name="proValor" value="44.80"> <br>
                    <label>Descrição</label>
                    <input readonly name="proDescricao"
                      value="Stens 290-213 Control Cable For Mtd Lawn Mowers Garden Tractors"> <br>
                    <label class="form-label">Forma de Pagamento</label>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="formPagamento" id="flexRadioDefault1"
                        value="A vista">
                      <label class="form-check-label" for="flexRadioDefault1">
                        A vista
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="formPagamento" id="flexRadioDefault2"
                        value="A prazo">
                      <label class="form-check-label" for="flexRadioDefault2">
                        A prazo
                      </label>
                    </div>

                    <label class="form-label mt-2">Pagamento</label>
                    <select class="form-select" aria-label="Default select example" name="modPagamento" required>
                      <option selected>Selecione</option>
                      <option value="Débito">Débito</option>
                      <option value="Crédito">Crédito</option>
                      <option value="Pix">Pix</option>
                    </select>


                    <label class="form-label mt-2">Parcelas</label>
                    <select class="form-select" aria-label="Default select example" name="parcelas" id="parcelas"
                      required>
                      <option value="0">Nenhum</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                    </select>


                    <label class="form-label mt-2">Forma de Retirada</label>
                    <select class="form-select" aria-label="Default select example" name="formRetirada" required>
                      <option selected>Selecione</option>
                      <option value="Entrega">Entrega</option>
                      <option value="Retirada">Retirada</option>
                    </select>







                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                  <a data-bs-toggle="modal" data-bs-target="#exampleModal06-2">
                    <input type="button" value="Comprar" class="btn btn-warning">
                  </a>


                </div>


              </div>
            </div>
          </div>

          <!-- Button trigger modal -->


          <!-- Modal -->
          <div class="modal fade" id="exampleModal06-2" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel06"></h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>
                    Seu produto foi comprado com sucesso!
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-warning">Confirmar</button>
                </div>
              </div>
            </div>
          </div>

          </form>

        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-3 paiCards">
        <div class="card h-100">

          <img src="../img/coroa_peca.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title" style="text-decoration: none ;color: black ;">Coroa</h5>
            <p class="card-text" style="text-decoration: none ;color: black ;">Coroa Bicicleta Iron Direct Bb30 Gxp 32t
              Off Set 6mm Preto</p>
            <button type="button" class="btn btn-primary"
              style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .95rem;"
              data-bs-toggle="modal" data-bs-target="#exampleModal06">Comprar</button>
          </div>
          <div class="modal fade" id="exampleModal07" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel07">Comprar</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="#" method="post">
                    <label>Nome</label>
                    <input readonly name="proNome" value="Coroa"> <br>
                    <label>Valor</label>
                    <input readonly name="proValor" value="75.80"> <br>
                    <label>Descrição</label>
                    <input readonly name="proDescricao"
                      value="Coroa Bicicleta Iron Direct Bb30 Gxp 32t Off Set 6mm Preto"> <br>
                    <label class="form-label">Forma de Pagamento</label>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="formPagamento" id="flexRadioDefault1"
                        value="A vista">
                      <label class="form-check-label" for="flexRadioDefault1">
                        A vista
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="formPagamento" id="flexRadioDefault2"
                        value="A prazo">
                      <label class="form-check-label" for="flexRadioDefault2">
                        A prazo
                      </label>
                    </div>

                    <label class="form-label mt-2">Pagamento</label>
                    <select class="form-select" aria-label="Default select example" name="modPagamento" required>
                      <option selected>Selecione</option>
                      <option value="Débito">Débito</option>
                      <option value="Crédito">Crédito</option>
                      <option value="Pix">Pix</option>
                    </select>


                    <label class="form-label mt-2">Parcelas</label>
                    <select class="form-select" aria-label="Default select example" name="parcelas" id="parcelas"
                      required>
                      <option value="0">Nenhum</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                    </select>



                    <label class="form-label mt-2">Forma de Retirada</label>
                    <select class="form-select" aria-label="Default select example" name="formRetirada" required>
                      <option selected>Selecione</option>
                      <option value="Entrega">Entrega</option>
                      <option value="Retirada">Retirada</option>
                    </select>







                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                  <a data-bs-toggle="modal" data-bs-target="#exampleModal07-2">
                    <input type="button" value="Comprar" class="btn btn-warning">
                  </a>


                </div>


              </div>
            </div>
          </div>

          <!-- Button trigger modal -->


          <!-- Modal -->
          <div class="modal fade" id="exampleModal07-2" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel07"></h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>
                    Seu produto foi comprado com sucesso!
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-warning">Confirmar</button>
                </div>
              </div>
            </div>
          </div>

          </form>

        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-3 paiCards">
        <div class="card h-100">

          <img src="../img/aro_peca.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title" style="text-decoration: none ;color: black ;">Aro</h5>
            <p class="card-text" style="text-decoration: none ;color: black ;">PASAK 700C Ultralight Road Bicycle Wheel
              Front Rear Wheelset Aluminum Rim C/V Brake</p>
            <button type="button" class="btn btn-primary"
              style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .95rem;"
              data-bs-toggle="modal" data-bs-target="#exampleModal08">Comprar</button>
          </div>
          <div class="modal fade" id="exampleModal08" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel08">Comprar</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="#" method="post">
                    <label>Nome</label>
                    <input readonly name="proNome" value="Aro"> <br>
                    <label>Valor</label>
                    <input readonly name="proValor" value="120.25"> <br>
                    <label>Descrição</label>
                    <input readonly name="proDescricao"
                      value="PASAK 700C Ultralight Road Bicycle Wheel Front Rear Wheelset Aluminum Rim C/V Brake"> <br>
                    <label class="form-label">Forma de Pagamento</label>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="formPagamento" id="flexRadioDefault1"
                        value="A vista">
                      <label class="form-check-label" for="flexRadioDefault1">
                        A vista
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="formPagamento" id="flexRadioDefault2"
                        value="A prazo">
                      <label class="form-check-label" for="flexRadioDefault2">
                        A prazo
                      </label>
                    </div>

                    <label class="form-label mt-2">Pagamento</label>
                    <select class="form-select" aria-label="Default select example" name="modPagamento" required>
                      <option selected>Selecione</option>
                      <option value="Débito">Débito</option>
                      <option value="Crédito">Crédito</option>
                      <option value="Pix">Pix</option>
                    </select>


                    <label class="form-label mt-2">Parcelas</label>
                    <select class="form-select" aria-label="Default select example" name="parcelas" id="parcelas"
                      required>
                      <option value="0">Nenhum</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                    </select>




                    <label class="form-label mt-2">Forma de Retirada</label>
                    <select class="form-select" aria-label="Default select example" name="formRetirada" required>
                      <option selected>Selecione</option>
                      <option value="Entrega">Entrega</option>
                      <option value="Retirada">Retirada</option>
                    </select>







                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                  <a data-bs-toggle="modal" data-bs-target="#exampleModal08-2">
                    <input type="button" value="Comprar" class="btn btn-warning">
                  </a>


                </div>


              </div>
            </div>
          </div>

          <!-- Button trigger modal -->


          <!-- Modal -->
          <div class="modal fade" id="exampleModal08-2" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>
                    Seu produto foi comprado com sucesso!
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-warning">Confirmar</button>
                </div>
              </div>
            </div>
          </div>

          </form>

        </div>
      </div>
      <a href="cliente.html"><button class="btn btn-warning mt-3 btnCustom">Voltar
        </button>
      </a>
    </div>
    </a>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>

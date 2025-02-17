<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contato</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../css/contato.css" />
</head>

<body class="containerBody">
  <main class="bgMain">

    <div class="w-75 infoContats p-5 m-3">
      <div class="row">
        <div class="col-12 col-md-4 text-center">
          <figure>
            <img src="../img/entrada_bicicletaria.jpg" alt="Logo" class="img-fluid" />
          </figure>
        </div>
        <div class="col-12 col-md-8">
          <h1 class="display-5">Contato</h1>

          <div class="m-3">
            <label for="">Endereço:</label>
            <h4>Rua Coronel Pires Barbosa 67 - Guaratinguetá</h4>
          </div>

          <div class="m-3">
            <label for="">Telefone: </label>
            <h4>12 999999999</h4>
          </div>

          <div class="m-3">
            <label for="">Redes socias: </label>
            <h4>ofc_BikeTeach</h4>
          </div>

          <!-- Volta para index, área do cliente,funcionario ou admin
               DEPENDENDO se o usuário está logado e de quem está logado -->
          <?php
          session_start();
          if (!empty($_SESSION['idCliente'])) {
          ?>
            <div class="m-3">
              <a href="cliente.html"><button class="btn btn2 btn-danger mt-3">Voltar</button></a>
            </div>
          <?php
          } else if (!empty($_SESSION['idFuncionario'])) {
          ?>
            <div class="m-3">
              <a href="funcionario.html"><button class="btn btn2 btn-danger mt-3">Voltar</button></a>
            </div>
          <?php
          } else if (!empty($_SESSION['idAdmin'])) {
          ?>
            <div class="m-3">
              <a href="admin.html"><button class="btn btn2 btn-danger mt-3">Voltar</button></a>
            </div>
          <?php
          } else {
          ?>
            <div class="m-3">
              <a href="../index.php"><button class="btn btn2 btn-danger mt-3">Voltar</button></a>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
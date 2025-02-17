<?php
try {
  require_once 'conexao.php';
  $conexao = Conexao();

  /* listar registros da tabela cliente */
  $sqlCliente = 'SELECT * FROM tblUsuario';
  $cmdCliente = $conexao->query($sqlCliente);
  $cmdCliente->execute();
  /* array da tabela cliente */
  $resCliente = $cmdCliente->fetchAll(PDO::FETCH_ASSOC);

  if (count($resCliente) > 0) {
    $mensagem = 'true'; // Define uma variável para a mensagem
  } else {
    $mensagem = 'false'; // Define uma variável para a mensagem
  }

} catch (PDOException $e) {
  echo 'Mensagem de ERRO: ' . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clientes da Loja</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/manVerPagar.css">
</head>

<body class="containerBody">

  <main class="bg">

    <h1 class="display-5">Clientes</h1>
    <table class="table bg-white">
      <thead>
        <tr>
          <th scope="col">idCliente</th>
          <th scope="col">Nome</th>
          <th scope="col">Telefone</th>
          <th scope="col">Email</th>
        </tr>
      </thead>
      <tbody>

        <?php

        if ($mensagem == 'true') {
          //----- LISTA AS LINHAS(REGISTROS) EM UMA TABELA -----
          for ($i = 0; $i < count($resCliente); $i++) {
            //Pega os registros presentes na matriz $resCliente
            echo '<tr>';

            echo '</tr>';
          }
        } else {
          ?>

          <tr>
            <p><b>----- NÃO POSSUI NENHUM CLIENTE -----<b></p>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
    <a href="manutencao.php"><button class="btn btn-warning">Voltar</button></a>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
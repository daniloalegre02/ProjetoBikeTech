<?php
try {
  require_once 'conexao.php';
  $conexao = Conexao();

  /* listar registros da tabela produto */
  $sqlProduto = 'SELECT * FROM tblproduto WHERE proNome = :n AND proIdCliente = :ic';
  $cmdProduto = $conexao->prepare($sqlProduto);
  $cmdProduto->bindValue(':n', 'Manutenção');
  $cmdProduto->bindValue(':ic', $_SESSION['idCliente']);
  $cmdProduto->execute();
  /* array da tabela produto que o cliente fez manutenção */
  $resProduto = $cmdProduto->fetchAll(PDO::FETCH_ASSOC);

  if (count($resProduto) > 0) {
    $mensagem = 'true'; // Defina uma variável para a mensagem
  } else {
    $mensagem = 'false'; // Defina uma variável para a mensagem
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
  <title>Bicicletas em Manutenção</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/manVerPagar.css">
</head>

<body class="containerBody">

  <main class="bg">

    <h1 class="display-5">Manutenções</h1>
    <table class="table bg-white">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Valor</th>
          <th scope="col">Desc. problema</th>
        </tr>
      </thead>
      <tbody>

        <?php

        if ($mensagem == 'true') {
          //----- LISTA AS LINHAS(REGISTROS) EM UMA TABELA -----
          for ($i = 0; $i < count($resProduto); $i++) {
            //Pega os registros presentes na matriz $resCliente
            echo '<tr>';
            foreach ($resProduto[$i] as $key => $value) {
              if ($key != 'proNome' && $key != 'proIdCliente') {
                echo '<td>' . $value . '</td>';
              }
            }
            echo '<td><a href="pagamento.php"><button class="btn btn-warning">
            Pagar
            </button>
          </a></td>';
            echo '</tr>';
          }
        } else {
          ?>

          <tr>
            <p><b>----- SEM MANUTENÇÕES -----<b></p>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
    <a href="cliente.html"><button class="btn btn-warning">Voltar</button></a>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
if (!empty($_POST)) {

    try {
        function Pagar()
        {
            require_once "conexao.php";
            $conexao = Conexao();

            $data = date('Y/m/d');
            $dataEntrega = '2023-12-20';

            //----- INSERÇÃO DOS DADOS NA TABELA VENDA -----
            $sql = 'INSERT INTO tblvenda
        (venIdBicicleta, venIdProduto, venFormaPagamento, venPagamento, venParcelas, venDtPagamento, venFormRetirada, venDtEntrega)
        VALUES(:ib, :ip, :fm, :pg, :pa, :dp, :fr, :de)';
            $cmd = $conexao->prepare($sql);
            $cmd->bindValue(':ib', $_GET['idBicicleta']);
            //Precisa dar valor pra session na página pecas.php
            $cmd->bindValue(':ip', $_SESSION['idProduto']);
            $cmd->bindValue(':fm', $_POST['formPagamento']);
            $cmd->bindValue(':pg', $_POST['modPagamento']);
            $cmd->bindValue(':pa', $_POST['parcelas']);
            $cmd->bindValue(':dp', $data);
            $cmd->bindValue(':fr', $_POST['formRetirada']);
            $cmd->bindValue(':de', $dataEntrega);
            $cmd->execute();

        }

        header('Location: manVerPagar.php');
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
    <title>Pagamento</title>
    <link rel="stylesheet" href="../css/pagamento.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
</head>

<body class="containerBody">
    <main>

        <div class="bgMain">
            <h3>Realizar Pagamento</h3>

            <?php
            //Exibe o valor da compra no formulário
            echo 'valor da compra: ' . $_SESSION['proValor'];
            ?>
            <form action="#" method="post">

                <div class="elementPai">
                    <div class="elementFilho">
                        <label>Modo<br> Pagamento</label>
                        <select name="modPagamento" id="modPagamento" required>
                            <option>Escolha</option>
                            <option value="Crédito">Cartão de crédito</option>
                            <option value="Débito">Cartão de débito</option>
                            <option value="Pix">Pix</option>
                        </select>
                    </div>
                    <div class="elementFilho">
                        <label>Form.<br> Pagamento</label>
                        <select name="formPagamento" id="formPagamento" required>
                            <option>Escolha</option>
                            <option value="À vista">à Vista</option>
                            <option value="Parcelado">Parcelado</option>
                        </select>

                    </div>
                </div>
                
                <label>Parcelas</label>
                <select name="parcelas" id="parcelas">
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

                <label>Forma de retirada</label>
                <select name="formRetirada" id="formRetirada" required>
                    <option>Escolha</option>
                    <option value="Local">No local</option>
                    <option value="Entrega">Entrega</option>
                </select>

                <div class="btnContainer">
                    <input type="submit" class="btn btn1 btn-warning" value="Comprar">
                </div>
            </form>
            <a href="manVerPagar.php">
                <button class="btn btn2 btn-warning">
                    Voltar
                </button>
            </a>
        </div>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
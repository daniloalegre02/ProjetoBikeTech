<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/cadastro.css">
</head>

<body class="containerBody">
    <main class="bgMain">
        <div class="w-75 myform p-5 m-3">
            <div class="row">
                <h1 class="display-4 text-center">Cadastrar-se</h1>
                <div class="col-12">
                    <form action="validaCadastro.php" method="post">
                        <div class="m-3 col-md-6">
                            <label for="">Nome</label>
                            <input type="text" class="form-control" name="nome" required>
                        </div>

                        <div class="m-3 col-md-7">
                            <label for="">Endereço</label>
                            <input type="text" class="form-control" name="endereco" required>
                        </div>

                        <div class="m-3 col-md-4">
                            <label for="">Estado</label>
                            <select class="form-select" aria-label="Default select example" name="estado" required>
                                <option value="0">Selecione</option>
                                <option value=1>Acre</option>
                                <option value=2>Alagoas</option>
                                <option value=3>Amazonas</option>
                                <option value=4>Amapá</option>
                                <option value=5>Bahia</option>
                                <option value=6>Ceará</option>
                                <option value=7>Distrito Federal</option>
                                <option value=8>Espírito Santo</option>
                                <option value=9>Goiás</option>
                                <option value=10>Maranhão</option>
                                <option value=11>Minas Gerais</option>
                                <option value=12>Mato Grosso do Sul</option>
                                <option value=13>Mato Grosso</option>
                                <option value=14>Pará</option>
                                <option value=15>Paraíba</option>
                                <option value=16>Pernambuco</option>
                                <option value=17>Piauí</option>
                                <option value=18>Paraná</option>
                                <option value=19>Rio de Janeiro</option>
                                <option value=20>Rio Grande do Norte</option>
                                <option value=21>Rondônia</option>
                                <option value=22>Roraima</option>
                                <option value=23>Rio Grande do Sul</option>
                                <option value=24>Santa Catarina</option>
                                <option value=25>Sergipe</option>
                                <option value=26>São Paulo</option>
                                <option value=27>Tocantins</option>
                            </select>
                        </div>

                        <div class="m-3 col-md-5">
                            <label for="">Cidade</label>
                            <input type="text" class="form-control" name="cidade" required>
                        </div>

                        <div class="m-3 col-md-5">
                            <label for="">CPF</label>
                            <input type="text" id="cpf" class="form-control" name="cpf" pattern=".{14}"   required title="14 caracteres no mínimo" required>
                        </div>

                        <div class="m-3 col-md-5">
                            <label for="">Telefone</label>
                            <input type="tel" id="telefone" class="form-control" name="telefone" pattern=".{15}" required title="deixe no formato (00) 00000-0000" required>
                        </div>

                        <div class="m-3 col-md-6">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="m-3 col-md-6">
                            <label for="">Senha</label>
                            <input type="password" class="form-control" name="senha" required>
                        </div>

                        <!-- Exibição da mensagem de erro(CPF E EMAIL) -->
                        <?php
                        if (isset($_GET['cadastro']) && ($_GET['cadastro'] == 'erro_email_cpf')) {
                        ?>
                            <p class="fs-5 fw-bold text-danger">Email ou CPF já cadastrado!</p>
                            
                        <!-- Exibição da mensagem de erro(CIDADE E UF) -->
                        <?php
                        } else if (isset($_GET['cadastro']) && ($_GET['cadastro'] == 'cid_error')) {
                        ?>
                            <p class="fs-5 fw-bold text-danger">Estado e cidade não correspondem!</p>

                        <!-- Exibição da mensagem de erro(TODOS OS DADOS INCORRETOS) -->
                        <?php
                        } else if(isset($_GET['cadastro']) && ($_GET['cadastro'] == 'erro_geral')){
                        ?>
                            <p class="fs-5 fw-bold text-danger">Dados incorretos!</p>
                        <?php
                        }
                        ?>

                        <div class="m-3">
                            <input type="submit" value="Cadastrar" class="btn btn1 btn-success">
                        </div>
                    </form>
                    <div class="m-3">
                        <a href="../index.php"><button class="btn btn2 btn-danger mt-3">Voltar</button></a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>

    <script>
        $('#cpf').mask('000.000.000-00', {
            reverse: true
        });
        $('#telefone').mask('(00) 90000-0000');
    </script>

</body>
</html>
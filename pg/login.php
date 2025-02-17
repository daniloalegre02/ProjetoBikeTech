<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body class="containerBody">


    <main class="bgMain">

        <div class="w-75 myform p-5 m-3">
            <div class="row">
                <h1 class="display-4 text-center">Login</h1>
                
                <div class="col-12">
                    <form action="validaLogin.php" method="post">

                        <div class="m-3">
                            <label for="">E-mail</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="m-3">
                            <label for="">Senha</label>
                            <input type="password" class="form-control" name="senha" required>
                        </div>

                        <?php
                        if(isset($_GET['login']) && $_GET['login'] = 'erro') {
                        ?>
                        <p class="fs-5 fw-bold text-danger">Email ou senha inválidos!</p>
                        <?php
                        }
                        ?>
                        <div class="m-3">
                            <input type="submit" value="Login" class="btn btn-success">
                        </div>
                    </form>
                    <div class="m-3">
                        <a href="../index.php"><button class="btn btn-danger mt-3">Voltar</button></a>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
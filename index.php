<?php
session_start();
if (!empty($_SESSION['idCliente'])) {
  header('Location: pg/cliente.html');

} else if (!empty($_SESSION['idFuncionario'])) {
  header('Location: pg/funcionario.html');

} else {

}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pag. Inicial</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/style.css" />
  <link
   rel="stylesheet"
   href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
  <!-- Navbar -->
  <header>
    <nav class="bg bgNavbar" id="container">
      <div class="container">
        <div class="navElementos">
          <a href="#" class="navImage"><img src="img/logo_bicicletaria.png" alt="logo" width="100%" height="100%" /></a>
              <a href="pg/contato.php" class="optionNavbar">Contato</a>
            </div>
          </div>
        <!-- Tela para dispositivos móveis -->
        <div class="menuIcon">
          <button data-bs-toggle="collapse" data-bs-target=".mobileNavElement">
            <img src="img/menuNavbarIcon.png" alt="ícone de menu" class="img-fluid" width="50" height="50" />
          </button>
        </div>

        <div class="mobileNavElement collapse">
          <div class="conteudo navConteudo">
            <div class="paiOptionNav">
              <a href="pg/contato.php" class="optionNavbar">Contato</a>
            </div>
          </div>
        </div>
    </nav>
  </header>

  <!-- ----- CONTEÚDO PRINCIPAL ----- -->
  <section class="bg">
    <h1 class="text-center titleSection">Faça já sua manutenção!</h1>
    <div class="classePai">
      <div class="buttonGroupUser">
        <a href="pg/cadastro.php"><button class="btn btn-warning buttonUser">Cadastro</button></a>
        <a href="pg/login.php"><button class="btn btn-warning buttonUser">Login</button></a>
      </div>
      </div>
    <div class="princContPai">
      <div class="userCont card w-50 p-3 m-5">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
          <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
          <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
        </svg>
        <p>Entrega com rapidez e agilidade</p>
      </div>
      <div class="userCont card w-50 p-3 m-5">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
          <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
        </svg>
        <p>Levamos sua bicicleta até você</p>
      </div>
      <div class="userCont card w-50 p-3 m-5">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
          <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
          <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
          <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
        </svg>
        <p>Temos preços acessíveis</p>
      </div>
    </div>
  </section>
  <!-- Cards -->
  <div class="bg m-3" id="container">


    <h1 class="text-center" style="text-shadow: 0 0 5px #000000;"> Mais Vendidos em 2023</h1>

    <div class="CardsContent">
      <div class="col-12 col-md-6 col-lg-4 paiCards">
        <div class="card h-100">
          <a href="">
            <img src="img/guidao_inicial.jpg" class="card-img-top" alt="" />
            <div class="card-body">
              <h5 class="card-title" style="text-decoration: none; color: black">
                Guidão
              </h5>
              <p class="card-text" style="text-decoration: none; color: black">
              Guidao Spank Spoon 800 Bar 31.8Mm - Rise 20Mm - Preto
              </p>
            </div>
          </a>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-4 paiCards">
        <div class="card h-100">
          <a href="">
            <img src="img/quadro_inicial.jpg" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title" style="text-decoration: none; color: black">
                Quadro
              </h5>
              <p class="card-text" style="text-decoration: none; color: black">
              Quadro de Bicicleta Aro 26 Alumínio 6061 Mtb Freeride Joker
              </p>
            </div>
          </a>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-4  paiCards">
        <div class="card h-100">
          <a href="">
            <img src="img/pedal_inicial.jpg" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title" style="text-decoration: none; color: black">
                Pedal
              </h5>
              <p class="card-text" style="text-decoration: none; color: black">
              SGODDE 1Pair Bicycle Pedals 3 Bearings Platform Bicycle Flat Non-Slip Outdoor Cycling Flat Pedals
              </p>
            </div>
          </a>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-4 paiCards">
        <div class="card h-100">
          <a href="">
            <img src="img/amortecedor_inicial.jpg" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title" style="text-decoration: none; color: black">
               Amortecedor
              </h5>
              <p class="card-text" style="text-decoration: none; color: black">
              Amortecedor Bike 26 Mode 21.1mm Standard Aço Gordo Reforçado
              </p>
            </div>
          </a>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-4  paiCards">
        <div class="card h-100">
          <a href="">
            <img src="img/quadro2_inicial.jpg" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title" style="text-decoration: none; color: black">
                Quadro
              </h5>
              <p class="card-text" style="text-decoration: none; color: black">
              Quadro Bicicleta Bike MTB GTI Roma Alum Biocolor 29x17 CZ/PT
              </p>
            </div>
          </a>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-4  paiCards">
        <div class="card h-100">
          <a href="">
            <img src="img/freio_inicial.jpg" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title" style="text-decoration: none; color: black">
                Freio hidraulico
              </h5>
              <p class="card-text" style="text-decoration: none; color: black">
              FREIO SHIMANO DISCO HIDRAULICO DIANTEIRO ALTUS BL-MT200/BR-MT200 900MM PTO (1140722)
              </p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!--Footer-->
  <div class="container-fluid bgContainers">
    <!--icons das redes sociais-->
    <div class="row">
      <div class="col-12 icons">
        <a href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-twitter-x"
            viewBox="0 0 16 16">
            <path
              d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z" />
          </svg>
        </a>
        <a href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-instagram"
            viewBox="0 0 16 16">
            <path
              d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
          </svg>
        </a>
        <a href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
            class="bi bi-envelope-at-fill" viewBox="0 0 16 16">
            <path
              d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2H2Zm-2 9.8V4.698l5.803 3.546L0 11.801Zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586l-1.239-.757ZM16 9.671V4.697l-5.803 3.546.338.208A4.482 4.482 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671Z" />
            <path
              d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034v.21Zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791Z" />
          </svg>
        </a>
      </div>
      <div class="col-12">
        <p class="text-center">&copy; 2023 - Todos os Direitos Reservados</p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
      AOS.init();
    </script>


</body>

</html>

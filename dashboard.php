<?php
require 'includes/app.php';
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

  <link href="estilos/estilos.css" rel="stylesheet">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="estilos/dashboard.css" rel="stylesheet">
  <title> SISTEMA | POS</title>
</head>

<body>

  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">

    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">SISTEMA POS</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control" id="fechaConsultas" type="date">
    <a href="cerrar_sesion.php"><i class="bi bi-box-arrow-right" style="font-size: 2rem; color: white;"></i></a>

  </header>
  <p id="fechaHoy"> <?php
                    date_default_timezone_set("America/Bogota");
                    echo date('Y-m-d') ?> </p>
  <div class="container-fluid">
    <div class="row">


      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3 sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <i class="bi bi-app-indicator" style="font-size: 1.5rem;"></i> Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="caja/">

                <i class="bi bi-wallet-fill" style="font-size: 1.5rem;"></i> Caja
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="productos/">
                <i class="bi bi-tag" style="font-size: 1.5rem;"></i> Productos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="usuarios/">

                <i class="bi bi-person" style="font-size: 1.5rem;"></i> Usuarios
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="ventas/">
                <i class="bi bi-receipt" style="font-size: 1.5rem;"></i> Ventas
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="comparativas.php">

                <i class="bi bi-bar-chart" style="font-size: 1.5rem;"></i> Comparativas
              </a>
            </li>

          </ul>
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

        <div class="cards_bg">
          <div class="card bg-c-blue order-card">
            <div class="card-block">
              <h6 class="m-b-20">Ingresos</h6>
              <h2 class="text-right"><i class="fa fa-cart-plus f-left"></i><span class="TotalVentas"></span></h2>
            </div>
          </div>



          <div class="card bg-c-green order-card">
            <div class="card-block">
              <h6 class="m-b-20">Numero de ventas </h6>
              <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span class="nVentas"></span></h2>

            </div>
          </div>



          <div class="card bg-c-yellow order-card">
            <div class="card-block">
              <h6 class="m-b-20"> Total Productos Vendidos</h6>
              <h2 class="text-right"><i class="fa fa-refresh f-left"></i><span class="nProductos"></span></h2>

            </div>
          </div>
        </div>

        <div class="graficos_bg">

          <div class="card">
            <div class="card-header">
              Productos que se han vendido y la cantidad
            </div>
            <div class="card-body">
              <div class="grafica_b">
                <canvas id="grafica_1"></canvas>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              Usuarios que han vendido y la cantidad
            </div>
            <div class="card-body">
              <div class="grafica_b">
                <canvas id="grafica_2"></canvas>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="js/app.js"> </script>

</body>

</html>
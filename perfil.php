<?php
require('functions.php');
functions::get_header();
?>


<body>
<div class="container-fluid ps-md-0">
      <div class="row g-0">
        <div class="d-none d-md-flex col-md-4 col-lg-6 ms-5">
          <div class="container">
            <div class="row">
              <h3 class="login-heading mb-4" style="margin-top:15px;">Perfil</h3>
              <h4 class="login-heading mb-4">Información General</h4>
              <p> <b>Nombre:</b> <?php echo  $_SESSION['usuNombre'] ?></p>
              <br>
              <p> <b>Apellidos:</b> <?php echo $_SESSION['usuApell'] ?></p>
              <br>
              <p> <b>DNI:</b> <?php echo $_SESSION['dniUsuario'] ?></p>
              <br>
              <p> <b>Fecha Nacimiento:</b> <?php echo  $_SESSION['fechaNac'] ?></p>
              <br>
              <p> <b>Número de teléfono:</b> <?php echo  $_SESSION['usuTel'] ?></p>
              <br>
              <p> <b>Dirección:</b> <?php echo  $_SESSION['usuDir'] ?></p>
              <br>
              <p> <b>Rol:</b> <?php echo $_SESSION['r']; ?></p>
            </div>
          </div>

        </div>
  <?php


  if ($_SESSION['r'] == "Gerente") {


    if (isset($_POST["nuevoAni"])) {
      $_SESSION['action'] = 'nuevoAni';
      header("Location: gerente.php");
    } elseif (isset($_POST["altaVol"])) {
      $_SESSION['action'] = 'altaVol';
      header("Location: gerente.php");
    } elseif (isset($_POST["agreAct"])) {
      $_SESSION['action'] = 'agreAct';
      header("Location: gerente.php");
    } elseif (isset($_POST["agrAdopcion"])) {
      $_SESSION['action'] = 'agrAdopcion';
      header("Location: gerente.php");
    } elseif (isset($_POST["visuRefugio"])) {
      $_SESSION['action'] = 'visuRefugio';
      header("Location: gerente.php");
    } elseif (isset($_POST["visuTodo"])) {
      $_SESSION['action'] = 'visuTodo';
      header("Location: gerente.php");
    }
  ?>
        <div class="col-md-7 col-lg-5">
          <div class="login d-flex align-items-center py-5">
            <div class="container">
              <div class="row">
                <div class="col-md-8 col-lg-8 mx-auto">

                  <h4 class="login-heading mb-4">Selecciona una operacion</h4>
                  <!-- Sign In Form -->
                  <form action="#" method="POST">

                    <div class="d-grid">
                      <input type="submit" name="nuevoAni" value="Alta Animal" class="btn btn-lg btn-success btn-login text-uppercase fw-bold mb-2">
                    </div>
                    <div class="d-grid">
                      <input type="submit" name="altaVol" value="Alta Voluntario" class="btn btn-lg btn-success btn-login text-uppercase fw-bold mb-2">
                    </div>
                    <div class="d-grid">
                      <input type="submit" name="agreAct" value="Añadir Actividad" class="btn btn-lg btn-success btn-login text-uppercase fw-bold mb-2">
                    </div>
                    <div class="d-grid">
                      <input type="submit" name="agrAdopcion" value="Modificar Adopción" class="btn btn-lg btn-success btn-login text-uppercase fw-bold mb-2">
                    </div>
                    <div class="d-grid">
                      <input type="submit" name="visuRefugio" value="Ver animales actuales" class="btn btn-lg btn-success btn-login text-uppercase fw-bold mb-2">
                    </div>
                    <div class="d-grid">
                      <input type="submit" name="visuTodo" value="Ver todos animales" class="btn btn-lg btn-success btn-login text-uppercase fw-bold mb-2">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php
  }







  ?>





















  <?php
  functions::get_footer();
  ?>
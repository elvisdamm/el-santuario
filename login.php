<!DOCTYPE html>
<html>
<?php

require('functions.php');
functions::get_header();
?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    .login {
      min-height: 100vh;
    }

    .bg-image {
      background-size: cover;
      background-position: center;
    }

    .login-heading {
      font-weight: 300;
    }

    .btn-login {
      font-size: 0.9rem;
      letter-spacing: 0.05rem;
      padding: 0.75rem 1rem;
    }
  </style>
</head>

<div class="div-contenedor ">
  <?php
  $dniError = "";
  if (isset($_POST["entrar"])) {
    $cifrada = hash_hmac('sha512', $_POST["password"], "primeraweb");
    // echo $cifrada;
    $enlace = mysqli_connect("localhost", "comprobar", "comprobar", "elsantuario");
    $usuario = 'SELECT dniUsuario,usuPassword,usuTipo,usuNombre,usuApell,usuTel,usuDir,fechaNac FROM usuarios WHERE dniUsuario="' . $_POST["dni"] . '" AND usuPassword="' . $cifrada . '"';
    $dato = mysqli_query($enlace, $usuario);

    $dni = $_POST["dni"];

    function validar_dni($dni)
    {
      $letra = substr($dni, -1);
      $numeros = substr($dni, 0, -1);
      if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros % 23, 1) == $letra && strlen($letra) == 1 && strlen($numeros) == 8) {
        return true;
      } else {
        return false;
      }
    }



    $fila = mysqli_fetch_assoc($dato);
    if (isset($fila)) {
      $_SESSION['r'] = $fila['usuTipo'];
      $_SESSION['dniUsuario'] = $fila["dniUsuario"];
      $_SESSION['usuNombre'] = $fila["usuNombre"];
      $_SESSION['usuApell'] = $fila["usuApell"];
      $_SESSION['usuTel'] = $fila["usuTel"];
      $_SESSION['usuDir'] = $fila["usuDir"];
      $_SESSION['fechaNac'] = $fila["fechaNac"];
    }




    if (validar_dni($dni) == false) {
      $dniError = "El DNI no es válido";
    } elseif (validar_dni($dni) == true) {
      $dniError = "DNI válido";
      if (mysqli_num_rows($dato) == 0) {
        $dniError = "El DNI no existe en la base de datos";
      } else {
        $_SESSION['logueado'] = true;
        header("Location:perfil.php");
      }
    }
  }
  ?>

  <div class="container-fluid ps-md-0">
    <div class="row g-0">
      <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
      <div class="col-md-8 col-lg-6">
        <div class="login d-flex align-items-center py-5">
          <div class="container">
            <div class="row">
              <div class="col-md-9 col-lg-8 mx-auto">
                <h3 class="login-heading mb-4">Bienvenido</h3>


                <form action="#" method="POST">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Introduce DNI" name="dni" required> <span class="error"><?php echo $dniError; ?></span>
                    <label for="floatingInput">DNI</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Introduce la contraseña" name="password" required>
                    <label for="floatingPassword">Password</label>
                  </div>


                  <div class="d-grid">
                    <input type="submit" name="entrar" value="Entrar" class="btn btn-lg btn-success btn-login text-uppercase fw-bold mb-2">

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
  functions::get_footer();
  ?>
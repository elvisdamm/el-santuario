<?php

require('functions.php');
functions::get_header();

    $enlace = mysqli_connect("localhost", "adoptante", "adoptante", "elsantuario");

    if ($_SESSION['action'] === 'verAnimalAdop') {
        $animales = 'SELECT aniNombre,aniEspecie,aniSexo,fechaAdop FROM animales,adopciones WHERE adopciones.dniAdoptante="' . $_SESSION["dniUsuario"] . '" 
        AND adopciones.idAnimal=animales.idAnimal ';
        $dato = mysqli_query($enlace, $animales);
        $nConfig = mysqli_num_rows($dato);
        if ($nConfig != 0) {
    ?>
            <div class="container mt-5">
                <h4>Adopciones</h4>
                <table class="table">
                    <thead class="table-success">
                        <td>Nombre</td>
                        <td>Especie</td>
                        <td>Sexo</td>
                        <td>Fecha Adopción</td>
                    </thead>
                    <?php
                    for ($i = 0; $i < $nConfig; $i++) {
                        $fila = mysqli_fetch_array($dato);
                    ?>
                        <tr>
                            <td><?php echo $fila['aniNombre'] ?></td>
                            <td><?php echo $fila['aniEspecie'] ?></td>
                            <td><?php echo $fila['aniSexo'] ?></td>
                            <td><?php echo $fila['fechaAdop'] ?></td>

                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <br><br>
        <?php
        } else {
        ?>
            <h4 style="text-align:center;margin-top:30px;">No has adoptado aún</h4>
        <?php
        }
    } elseif ($_SESSION['action'] === 'cambiarContra') {
        $contraError = "";
        if (isset($_POST["agregar"])) {
            $repeContra = $_POST["repeContra"];
            $conta = $_POST["contrase"];
            function validar_contra($contra, $repeContra)
            {
                if ($contra != $repeContra) {

                    return false;
                } else {
                    return true;
                }
            }
            if (validar_contra($conta, $repeContra) == true) {

                $cifrada = hash_hmac('sha512', $_POST["contrase"], "primeraweb");
                $edit =  "UPDATE usuarios SET usuPassword='$cifrada' WHERE dniUsuario='  $_SESSION[dniUsuario] ' ";
                $introducir = mysqli_query($enlace, $edit);
                if (!$introducir) {
                    $introducidos = "Error: No se pudieron insertar los datos";
                } else {
                    $introducidos = "Datos introducidos con exito";
                }
            } else {
                if (validar_contra($conta, $repeContra) == false) {
                    $contraError = " Las contraseñas no son iguales,vuelve a introducirlas";
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
                                    <h3 class="login-heading mb-4">Cambio de contraseña</h3>

                                    <!-- Sign In Form -->
                                    <form action="#" method="POST">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="floatingPassword" name="contrase" required>
                                            <label for="floatingPassword">Contraseña</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="floatingPassword" name="repeContra" required><span><?php echo $contraError; ?></span>
                                            <label for="floatingPassword">Repetir contraseña</label>
                                        </div>


                                        <div class="d-grid">
                                            <input type="submit" name="agregar" value="Añadir" class="btn btn-lg btn-success btn-login text-uppercase fw-bold mb-2">

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
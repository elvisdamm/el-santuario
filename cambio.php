<?php

require('functions.php');
functions::get_header();


    $datos = explode(",", $_SESSION["cambio"]);

    
    $enlace = mysqli_connect("localhost", "voluntario", "voluntario", "elsantuario");
    $fechaError = $introducidos = $horaError = $hora = "";
    $fecha = $datos[6];
    $hora = $datos[8];
    if (isset($_POST["enviar"])) {
        $fecha = $_POST["fecha"];
        $hora = $_POST["hora"];
        function validar_fecha($fecha)
        {
            $hoy = date("Y-m-d");
            if ($hoy >= $fecha) {
                return false;
            } else {

                return true;
            }
        }


        function validar_hora($hora, $fecha)
        {
            $hoy = date("Y-m-d");
            $horaAc = date('H:i:s');;


            if ($hoy == $fecha) {
                if ($horaAc < $hora) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return true;
            }
        }

        if (validar_fecha($fecha) == true && validar_hora($hora, $fecha) == true) {
            $comprobarHora = 'SELECT horaActividad,fechaActividad FROM actividades WHERE dniVoluntario="' . $_SESSION["dniUsuario"] . '" AND fechaActividad="' . $fecha . '" AND horaActividad="' . $hora . '" ';
            $dato = mysqli_query($enlace, $comprobarHora);

            if (mysqli_num_rows($dato) === 0) {
                $edit =  "UPDATE actividades SET fechaActividad='$fecha',horaActividad='$hora'  WHERE tipoActividad='  $datos[0] ' ";
                $introducir = mysqli_query($enlace, $edit);
                if (!$introducir) {
                    $introducidos = "Error: No se pudieron insertar los datos";
                } else {
                    $introducidos = "Datos introducidos con exito";
                    header("Location:voluntario.php");
                }
            } else {
                $introducidos = "Error: El voluntario con dni " . $_SESSION["dniUsuario"] . " ya tiene una actividad a la " . $hora;
            }
        } else {
            if (validar_fecha($fecha) == false) {
                $fechaError = "La fecha no puede ser anterior a hoy";
                $fecha = "";
            }
            if (validar_hora($hora, $fecha) == false) {
                $horaError = "La hora no puede ser anterior a la actual";
                $hora = "";
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
                                <h3 class="login-heading mb-4">Modificar Día/Hora</h3>
                                <form action="#" method="POST">

                                    <div class="form-floating mb-3">
                                        <input type="text" readonly=true class="form-control" id="floatingInput" name="actividad" value="<?php echo $datos[2] ?>">
                                        <label for="floatingInput">Actividad</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" readonly=true class="form-control" id="floatingInput" name="animal" value="<?php echo $datos[4] ?>">
                                        <label for="floatingInput">Nombre del animal</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" id="floatingInput" name="fecha" required value="<?php echo $datos[6] ?>"><span><?php echo $fechaError; ?></span>
                                        <label for="floatingInput">Fecha Actividad</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="time" class="form-control" id="floatingInput" name="hora" required value="<?php echo $datos[8] ?>"><span><?php echo $horaError; ?></span>
                                        <label for="floatingInput">Hora</label>
                                    </div>

                                    <div class="d-grid">
                                        <input type="submit" name="enviar" value="Añadir" class="btn btn-lg btn-success btn-login text-uppercase fw-bold mb-2">

                                    </div>
                                </form>

                                <?php echo $introducidos; ?>

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
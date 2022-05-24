<?php

require('functions.php');
functions::get_header();
?>

<body>

    <?php
    $enlace = mysqli_connect("localhost", "gerente", "gerente", "elsantuario");



    if ($_SESSION['action'] === 'nuevoAni') {
        $fechaError = $espeError = $nombreError = "";
        $fecha = $aniNombre = $aniEspecie = "";

        //Funciones para validar
        if (isset($_POST["agregar"])) {
            $fecha = $_POST["aniFechaIngreso"];
            $aniEspecie = $_POST["aniEspecie"];
            $aniNombre = $_POST["aniNombre"];
            function validar_fecha($fecha)
            {
                $hoy = date("Y-m-d");
                if ($hoy <= $fecha) {
                    return false;
                } else {

                    return true;
                }
            }
            function validar_especie($aniEspecie)
            {
                if (!preg_match("/^([a-zA-ZÀ-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?)*)+$/", $aniEspecie)) {
                    return false;
                } else {
                    return true;
                }
            }

            function validar_nombre($aniNombre)
            {
                if (!preg_match("/^([a-zA-ZÀ-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?)*)+$/", $aniNombre)) {
                    return false;
                } else {
                    return true;
                }
            }

            if (validar_fecha($fecha) == true && validar_nombre($aniNombre) == true && validar_especie($aniEspecie)) {
                $consulta = "INSERT INTO animales (idAnimal,aniNombre,aniFechaIngreso,aniFechaAdop,aniEspecie,aniSexo,aniAdop) 
    VALUES (NULL,'{$_POST["aniNombre"]}','{$_POST["aniFechaIngreso"]}', NULL,'{$_POST["aniEspecie"]}','{$_POST["aniSexo"]}','0')";
                $introducir = mysqli_query($enlace, $consulta);

                if (!$introducir) {
                    $introducidos = "Error: No se pudieron insertar los datos";
                } else {
                    $introducidos = "Datos introducidos con exito";
                }
            } else {
                if (validar_fecha($fecha) == false) {
                    $fechaError = "La fecha no puede ser posterior a hoy";
                    $fecha = "";
                }
                if (validar_nombre($aniNombre) == false) {
                    $nombreError = "Solo letras y espacios";
                    $aniNombre = "";
                }
                if (validar_especie($aniEspecie) == false) {
                    $espeError = "Solo letras y espacios";
                    $aniEspecie = "";
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
                                    <h3 class="login-heading mb-4">Inserte los datos del nuevo animal</h3>
                                    <form method="POST" action="#">

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="aniNombre" required value="<?php echo $aniNombre ?>"><span><?php echo $nombreError; ?></span>
                                            <label for="floatingInput">Nombre</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="floatingInput" name="aniFechaIngreso" required value="<?php echo $fecha ?>"><span><?php echo $fechaError; ?></span>
                                            <label for="floatingInput">Fecha Ingreso</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="aniEspecie" required value="<?php echo $aniEspecie ?>"><span><?php echo $espeError; ?></span>
                                            <label for="floatingInput">Especie</label>
                                        </div>

                                        <select name="aniSexo" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                            <option value="Macho">Macho</option>
                                            <option value="Hembra">Hembra</option>
                                        </select>
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
    if ($_SESSION['action'] === 'altaVol') {
        $apeError = $nombreError = $dniError = $introducidos = $nacimiento = $nacError = $telefonoError = $contraError = "";
        $name = $ape = $dni = $direccion = $telefono = "";

        if (isset($_POST["agregar"])) {
            $dni = $_POST["dniUsuario"];
            $nacimiento = $_POST["fechaNac"];
            $ape = $_POST["ape"];
            $name = $_POST["nombre"];
            $conta = $_POST["contrase"];
            $repeContra = $_POST["repeContra"];
            $direccion = $_POST["direccion"];
            $telefono = $_POST["telefono"];

            function validar_contra($contra, $repeContra)
            {
                if ($contra != $repeContra) {

                    return false;
                } else {
                    return true;
                }
            }
            function validar_nombre($name)
            {
                if (!preg_match("/^([a-zA-ZÀ-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?)*)+$/", $name)) {
                    return false;
                } else {
                    return true;
                }
            }

            function validar_ape($ape)
            {
                if (!preg_match("/^([a-zA-ZÀ-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?)*)+$/", $ape)) {
                    return false;
                } else {
                    return true;
                }
            }
            function validar_dni($dni)
            {
                if (!preg_match('/[0-9]{7,8}[A-Z]/', $dni)) {
                    return false;
                } else {
                    return true;
                }
            }


            function validar_fecha($nacimiento)
            {
                $hoy = date("Y-m-d");
                if ($hoy <= $nacimiento || 1900 > $nacimiento) {
                    return false;
                } else {

                    return true;
                }
            }
            function validar_tel($telefono)
            {
                if (!preg_match("/^[0-9]{9}$/", $telefono)) {
                    return false;
                } else {
                    return true;
                }
            }
            if (validar_tel($telefono) == true && validar_fecha($nacimiento) == true && validar_contra($conta, $repeContra) == true && validar_dni($dni) == true && validar_ape($ape) == true && validar_nombre($name) == true) {
                $cifrada = hash_hmac('sha512', $_POST["contrase"], "primeraweb");
                $usuario = 'SELECT dniUsuario,usuPassword FROM usuarios WHERE dniUsuario="' . $_POST["dniUsuario"] . '"';
                $dato = mysqli_query($enlace, $usuario);

                if (mysqli_num_rows($dato) === 0) {


                    $consulta = "INSERT INTO usuarios (dniUsuario,usuPassword,usuTipo,usuNombre,usuApell,usuTel,usuDir,fechaNac) 
                VALUES ('{$_POST["dniUsuario"]}','{$cifrada}','Voluntario','{$_POST["nombre"]}','{$_POST["ape"]}','{$_POST["telefono"]}','{$_POST["direccion"]}','{$_POST["fechaNac"]}')";
                    $introducir = mysqli_query($enlace, $consulta);

                    if (!$introducir) {
                        $introducidos = "Error: No se pudieron insertar los datos";
                    } else {
                        $introducidos = "Datos introducidos con exito";
                    }
                } else {
                    $dniError = "El DNI ya existe en la base de datos";
                }
            } else {
                if (validar_fecha($nacimiento) == false) {
                    $nacError = "Fecha incorrecta";
                    $nacimiento = "";
                }

                if (validar_dni($dni) == false) {
                    $dniError = "El DNI no es válido";
                    $dni = "";
                }
                if (validar_ape($ape) == false) {
                    $apeError = "Solo letras y espacios ";
                    $ape = "";
                }
                if (validar_nombre($name) == false) {
                    $nombreError = "Solo letras y espacios ";
                    $name = "";
                }
                if (validar_tel($telefono) == false) {
                    $telefonoError = "Movil Invalido";
                    $telefono = "";
                }
                if (validar_contra($conta, $repeContra) == false) {
                    $contraError = " Las contraseñas no son iguales,vuelve a introducirlas";
                }
            }
        }
    ?>
        <div class="container-fluid ps-md-0">
            <div class="row g-0">
                <div class="d-none d-md-flex col-md-4 col-lg-6"></div>
                <div class="col-md-8 col-lg-6">
                    <div class="login d-flex align-items-center py-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-9 col-lg-8 mx-auto">
                                    <h3 class="login-heading mb-4">Inserte los datos del nuevo paciente</h3>

                                    <!-- Sign In Form -->
                                    <form action="#" method="POST">

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="dniUsuario" minlength="8" required value="<?php echo $dni ?>"><span><?php echo $dniError; ?></span>
                                            <label for="floatingInput">DNI</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="nombre" required value="<?php echo $name ?>"><span><?php echo $nombreError; ?></span>
                                            <label for="floatingInput">Nombre</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="ape" required value="<?php echo $ape ?>"><span><?php echo $apeError; ?></span>
                                            <label for="floatingInput">Apellidos</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="floatingInput" name="fechaNac" required value="<?php echo $nacimiento ?>"><span><?php echo $nacError; ?></span>
                                            <label for="floatingInput">Fecha Nacimiento</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="telefono" required value="<?php echo $telefono ?>"><span><?php echo $telefonoError; ?></span>
                                            <label for="floatingInput">Teléfono</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="direccion" required value="<?php echo $direccion ?>">
                                            <label for="floatingInput">Dirección</label>
                                        </div>
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

                                    <?php echo $introducidos; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    if ($_SESSION['action'] === 'agreAct') {
        $fechaError = $introducidos = $horaError = $hora = "";
        $fecha = "";
        if (isset($_POST["agregar"])) {
            $fecha = $_POST["fecha"];
            $hora = $_POST["hora"];
            function validar_fecha($fecha)
            {
                $hoy = date("Y-m-d");
                if ($hoy > $fecha) {
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
                $comprobarHora = 'SELECT horaActividad,fechaActividad FROM actividades WHERE dniVoluntario="' . $_POST["voluntario"] . '" AND fechaActividad="' . $_POST["fecha"] . '" AND horaActividad="' . $_POST["hora"] . '" ';
                $dato = mysqli_query($enlace, $comprobarHora);

                if (mysqli_num_rows($dato) === 0) {
                    $insertAct = "INSERT INTO actividades (id,tipoActividad,dniVoluntario,idAnimal,fechaActividad,horaActividad) 
                            VALUES (NULL,'{$_POST["actividad"]}','{$_POST["voluntario"]}','{$_POST["animal"]}','{$_POST["fecha"]}','{$_POST["hora"]}')";
                    $introducir = mysqli_query($enlace, $insertAct);
                    if (!$introducir) {
                        $introducidos = "Error: No se pudieron insertar los datos";
                    } else {
                        $introducidos = "Datos introducidos con exito";
                    }
                } else {
                    $introducidos = "Error: El voluntario con dni " . $_POST["voluntario"] . " ya tiene una actividad a la " . $_POST["hora"];
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
                                    <h3 class="login-heading mb-4">Inserte los datos del nuevo paciente</h3>
                                    <form action="#" method="POST">
                                        <?php
                                        $volun = 'SELECT dniUsuario,usuNombre,usuApell FROM usuarios WHERE usuTipo="Voluntario" ORDER BY usuApell';
                                        $dato = mysqli_query($enlace, $volun);
                                        $nConfig = mysqli_num_rows($dato);
                                        if ($nConfig != 0) {
                                        ?>
                                            <select name="voluntario" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                                <?php
                                                for ($i = 0; $i < $nConfig; $i++) {
                                                    $fila = mysqli_fetch_array($dato);
                                                ?>
                                                    <option value="<?php echo $fila['dniUsuario'] ?>"><?php echo $fila['usuApell'] . "," . $fila['usuNombre']; ?>
                                                    <?php
                                                }
                                                    ?>
                                            </select>
                                        <?php
                                        }
                                        $animal = 'SELECT idAnimal,aniNombre,aniEspecie FROM animales WHERE aniAdop="0"';
                                        $dato2 = mysqli_query($enlace, $animal);
                                        $nConfig2 = mysqli_num_rows($dato2);
                                        if ($nConfig2 != 0) {
                                        ?>
                                            <select name="animal" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                                <?php
                                                for ($i = 0; $i < $nConfig2; $i++) {
                                                    $fila2 = mysqli_fetch_array($dato2);
                                                ?>
                                                    <option value="<?php echo $fila2['idAnimal'] ?>"><?php echo $fila2['aniNombre'] . "(" . $fila2['aniEspecie'] . ")"; ?>
                                                    <?php
                                                }
                                                    ?>
                                            </select>
                                        <?php
                                        }
                                        ?>
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="floatingInput" name="fecha" required value="<?php echo $fecha ?>"><span><?php echo $fechaError; ?></span>
                                            <label for="floatingInput">Fecha</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="time" class="form-control" id="floatingInput" name="hora" required value="<?php echo $hora ?>"><span><?php echo $horaError; ?></span>
                                            <label for="floatingInput">Hora</label>
                                        </div>
                                        <?php
                                        $acti = 'SELECT * FROM tipoactividades';
                                        $dato3 = mysqli_query($enlace, $acti);
                                        $nConfig3 = mysqli_num_rows($dato3);
                                        if ($nConfig3 != 0) {
                                        ?>
                                            <select name="actividad" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                                <?php
                                                for ($i = 0; $i < $nConfig3; $i++) {
                                                    $fila3 = mysqli_fetch_array($dato3);
                                                ?>
                                                    <option value="<?php echo $fila3['idActividad'] ?>"><?php echo $fila3['nombreActividad']; ?>
                                                    <?php
                                                }
                                                    ?>
                                            </select>
                                        <?php
                                        }
                                        ?>
                                        <div class="d-grid">
                                            <input type="submit" name="agregar" value="Añadir" class="btn btn-lg btn-success btn-login text-uppercase fw-bold mb-2">

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
    }
    if ($_SESSION['action'] === 'agrAdopcion') {
        $apeError = $nombreError = $dniError = $introducidos = $nacimiento = $nacError = $telefonoError = $contraError = "";
        $name = $ape = $dni = $direccion = $telefono = $contra = $mensaje = "";

        if (isset($_POST["agregar"])) {
            $dni = $_POST["dniUsuario"];
            $nacimiento = $_POST["fechaNac"];
            $ape = $_POST["ape"];
            $name = $_POST["nombre"];
            $direccion = $_POST["direccion"];
            $telefono = $_POST["telefono"];


            function calculaedad($nacimiento)
            {
                list($ano, $mes, $dia) = explode("-", $nacimiento);
                $ano_diferencia  = date("Y") - $ano;
                $mes_diferencia = date("m") - $mes;
                $dia_diferencia   = date("d") - $dia;
                if ($dia_diferencia < 0 || $mes_diferencia < 0)
                    $ano_diferencia--;
                return $ano_diferencia;
            }

            function validar_nombre($name)
            {
                if (!preg_match("/^([a-zA-ZÀ-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?)*)+$/", $name)) {
                    return false;
                } else {
                    return true;
                }
            }

            function validar_ape($ape)
            {
                if (!preg_match("/^([a-zA-ZÀ-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?)*)+$/", $ape)) {
                    return false;
                } else {
                    return true;
                }
            }
            function validar_dni($dni)
            {
                if (!preg_match('/[0-9]{7,8}[A-Z]/', $dni)) {
                    return false;
                } else {
                    return true;
                }
            }


            function validar_fecha($nacimiento)
            {
                $edad = calculaedad($nacimiento);
                $hoy = date("Y-m-d");
                if ($hoy <= $nacimiento || 1900 > $nacimiento || $edad < 18) {
                    return false;
                } else {

                    return true;
                }
            }
            function validar_tel($telefono)
            {
                if (!preg_match("/^[0-9]{9}$/", $telefono)) {
                    return false;
                } else {
                    return true;
                }
            }
            if (validar_tel($telefono) == true && validar_fecha($nacimiento) == true && validar_dni($dni) == true && validar_ape($ape) == true && validar_nombre($name) == true) {
                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $contra = substr(str_shuffle($permitted_chars), 0, 20);
                $cifrada = hash_hmac('sha512', $contra, "primeraweb");
                $usuario = 'SELECT dniUsuario,usuPassword FROM usuarios WHERE dniUsuario="' . $_POST["dniUsuario"] . '"';
                $dato = mysqli_query($enlace, $usuario);


                if (mysqli_num_rows($dato) === 0) {

                    $fechaAct = date("Y-m-d");
                    $consulta = "INSERT INTO usuarios (dniUsuario,usuPassword,usuTipo,usuNombre,usuApell,usuTel,usuDir,fechaNac) 
              VALUES ('{$_POST["dniUsuario"]}','{$cifrada}','Adoptante','{$_POST["nombre"]}','{$_POST["ape"]}','{$_POST["telefono"]}','{$_POST["direccion"]}','{$_POST["fechaNac"]}')";
                    $introducir1 = mysqli_query($enlace, $consulta);

                    $insertAnimal = "INSERT INTO adopciones(idAdopcion,dniAdoptante,idAnimal,fechaAdop)
                    VALUES (NULL,'{$_POST["dniUsuario"]}','{$_POST["animal"]}','{$fechaAct}')";
                    $introducir2 = mysqli_query($enlace, $insertAnimal);

                    $editar = "UPDATE animales SET aniFechaAdop='$fechaAct',aniAdop='1'  WHERE idAnimal='  $_POST[animal] ' ";
                    $editAn = mysqli_query($enlace, $editar);


                    if (!$introducir1 || !$introducir2 || !$editAn) {
                        $introducidos = "Error: No se pudieron insertar los datos";
                    } else {
                        $introducidos = "Datos introducidos con exito<br>";
                        $mensaje = "Guarde la contraseña para el primero inicio de sesión.<br>Podrá cambiarla después de iniciar sesión: $contra";
                    }
                } else {
                    $dniError = "El DNI ya existe en la base de datos";
                }
            } else {
                if (validar_fecha($nacimiento) == false) {
                    if (calculaedad($nacimiento) < 18) {
                        $nacError = "Debe de ser mayor de 18 para poder adoptar";
                    } else {
                        $nacError = "Fecha incorrecta";
                        $nacimiento = "";
                    }
                }

                if (validar_dni($dni) == false) {
                    $dniError = "El DNI no es válido";
                    $dni = "";
                }
                if (validar_ape($ape) == false) {
                    $apeError = "Solo letras y espacios ";
                    $ape = "";
                }
                if (validar_nombre($name) == false) {
                    $nombreError = "Solo letras y espacios ";
                    $name = "";
                }
                if (validar_tel($telefono) == false) {
                    $telefonoError = "Movil Invalido";
                    $telefono = "";
                }
            }
        }
    ?>
        <div class="container-fluid ps-md-0">
            <div class="row g-0">
                <div class="d-none d-md-flex col-md-4 col-lg-6"></div>
                <div class="col-md-8 col-lg-6">
                    <div class="login d-flex align-items-center py-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-9 col-lg-8 mx-auto">
                                    <h3 class="login-heading mb-4">Inserte los datos de la adopción</h3>

                                    <!-- Sign In Form -->
                                    <form action="#" method="POST">

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="dniUsuario" minlength="8" required value="<?php echo $dni ?>"><span><?php echo $dniError; ?></span>
                                            <label for="floatingInput">DNI</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="nombre" required value="<?php echo $name ?>"><span><?php echo $nombreError; ?></span>
                                            <label for="floatingInput">Nombre</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="ape" required value="<?php echo $ape ?>"><span><?php echo $apeError; ?></span>
                                            <label for="floatingInput">Apellidos</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="floatingInput" name="fechaNac" required value="<?php echo $nacimiento ?>"><span><?php echo $nacError; ?></span>
                                            <label for="floatingInput">Fecha Nacimiento</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="telefono" required value="<?php echo $telefono ?>"><span><?php echo $telefonoError; ?></span>
                                            <label for="floatingInput">Teléfono</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="direccion" required value="<?php echo $direccion ?>">
                                            <label for="floatingInput">Dirección</label>
                                        </div>
                                        <?php
                                        $animal = 'SELECT idAnimal,aniNombre,aniEspecie FROM animales WHERE aniAdop="0"';
                                        $dato2 = mysqli_query($enlace, $animal);
                                        $nConfig2 = mysqli_num_rows($dato2);
                                        if ($nConfig2 != 0) {
                                        ?>
                                            <select name="animal" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                                <?php
                                                for ($i = 0; $i < $nConfig2; $i++) {
                                                    $fila2 = mysqli_fetch_array($dato2);
                                                ?>
                                                    <option value="<?php echo $fila2['idAnimal'] ?>"><?php echo $fila2['aniNombre'] . "(" . $fila2['aniEspecie'] . ")"; ?>
                                                    <?php
                                                }
                                                    ?>
                                            </select>
                                        <?php
                                        }
                                        ?>
                                        <div class="d-grid">
                                            <input type="submit" name="agregar" value="Añadir" class="btn btn-lg btn-success btn-login text-uppercase fw-bold mb-2">

                                        </div>
                                    </form>

                                    <?php echo $introducidos;
                                    echo $mensaje;
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    if ($_SESSION['action'] === 'visuRefugio') {
        $animales = 'SELECT * FROM animales WHERE aniAdop=0';
        $dato = mysqli_query($enlace, $animales);
        $nConfig = mysqli_num_rows($dato);

        if ($nConfig != 0) {
        ?>
            <div class="container mt-2">
                <table class="table">
                    <thead class="table-dark">
                        <td>Nombre</td>
                        <td>Especie</td>
                        <td>Sexo</td>
                        <td>Fecha Ingreso</td>
                        <td>Adoptado</td>
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
                            <td><?php echo $fila['aniFechaIngreso'] ?></td>
                            <td><?php echo "NO" ?></td>
                            <td><?php echo  "-" ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <br><br>
        <?php
        }
    }
    if ($_SESSION['action'] === 'visuTodo') {

        $animales = 'SELECT * FROM animales';
        $dato = mysqli_query($enlace, $animales);
        $nConfig = mysqli_num_rows($dato);

        if ($nConfig != 0) {

        ?>
            <div class="container mt-2">
                <table class="table">
                    <thead class="table-dark">
                        <td>Nombre</td>
                        <td>Especie</td>
                        <td>Sexo</td>
                        <td>Fecha Ingreso</td>
                        <td>Adoptado</td>
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
                            <td><?php echo $fila['aniFechaIngreso'] ?></td>
                            <?php
                            if ($fila['aniAdop'] === "0") { ?>
                                <td><?php echo "NO" ?></td>
                                <td><?php echo  "-" ?></td>
                            <?php
                            } else {
                            ?>
                                <td><?php echo "SI" ?></td>
                                <td><?php echo  $fila['aniFechaAdop'] ?></td>
                            <?php
                            }
                            ?>

                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <br><br>
    <?php
        }
    }
    ?>
</body>

<?php
functions::get_footer();
?>
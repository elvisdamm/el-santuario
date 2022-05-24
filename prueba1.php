<?php

require('functions.php');
functions::get_header();
?>

<body>



    <?php
    $enlace = mysqli_connect("localhost", "gerente", "gerente", "elsantuario");




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



    ?>
</body>
<?php
functions::get_footer();
?>
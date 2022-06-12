<?php

require('functions.php');
functions::get_header();


    $enlace = mysqli_connect("localhost", "voluntario", "voluntario", "elsantuario");


    
    if (isset($_POST["cambio"])) {
        $_SESSION["cambio"]=$_POST["cambio"];
        header("Location:cambio.php");
    }
    if ($_SESSION['action'] === 'verAnimalCargo') {
        $animales = 'SELECT aniNombre,aniEspecie,aniSexo,aniFechaIngreso FROM animales,actividades WHERE animales.idAnimal=actividades.idAnimal AND actividades.dniVoluntario="' . $_SESSION['dniUsuario'] . '"';
        $dato = mysqli_query($enlace, $animales);
        $nConfig = mysqli_num_rows($dato);

        if ($nConfig != 0) {
    ?>
            <div class="container  mb-5" >
            <h3 class="login-heading mt-5">Animales a cargo</h3>
                <table class="table mb-4">
                    <thead class="table-success">
                        <td>Nombre</td>
                        <td>Especie</td>
                        <td>Sexo</td>
                        <td>Fecha Ingreso</td>
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
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <br><br>
        <?php
        }
    } elseif ($_SESSION['action'] === 'verActividades') {


        $select = 'SELECT id,nombreActividad,aniNombre,fechaActividad,horaActividad FROM tipoactividades,actividades,animales WHERE actividades.tipoActividad= tipoactividades.idActividad AND actividades.dniVoluntario="' . $_SESSION["dniUsuario"] . '" AND animales.idAnimal=actividades.idAnimal';
        $dato = mysqli_query($enlace, $select);
        $nConfig = mysqli_num_rows($dato);

        if ($nConfig != 0) {
        ?>
            <div class="container mt-5">
            <h3 class="login-heading mb-4">Actividades</h3>
                <table class="table">
                    <thead class="table-success">
                        <td>Actividad</td>
                        <td>Animal</td>
                        <td>Fecha Actividad</td>
                        <td>Hora Actividad</td>
                        <td>Modificar Fecha/Hora</td>
                    </thead>
                    <?php
                    for ($i = 0; $i < $nConfig; $i++) {
                        $fila = mysqli_fetch_array($dato);

                    ?>
                        <tr>
                            <td><?php echo $fila['nombreActividad'] ?></td>
                            <td><?php echo $fila['aniNombre'] ?></td>
                            <td><?php echo $fila['fechaActividad'] ?></td>
                            <td><?php echo $fila['horaActividad'] ?></td>
                            <td>
                                <p>
                                <form action='#' method='POST'>
                                    <button type="submit" name="cambio" value="<?php echo implode(",", $fila); ?>" class="btn btn-lg btn-success btn-login text-uppercase fw-bold mb-2">Cambiar</button></p>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <br><br>
    <?php
        }else{

        }
        
    }



    ?>
</body>

<?php
functions::get_footer();
?>
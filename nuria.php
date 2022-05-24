<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .list-group a:hover {
            background-color: #0D6EFD;
            color: white;
        }
        body{
            text-align: center;
        }

        
    </style>
</head>

<body>
    <?php
    session_start();
    $dni="71907370D";
    $conection = mysqli_connect("localhost", "root", "", "kangoosanfer");
    $select = 'SELECT nombreAct,(SELECT nombre FROM clientes WHERE dni="' . $dni . '") AS nombreCliente,(SELECT nombreMonitor from monitores WHERE dni=dniMonitor) AS nombreMonitor from actividades WHERE dniCliente="' . $dni . '"';

    //var_dump($citasAtendidas);
    $consCitas = mysqli_query($conection, $citasAtendidas);
    $nConfig = mysqli_num_rows($consCitas);

    if ($nConfig != 0) {

    ?>
        <div class="container mt-2">
            <table class="table">
                <thead class="table-dark">
                    <td>Actividad</td>
                    <td>Monitor</td>
                    <td>Cliente</td>
                    
                </thead>
                <?php
                for ($i = 0; $i < $nConfig; $i++) {
                    $fila = mysqli_fetch_array($consCitas);
                ?>
                    <tr>
                        <td><?php echo $fila['nombreAct'] ?></td>
                        <td><?php echo $fila['nombreMonitor'] ?></td>
                        <td><?php echo $fila['nombreCliente'] ?></td>
                        
                    </tr>

                <?php
                } ?>
            </table>
        </div>
        <br><br>
    <?php

    }else{
        ?>
        <h4>No tienes citas aún</h4><?php
    }
    if (isset($_POST["atras"])) {
        header("Location:./paciente.php");
    } elseif (isset($_POST["cerrar"])) {
        session_destroy();
        header("Location:../login.php");
    }
    ?>
    <br><br>
    <form action="#" method="POST">
        <input type="submit" name="atras" value="Atrás" class="btn btn-lg btn-success btn-login text-uppercase fw-bold mb-2"> 
        <input type="submit" name="cerrar" value="Cerrar Sesion" class="btn btn-lg btn-success btn-login text-uppercase fw-bold mb-2">
        <br>
    </form>

</body>

</html>
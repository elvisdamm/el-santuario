<?php
session_start();
# definimos los valores iniciales para nuestro calendario
$month = date("n");
$year = date("Y");
$diaActual = date("j");
# Obtenemos el dia de la semana del primer dia
$meses = array(
    1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
    "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
);
$dias = array(1 => "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");

//definimos meses y años pasados, meses y años posteriores
if (!isset($_REQUEST["mes"])) $_REQUEST["mes"] = date("n");
if (!isset($_REQUEST["anio"])) $_REQUEST["anio"] = date("Y");

$month = $_REQUEST["mes"];
$year = $_REQUEST["anio"];

$prev_year = $year;
$next_year = $year;
$pasados = $year;
$futuros = $year;
$prev_month = $month - 1;
$next_month = $month + 1;

if ($prev_month == 0) {
    $prev_month = 12;
    $prev_year = $year - 1;
} elseif ($next_month == 13) {
    $next_month = 1;
    $next_year = $year + 1;
} else {
    $prev_month = $month - 1;
    $next_month = $month + 1;
    $pasados = $year - 1;
    $futuros = $year + 1;
}

if (isset($_POST['elegir'])) {
    //var_dump($_POST['elegir']);
    $_SESSION['elegir']  = $_POST['elegir'];
   
    header("Location:elegirActividad.php");
}
if (isset($_POST['cerrar'])) {
    session_destroy();
    header("Location:../index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        html {
            scroll-behavior: smooth;
        }

        /*       .navbar-light .nav-item:hover .nav-link {
        color: #f00;
}*/
        #flecha {
            transition: 0.4s ease-in-out;
        }

        #flecha:hover {
            transform: translateY(-10px);
        }

        .google-maps {
            position: relative;
            /*padding-bottom: 75%; // This is the aspect ratio*/
            height: 400px;
            overflow: hidden;
        }

        h3 {
            font-family: inherit;
            font-weight: 700;

        }

        .google-maps iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100% !important;
            height: 100% !important;
        }

        #icon {
            width: 50px;
        }

        body {
            font-family: Arial, calibri;
        }

        nav {
            font-weight: 700;
            font-family: Courier New;

        }

        #perfil {
            /*height: 20px;*/
            width: 35px;
            -webkit-filter: invert(1);
            filter: invert(1);
        }
    </style>
</head>

<body>
    <div id="arriba"></div>
    <div style="background-image: url(../imagenes/cal3.jpg); background-size: cover; background-repeat: no-repeat;">
        <nav style=" background-color:rgba(0, 0, 0, 0.3);" class="navbar navbar-expand-md navbar-light ">
            <img class="mt-1 ml-2" src="../imagenes/logo2.png" style="filter: invert(1);">

            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse bg-transparent" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
                        <a class="text-white nav-link  " href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-white nav-link " href="tarifas.php">Tarifas</a>
                    </li>
                    <li class="nav-item active">
                        <a class="text-white nav-link " href="calendario.php">Calendario</a>
                    </li>

                    <form method="POST" action="../index.php">
                        <button class="btn btn-danger mx-2">Cerrar Sesión</button>
                    </form>
                    <a href="perfil.php"><img class="mx-2" id="perfil" src="../imagenes/perfil.svg"></a>
                </ul>

            </div>
        </nav>
        <div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
            <div class="">
                <h1 style="font-weight: bold;background-color: rgba(0,0,0,0.4);
        " class="text-center text-white display-4  ">Calendario</h1>
            </div>
        </div>
    </div>

    <div class=" container">
        <h3 class="text-center mt-5 mb-3">Escoge un horario de entrenamiento </h3>
        <hr style="background-color: #549393; width: 35%;height:2.5px; margin: auto;" class="border-0 mb-4">
        <p class="text-justify text-center mb-5">En esta página, puede seleccionar la fecha y la hora de su
            entrenamiento. Simplemente elija un mes y un día de la semana adecuados.</p>
    </div>
    <?php
    $previo = $_SERVER['PHP_SELF'] . '?mes=' . $prev_month . '&anio=' . $prev_year . "#top";
    $antes = $_SERVER['PHP_SELF'] . '?anio=' . $pasados . "#top";
    $despues = $_SERVER['PHP_SELF'] . '?anio=' . $futuros . "#top";
    $next = $_SERVER["PHP_SELF"] . "?mes=" . $next_month . "&anio=" . $next_year . "#top";
    ?>
    <div class="d-flex align-middle justify-content-around mt-3">

        <a href="<?php echo $previo ?>"><img style="height:40px;" src="../imagenes/flechal.svg"></a>
        <h2 class="d-inline-block align-middle mb-4" id="month"><?php echo $meses[$month] . ", " . $year; ?></h2>
        <a href="<?php echo $next ?>"><img style="height:40px;" src="../imagenes/flechad.svg"></a>
    </div>
    <div class="d-flex justify-content-center">
        <table class="table-bordered">
            <thead>
                <tr class="text-center " id="weekHeader">
                    <th class="headerDay px-2" style="width: 13vw;">Lunes</th>
                    <th class="headerDay px-2" style="width: 13vw;">Martes</th>
                    <th class="headerDay px-2" style="width: 13vw;">Miércoles</th>
                    <th class="headerDay px-2" style="width: 13vw;">Jueves</th>
                    <th class="headerDay px-2" style="width: 13vw;">Viernes</th>
                    <th class="headerDay px-2" style="width: 13vw;">Sábado</th>
                    <th class="headerDay px-2" style="width: 13vw;">Domingo</th>

                </tr>
                <tr>
                    <?php
                    $diaSemana = date("w", mktime(0, 0, 0, $month, 1, $year)) + 7; //elimine $dia antes de $month
                    # Obtenemos el ultimo dia del mes
                    $ultimoDiaMes = date("d", (mktime(0, 0, 0, $month + 1, 1, $year) - 1));
                    $last_cell = $diaSemana + $ultimoDiaMes;
                    // hacemos un bucle hasta 43, que es el máximo de valores que puede
                    // haber... 6 columnas de 7 dias
                    for ($i = 1; $i <= 43; $i++) {
                        if ($i == $diaSemana) {
                            // determinamos en que dia empieza
                            //agregamos el dia semanal
                            $day = 1;
                        }
                        if ($i < $diaSemana || $i >= $last_cell) {
                            // celca vacia
                            echo "<td class='day pr-3 pb-5 pl-2 pt-1'> </td>";
                        } else {
                            $arrayFecha = array('dia' => $day, 'mes' => $meses[$month],'anio'=>$year);
                            // mostramos el dia
                            if ($day == $diaActual) {
                    ?>
                                <td class='day pr-3 pb-5 pl-2 pt-1'>
                                    <form method='POST' action='#'><?php echo $day; ?> <br />
                                        <button class='form-control p-1 mt-4' type='submit' name='elegir' value='<?php echo implode(",", $arrayFecha) ?>'>Elegir Actividad</button>
                                    </form>
                                </td>


                    <?php

                            } else{
                                ?>
                                <td class='day pr-3 pb-5 pl-2 pt-1'>
                                    <form method='POST' action='#'><?php echo $day; ?> <br />
                                        <button class='form-control p-1 mt-4' type='submit' name='elegir' value='<?php echo implode(",", $arrayFecha) ?>'>Elegir Actividad</button>
                                    </form>
                                </td>


                    <?php
                            }
                               
                            $day++;
                        }
                        // cuando llega al final de la semana, iniciamos una columna nueva
                        if ($i % 7 == 0) {
                            echo "</tr><tr>\n";
                        }
                    }
                    ?>

                </tr>

            </thead>
        </table>
    </div>
    <div class="google-maps mt-5">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2891.4992188165565!2d-5.935702884859944!3d43.55447977912482!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd369b7b9a6541ad%3A0x1480bc65581d0d2e!2sC.%20Fuero%20de%20Avil%C3%A9s%2C%2018%2C%2033401%20Avil%C3%A9s%2C%20Asturias!5e0!3m2!1ses!2ses!4v1648037454747!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

    </div>

    <div class="float-right" style="position: relative;">
        <div class=" text-right  mr-4 mt-4 " id="flecha">
            <a href="#arriba"><img src="../imagenes/flecha.png" alt="flecha"></a>
        </div>
    </div>

    <footer class="text-center   text-lg-start text-white " style="background-color:#549393 ;">
        <div class="container p-4 ">
            <div class="row">

                <div class="col-md-6  mt-3">
                    <h6 class="text-uppercase  font-weight-bold p-0 m-0">Contacto</h6>
                    <hr style="height:1px; margin: auto;" class="bg-white mb-4 w-25 mt-3">
                    <div class="text-left d-inline-block">
                        <p><img src="../imagenes/casa.png" class="btn ">C\ Fuero de Avilés,
                            Asturias</p>
                        <p><img src="../imagenes/gmail.png" class="btn ">kangoosanfer@gmail.com</p>
                        <p><img src="../imagenes/iphone.png" class="btn ">+34 654 231 123</p>

                    </div>
                </div>

                <hr style="height:1px; margin: auto;" class="bg-white mb-4 w-100 mt-3 d-md-none">

                <div class="col-md-6 mx-auto mt-3">
                    <h6 class="text-uppercase font-weight-bold">Redes Sociales</h6>
                    <hr style="height:1px; margin: auto;" class="bg-white mb-4 w-25 mt-3">
                    <div class=" mx-auto pt-4">
                        <img src="../imagenes/whatsapp1.png" class="btn ">
                        <img src="../imagenes/instagram.png" class="btn ">
                        <img src="../imagenes/facebook.png" class="btn">
                    </div>
                    <div class="mx-auto pt-4">
                        <img src="../imagenes/twitter.png" class="btn ">
                        <img src="../imagenes/linkedin.png" class="btn ">
                        <img src="../imagenes/youtube.png" class="btn">
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>

<?php

?>
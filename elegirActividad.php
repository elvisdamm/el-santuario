<?php

session_start();
$msg="";
$enlace = mysqli_connect("localhost", "root", "", "kangoosanfer");
$datos = explode(",", $_SESSION["elegir"]);
//var_dump($datos);
$day = $datos[0];
$month = $datos[1];
$year = $datos[2];
switch ($month) {
    case 'Enero';
        $month = 1;
        break;
    case 'Febrero';
        $month = 2;
        break;
    case 'Marzo';
        $month = 3;
        break;
    case 'Abril';
        $month = 4;
        break;
    case 'Mayo';
        $month = 5;
        break;
    case 'Junio';
        $month = 6;
        break;
    case 'Julio';
        $month = 7;
        break;
    case 'Agosto';
        $month = 8;
        break;
    case 'Septiembre';
        $month = 9;
        break;
    case 'Octubre';
        $month = 10;
        break;
    case 'Noviembre';
        $month = 11;
        break;
    case 'Diciembre';
        $month = 12;
        break;
    default;

        break;
}
if($day<10){
    $length = 2;
    $day = substr(str_repeat(0, $length).$day, - $length);
}

if ($month<10) {
    $length = 2;
    $month = substr(str_repeat(0, $length).$month, - $length);
}
$fecha = $diaSemana = date($year . "-" . $month . "-" . $day);

// $day= $_SESSION['day'];
// $mes = $_SESSION['mes'];
// echo $day;
// var_dump($day);
// var_dump($mes);
$conection = mysqli_connect("localhost", "root", "", "kangoosanfer");
$select = "SELECT * from monitores ";
$resultado = mysqli_query($conection, $select);
  $consulta = mysqli_num_rows($resultado);

$selectA = "SELECT * FROM actividades";
$resultadoA = mysqli_query($conection,$selectA);
$consultaA = mysqli_num_rows($resultadoA);


$selectHora= 'SELECT horaClase from actividades';
$resultadoHora= mysqli_query($conection,$selectHora);
$consultaH= mysqli_num_rows($resultadoHora);
 $_SESSION['dni']="71907370D";
if (isset($_POST['agregar'])) {
 $elegirActividad= "INSERT INTO elegiractividad (idelegiractividad,nombreActividad, monitor, horaClase, duracion, fecha, dniCliente) VALUES (NULL,'{$_POST["actividad"]}', '{$_POST["monitor"]}','{$_POST["horaClase"]}', '{$_POST["duracion"]}','{$_POST["fecha"]}', '{$_SESSION["dni"]}')";

   // $elegirActividad = "INSERT INTO actividadelegida (nombreActividad, monitor, horaClase, duracion, fecha, dniCliente) VALUES ('{$_POST["actividad"]}','{$_POST["monitor"]}','{$_POST["horaClase"]}','{$_POST["duracion"]}','{$_POST["fecha"]}','{$_SESSION['dni']}')";

$consultaAgregarActividad = mysqli_query($conection, $elegirActividad);

            if (!$consultaAgregarActividad) {
                $msg = "<br/>Error: No se pudieron insertar los datos";
            } else {
                $msg = "Datos intruducidos correctamente";
                
            }
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
        #perfil{
            /*height: 20px;*/
            width:35px;
            -webkit-filter: invert(1) ;
    filter: invert(1) ;
        }
    </style>
</head>

<body>
    <div id="arriba"></div>
    <div style="background-image: url(../imagenes/acti.jpeg); background-size: cover; background-repeat: no-repeat;">
        <nav style=" background-color:rgba(0, 0, 0, 0.3);" class= "navbar navbar-expand-md navbar-light ">
            <img class="mt-1 ml-2" src="../imagenes/logo2.png" style="filter: invert(1);">

            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div  class="collapse navbar-collapse bg-transparent" id="navbarSupportedContent">
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
        " class="text-center text-white display-4  ">Elegir actividad</h1>
            </div>
        </div>
    </div>


    <!-- Sign In Form -->
    <div class=" mt-3 container justify-content-center d-flex border">
    
        <form method="POST" action="#">
               <?php
            if ($consultaA > 0) {


            ?>
                <div class="form-floating mb-3 mt-5">
                    Actividad
                    <select name="actividad" class="form-control" id="exampleFormControlSelect1">
                        <?php
                        for ($i = 0; $i < $consultaA; $i++) {
                            $elementoA = mysqli_fetch_array($resultadoA);
                        ?>
                            <option value="<?php echo $elementoA['nombreAct']; ?>"><?php echo $elementoA['nombreAct'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            <?php
            }


            ?>
          
            <?php
            if ($consulta > 0) {
            ?>
                <div class="form-floating  mt-4 w-100 " >
                    Monitor <select name="monitor" class="form-control">
                        <?php
                        for ($i = 0; $i < $consulta; $i++) {
                            $elemento = mysqli_fetch_array($resultado);
                        ?>
                            <option style="width:100px" value="<?php echo $elemento['nombreMonitor'] ;?>"> <?php echo $elemento['nombreMonitor'] .' ' . $elemento['apellidos'];?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            <?php
            }


            ?>
            <?php
            if ($consultaH > 0) {
            ?>
                <div class="form-floating mb-3 mt-4 ">
                    Hora <select name="horaClase" class="form-control">
                        <?php
                        for ($i = 0; $i < $consultaH; $i++) {
                            $elementoh = mysqli_fetch_array($resultadoHora);
                        ?>
                            <option style="width:100px" value="<?php echo $elementoh['horaClase'] ;?>"> <?php echo $elementoh['horaClase']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            <?php
            }


            ?>
            <div class="form-floating mb-3 mt-4 ">
                    Duración 
                      <input required name="duracion" readonly=true type="text" class="form-control" id="floatingInput required" placeholder="duracion" value="1 hora">
                   
                </div>
             <div class="form-floating mb-3 mt-4">
                Fecha
                <input required name="fecha" readonly=true type="date" class="form-control" id="floatingInput required" value="<?php echo $fecha;?>">
            </div>
            <input type="submit" name="agregar" value="Añadir" class="btn btn-warning mt-4 w-100">
            <span><?php echo $msg; ?> </span>
        </form>
    </div>
  <div style="height:1em;" class="  mx-4 mt-4   " id="flecha">
            <a href="calendario.php" ><img  src="../imagenes/flechai.svg" alt="flecha" style="width: 5vh; float: left;"></a>
            <a href="#arriba"><img  style="width: 5vh; float: right;" src="../imagenes/flechaa.svg" alt="flecha"></a>
        </div>
    </div>
    <footer class="text-center   text-lg-start text-white " style="background-color:#549393 ;">
        <div class="container p-4 mt-5">
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


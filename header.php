<!DOCTYPE html>
<?php
session_start();

?>
<html lang="en">
<head>
  <title>El Santuario</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body{
      font-family: 'Trebuchet MS';
    }
  </style>
  
</head>



<header class="border-bottom topnavbar bg-success shadow-sm">
	<div class="container">
		<nav class="navbar navbar-expand-sm bg-success navbar-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="index.php">
					<img src="imagenes/logo.png" alt="Avatar Logo" style="width:40px;">
					El Santuario
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>

			<div class="collapse navbar-collapse" id="mynavbar">
				<ul class="navbar-nav me-auto">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Inicio</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="actividades.php">Actividades</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="instalaciones.php">Instalaciones</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="contacto.php">Contacto</a>
					</li>
					
					<?php
					if (!isset($_SESSION['logueado'])) {
					?>
						<li class="nav-item">
							<a class="nav-link" href="login.php">Login</a>
						</li>
					<?php
					}
					if (isset($_SESSION['logueado'])) {
					?>
						<li class="nav-item">
							<a class="nav-link" href="perfil.php">Perfil</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="cerrar.php">Cerrar sesión</a>
						</li>
					<?php
					}
					?>
				</ul>

			</div>
		</nav>
	</div>
</header>
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


</head>
<style>
html,
body {
    height: 100%;
	margin: 0;
	padding: 0;
    /* The html and body elements cannot have any padding or margin. */
}

/* Wrapper for page content to push down footer */
#wrap {
    min-height: calc(100% - 250px);
    height: auto !important;
    height: 100%;
    /* Negative indent footer by it's height */
    margin: 0 auto;
}

footer{
	height: 250px;
	width: 100%;
}



/* Lastly, apply responsive CSS fixes as necessary */
@media (max-width: 1200px) {
    footer {
        margin-left: 0;
        margin-right: 0;
        padding-left: 20px;
        padding-right: 20px;
    }
}
</style>

<body>
<div id="wrap">
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
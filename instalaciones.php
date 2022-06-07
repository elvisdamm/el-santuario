<?php

require('functions.php');
functions::get_header();
?>

<div class="div-contenedor ">
  <h1 class="text-center text-success mt-3">INSTALACIONES</h1>
  <hr>

  <div class="container-lg my-3">
    <div id="myCarousel" class="carousel carousel-dark slide" data-bs-ride="carousel">

      <ol class="carousel-indicators">
        <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li>
      </ol>

      <div class="carousel-inner">
        <div class="carousel-item active" style="max-height: 500px">
          <img src="imagenes/instalaciones.jpg" class="d-block w-100" alt="Slide 1">
          <div class="carousel-caption d-none d-md-block">
            <h5>Zona 1</h5>

          </div>
        </div>
        <div class="carousel-item" style="max-height: 500px">
          <img src="imagenes/instalaciones2.jpg" class="d-block w-100" alt="Slide 2">
          <div class="carousel-caption d-none d-md-block">
            <h5>Zona2</h5>
          </div>
        </div>
        <div class="carousel-item" style="max-height: 500px">
          <img src="imagenes/instalaciones3.jpg" class="d-block w-100" alt="Slide 3">
          <div class="carousel-caption d-none d-md-block">
            <h5>Zona 3</h5>

          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>
  </div>


  <p class="m-2">
    Debido al alto incremento de abandono de mascotas en los últimos años nos hemos visto en la necesidad y obligación
    de hacer una gran ampliación de nuestras instalaciones para aumentar nuestra ayuda. Actualmente tenemos 4 salas interiores con puertas al exterior para que los gatos se sientan como en libertad.
    20 habitáculos para perros,2 clínicas veterinarias,oficinas y un gran área de terreno para que los animales se sientan libres y en las que se hacen ciertas actividades
  </p>
  <hr>


<?php
functions::get_footer();
?>
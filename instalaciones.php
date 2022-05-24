<?php 

	require('functions.php');
	functions::get_header();
?>
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
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo, ex quis odio dolorem at optio ab
    voluptatibus, laborum quia rem officia veritatis omnis ut laudantium voluptatum id culpa commodi
    veniam corrupti distinctio recusandae assumenda! Cupiditate, qui quisquam repudiandae aperiam
    sequi
    nam explicabo iure commodi cum voluptas officiis eligendi atque veritatis quod voluptate
    sapiente
    omnis perferendis tempora. Reiciendis suscipit saepe, est a, nemo quos fugiat quam deserunt
    libero,
    ipsum atque eum exercitationem tenetur! Modi est soluta molestiae vero veniam pariatur maxime
    provident inventore fuga reprehenderit unde culpa doloribus dolores aperiam laudantium similique
    sunt assumenda, ipsum commodi laboriosam sapiente iusto ipsa porro.
  </p>
  <hr>
  <?php 
  functions::get_footer();
  ?>
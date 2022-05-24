<?php

require('functions.php');
functions::get_header();
?>

<body>
    <div class="container-fluid mb-5">
        <div class="row">
            <h1 class="text-center text-success">CONTACTO</h1>
            <hr>
            <div class="col col-xl-4 mt-5">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-success">Dónde Encontrarnos</h5>
                        <hr>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2354.276073105539!2d-5.925168685124343!3d43.52455986875854!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x98e42a844815494a!2zNDPCsDMxJzI4LjQiTiA1wrA1NScyMi43Ilc!5e1!3m2!1ses!2ses!4v1648150526474!5m2!1ses!2ses" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>


            <div class="col col-xl-8 mt-5 mb-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="h1-responsive font-weight-bold text-center my-4 text-success">Contacta con nosotros</h2>
                        <hr>
                        <div class="row">
                            <div class="col-md-9 mb-md-0 mb-5">
                                <form id="contact-form" name="contact-form" action="mail.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="md-form mb-0">
                                                <label for="name" class="">Nombre</label>
                                                <input type="text" id="name" name="name" class="form-control">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="md-form mb-0">
                                                <label for="email" class="">Email</label>
                                                <input type="text" id="email" name="email" class="form-control">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="md-form">
                                                <label for="message">Your message</label>
                                                <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>

                                            </div>

                                        </div>
                                    </div>

                                </form>

                                <div class="text-center text-md-left mt-2">
                                    <a class="btn btn-success" onclick="document.getElementById('contact-form').submit();">Enviar</a>
                                </div>
                                <div class="status"></div>
                            </div>
                            <div class="col-md-3 text-center">
                                <ul class="list-unstyled mb-0">

                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
                                            <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z" />
                                            <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                        </svg></i>
                                        <p>+ 34 666 777 888</p>
                                    </li>

                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-inbox" viewBox="0 0 16 16">
                                            <path d="M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4H4.98zm9.954 5H10.45a2.5 2.5 0 0 1-4.9 0H1.066l.32 2.562a.5.5 0 0 0 .497.438h12.234a.5.5 0 0 0 .496-.438L14.933 9zM3.809 3.563A1.5 1.5 0 0 1 4.981 3h6.038a1.5 1.5 0 0 1 1.172.563l3.7 4.625a.5.5 0 0 1 .105.374l-.39 3.124A1.5 1.5 0 0 1 14.117 13H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .106-.374l3.7-4.625z" />
                                        </svg></i>
                                        <p>elsantuario@gmail.com</p>
                                    </li>
                                </ul>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
<?php
functions::get_footer();
?>
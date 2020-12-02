<?php
  require 'Php/dbOrlando.php';
  session_start();
  error_reporting(0);
  $varSesion = $_SESSION['usuario'];
  $varSesionTipo =  $_SESSION['tipo'];
  $varTituloNoticia = $_SESSION['noticia'];

  $query= "call sp_noticiaParaRevision('$varTituloNoticia');";
  $result = mysqli_query($con, $query) or die("Fail Noticia");
  $data = $result->fetch_assoc();
  $con->close();

  require 'Php/dbOrlando.php';
  $query2= "call sp_imagenesParaRevision('$varTituloNoticia');";
  $result = mysqli_query($con, $query2) or die("Fail Imagen");
  for ($set = array (); $row = $result->fetch_assoc(); $set[] = $row);
  $con->close();

  require 'Php/dbOrlando.php';
  $query3= "call sp_videosParaRevision('$varTituloNoticia');";
  $result2 = mysqli_query($con, $query3) or die("Fail Imagen");
  for ($set2 = array (); $row2 = $result2->fetch_assoc(); $set2[] = $row2);
  $con->close();

  echo $data['autorNombre'];
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="noticia_style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>NOTICIA</title>
</head>

<body>
    <!-- HEADER -->
    <section class="container-fluid slider d-flex justify-content-center align-items-center">
        <img src="Imagenes/Header.jpg" class="img-fluid" alt="Responsive image">
    </section>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-info bg-dark navbar-toggleable-md sticky-top">
        <a class="navbar-brand" href="index.html">
            <img src="https://yt3.ggpht.com/a/AATXAJxZMZ0mKBqkcFUcoXXapAjbD0FjYbgDTe3yNCPyZA=s900-c-k-c0xffffffff-no-rj-mo"
                width="30" height="30" class="d-inline-block align-top" alt="Logo-Boostrap">
            3DJuegos
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <div class="navbar-nav mr-auto ml-auto text-center categoria">
                <a class="nav-item nav-link active" href="index.php">Inicio</a>

            </div>
            <form class="mx-2 my-auto d-inline w-40">
                <div class="input-group">
                    <input type="text" class="form-control border border-right-0" placeholder="Search...">
                    <span class="input-group-append">
                        <a href="busqueda.html" class="btn btn-outline-secondary border border-left-0" type="button">
                            <i class="fa fa-search"></i>
                        </a>
                    </span>
                </div>
            </form>
            <div class="d-flex flex-row justify-content-center">
                <a href="crearNoticia.html" class="btn btn-success  mr-2">Crear Noticia</a>
                <a href="inicioSesion.html" class="btn btn-danger  mr-2">Login</a>
                <a href="registroUsuario.html" class="btn btn-danger">Registrarse</a>
            </div>
        </div>
    </nav>

    <!-- Noticias -->
    <form action="" method="post">
        <div class="container-lg my-4 bg-white rounded">
            <h3 class="Encabezado mt-2" style="padding-top:15px"><?php echo $data['titulo'] ?></h3>
            <p class="Sinopsis mt-3"><?php echo $data['sinopsis'] ?></p>
            <div class="bd-highlight text-right text-danger">
                <?php echo 'Por '.$data['autorNombre'].' / '.$data['fechaCreacion'] ?></div>
            <div class="d-flex flex-row mt-3">
                <a href="inicioSesion.html" class="btn btn-info  mr-2"><i class="fa fa-twitter"></i> Twittear</a>
                <a href="registroUsuario.html" class="btn btn-primary"><i class="fa fa-facebook"></i> Compartir</a>
            </div>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner mt-4">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src=<?php echo 'multimedia/'.$set[0]['imagenFile']?>
                            alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src=<?php echo 'multimedia/'.$set[1]['imagenFile']?>
                            alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src=<?php echo 'multimedia/'.$set[2]['imagenFile']?>
                            alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="Texto" style="padding-bottom:15px">
                <p>
                    <?php echo $data['texto'] ?>
                </p>
                <div class="embed-responsive embed-responsive-16by9">
                    <video controls>
                        <source src=<?php echo 'multimedia/'.$set2[0]['videoFile']?> type="video/mp4">
                    </video>
                </div>
                <div class="form-group" style="padding-top: 15px;">
                    <label for="exampleFormControlTextarea1">Comentarios</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="textoBox"
                        required><?php echo $data['comentarioEditor'] ?></textarea>
                </div>
            </div>
            <div class="Like d-flex bd-highlight" style="padding-bottom:15px">
                <button class="btn btn-success p-2 mr-2" name="aceptarNoticia">Aceptar</button>
                <button class="btn btn-danger p-2" name="devolverNoticia">Devolver</button>
                <!-- <button class="btn btn-primary ml-auto"><i class="fa fa-thumbs-up"> Like</i> </button> -->
            </div>
        </div>
    </form>


    <div class="p-1 mt-3 mb-3 bg-danger text-white text-center">
        <h2>Tendencias</h2>
    </div>

    <!-- Deck de cartas -->
    <div class="card-deck mt-4" style="width: fit-content;">
        <div class="card text-white bg-dark">
            <img class="card-img-top" src="Imagenes/Crash.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional
                    content. This content is a little bit longer.</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
                <a href="noticia.html" class="btn btn-danger  mr-2" style="float: right;">Ver más</a>
            </div>
        </div>
        <div class="card text-white bg-dark">
            <img class="card-img-top" src="Imagenes/GOT.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
                <a href="noticia.html" class="btn btn-danger  mr-2" style="float: right;">Ver más</a>
            </div>
        </div>
        <div class="card text-white bg-dark">
            <img class="card-img-top" src="Imagenes/SpiderMan.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                    content.
                    This card has even longer content than the first to show that equal height action.</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
                <a href="noticia.html" class="btn btn-danger  mr-2" style="float: right;">Ver más</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="section footer-classic context-dark bg-image mt-3 border-top border-danger"
        style="background: #2b2b2b;">
        <div class="container">
            <div class="row row-30 mt-1">
                <div class="col-md-4 col-xl-5">
                    <div class="pr-xl-4"><a class="brand" href="index.html"><img class="brand-logo-light"
                                src="Imagenes/Header.jpg" alt="" width="140" height="37">
                        </a>
                        <p>Proyecto de Base de datos multimedia a cargo de Rodrigo Yap y Orlando Gámez.</p>
                        <!-- Rights-->
                        <p class="rights"><span>©  </span><span
                                class="copyright-year">2020</span><span> </span><span>BDM</span><span>. </span><span>All
                                Rights
                                Reserved.</span></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Contacts</h5>
                    <dl class="contact-list">
                        <dt>Direccion:</dt>
                        <dd>Avenida siempre viva 2020</dd>
                    </dl>
                    <dl class="contact-list">
                        <dt>Integrantes:</dt>
                        <dd><a href="mailto:#">Edgar Orlando Gámez Guerrero 1837511</a></dd>
                        <dd><a href="mailto:#">Rodrigo Alejandro Yap Guerrero 1681295</a></dd>
                    </dl>
                </div>
                <div class="col-md-4 col-xl-3">
                    <h5>Links</h5>
                    <ul class="nav-list">
                        <li><a href="https://www.facebook.com/orlandogamez17/">Facebook <i
                                    class="fa fa-facebook-square"></i></a>
                        </li>
                        <li><a href="https://www.instagram.com/orla_g4/?hl=es-la">Instagram <i
                                    class="fa fa-instagram"></i></a></li>
                        <li><a href="https://www.twitch.tv/17danko">Twitch <i class="fa fa-twitch"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="navbarSeccion.js"></script>
</body>

</html>

<?php
include('Php/dbOrlando.php');

    if($con) {
        //if connection has been established display connected.
        }
        //if button with the name uploadfilesub has been clicked
    if(isset($_POST['devolverNoticia'])) {
        //declaring variables
        $comentarioActualizado = $_POST['textoBox'];

        //inserting image details (ie image name) in the database
        $noticiaUpdate = "call sp_updateComentarioAdmin('$varTituloNoticia', '$comentarioActualizado')";

        $qry = mysqli_query($con,  $noticiaUpdate);

        if( $qry) {
          $yourURL="aceptarNoticia.php";
            echo ("<script>location.href='$yourURL'</script>");
        } else {
          echo "no se pudo actualizar el comentario";
        }
      }

      if(isset($_POST['aceptarNoticia'])) {
        //declaring variables

        //inserting image details (ie image name) in the database
        $noticiaUpdate = "call sp_aceptarNoticia('$varTituloNoticia')";

        $qry = mysqli_query($con,  $noticiaUpdate);

        if( $qry) {
          $yourURL="aceptarNoticia.php";
            echo ("<script>location.href='$yourURL'</script>");
        } else {
          echo "no se pudo actualizar el comentario";
        }
      }

    $con->close();
?>
<?php
  require 'Php/dbOrlando.php';
  session_start();
  error_reporting(0);
  $varSesion = $_SESSION['usuario'];
  $varSesionTipo =  $_SESSION['tipo'];
  $noticiaId = $_GET['idNoticia'];

  $query= "call sp_NoticiasUnica('$noticiaId')";
  $result = mysqli_query($con, $query) or die("Fail");
  $data = $result->fetch_assoc();
  $con -> close();

  require 'Php/dbOrlando.php';
  $queryImagen= "call sp_imagenesUnica('$noticiaId');";
  $resultImagen = mysqli_query($con, $queryImagen) or die("Fail Noticia Regular");
  for ($set = array (); $row = $resultImagen->fetch_assoc(); $set[] = $row);
  $con->close();

  require 'Php/dbOrlando.php';
  $queryVideo= "call sp_videosUnica('$noticiaId')";
  $resultVideo = mysqli_query($con, $queryVideo) or die("Fail");
  $videoData = $resultVideo->fetch_assoc();
  $con -> close();

  require 'Php/dbOrlando.php';
  $queryNotReg= "call sp_NoticiasRegulares();";
  $result2 = mysqli_query($con, $queryNotReg) or die("Fail Noticia Regular");
  for ($set2 = array (); $row2 = $result2->fetch_assoc(); $set2[] = $row2);
  $con->close();

  require 'Php/dbOrlando.php';
  $queryImgReg= "call sp_imagenesRegulares();";
  $result4 = mysqli_query($con, $queryImgReg) or die("Fail Imagen Especial");
  for ($set4 = array (); $row4 = $result4->fetch_assoc(); $set4[] = $row4);
  $con->close();

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
    <?php
        echo "<input type='hidden' id='noticiaID' value='$noticiaId'>";
    ?>
    <!-- HEADER -->
    <section class="container-fluid slider d-flex justify-content-center align-items-center">
        <img src="Imagenes/Header.jpg" class="img-fluid" alt="Responsive image">
    </section>

    <!-- NAVBAR SIN USUARIO -->
    <div class="navbarSinUsuario" id="navbarSinUsuario">
        <nav class="navbar navbar-expand-sm navbar-dark bg-info bg-dark navbar-toggleable-md sticky-top">
            <a class="navbar-brand" href="index.php">
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
                            <a href="busqueda.html" class="btn btn-outline-secondary border border-left-0"
                                type="button">
                                <i class="fa fa-search"></i>
                            </a>
                        </span>
                    </div>
                </form>
                <div class="d-flex flex-row justify-content-center">
                    <a href="inicioSesion.html" class="btn btn-danger  mr-2">Login</a>
                    <a href="registroUsuario.php" class="btn btn-danger">Registrarse</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- NAVBAR CON USUARIO NORMAL-->
    <div class="navbarUsuario" id="navbarUsuario">
        <nav class="navbar navbar-expand-sm navbar-dark bg-info bg-dark navbar-toggleable-md sticky-top">
            <a class="navbar-brand" href="index.php">
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
                            <a href="busqueda.html" class="btn btn-outline-secondary border border-left-0"
                                type="button">
                                <i class="fa fa-search"></i>
                            </a>
                        </span>
                    </div>
                </form>
                <div class="d-flex flex-row justify-content-center">
                    <a href="perfilUsuario.php" class="btn btn-success  mr-2">Editar Perfil</a>
                    <a href="Php/cerrarSesion.php" class="btn btn-warning  mr-2">Cerrar Sesion</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- NAVBAR CON USUARIO REPORTERO-->
    <div class="navbarUsuarioRepprtero" id="navbarUsuarioReportero">
        <nav class="navbar navbar-expand-sm navbar-dark bg-info bg-dark navbar-toggleable-md sticky-top">
            <a class="navbar-brand" href="index.php">
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
                            <a href="busqueda.html" class="btn btn-outline-secondary border border-left-0"
                                type="button">
                                <i class="fa fa-search"></i>
                            </a>
                        </span>
                    </div>
                </form>
                <div class="d-flex flex-row justify-content-center">
                    <a href="aceptarNoticiaR.php" class="btn btn-success  mr-2">Administrar</a>
                    <a href="crearNoticia.php" class="btn btn-success  mr-2">Crear Noticia</a>
                    <a href="perfilUsuario.php" class="btn btn-success  mr-2">Editar Perfil</a>
                    <a href="Php/cerrarSesion.php" class="btn btn-warning  mr-2">Cerrar Sesion</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- NAVBAR CON USUARIO ADMIN-->
    <div class="navbarUsuarioAdmin" id="navbarUsuarioAdmin">
        <nav class="navbar navbar-expand-sm navbar-dark bg-info bg-dark navbar-toggleable-md sticky-top">
            <a class="navbar-brand" href="index.php">
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
                            <a href="busqueda.html" class="btn btn-outline-secondary border border-left-0"
                                type="button">
                                <i class="fa fa-search"></i>
                            </a>
                        </span>
                    </div>
                </form>
                <div class="d-flex flex-row justify-content-center">
                    <a href="aceptarNoticia.php" class="btn btn-danger  mr-2">Administrar</a>
                    <a href="cambiarUsuario.php" class="btn btn-danger  mr-2">Cambiar</a>
                    <a href="Php/cerrarSesion.php" class="btn btn-warning  mr-2">Cerrar Sesion</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Noticias -->
    <div class="container-lg my-4 bg-white rounded">
        <h3 class="Encabezado mt-2" style="padding-top:15px"><?php echo $data['titulo'] ?></h3>
        <p class="Sinopsis mt-3"><?php echo $data['sinopsis'] ?></p>
        <div class="bd-highlight text-right text-danger">
            <?php echo 'Por '.$data['Autor'].' / '.$data['fechaCreacion'] ?></div>
        <div class="d-flex flex-row mt-3">
            <a href="inicioSesion.html" class="btn btn-info  mr-2"><i class="fa fa-twitter"></i> Twittear</a>
            <a href="registroUsuario.html" class="btn btn-primary"><i class="fa fa-facebook"></i> Compartir</a>
        </div>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner mt-4">
                <div class="carousel-item active">
                    <img class="d-block w-100" src=<?php echo 'multimedia/'.$set[0]['imagenFile']?> alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src=<?php echo 'multimedia/'.$set[1]['imagenFile']?> alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src=<?php echo 'multimedia/'.$set[2]['imagenFile']?> alt="Third slide">
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
                    <source src=<?php echo 'multimedia/'.$videoData['videoFile']?> type="video/mp4">
                </video>
            </div>
        </div>

        <div class="Like d-flex bd-highlight" style="padding-bottom:15px">
            <button class="btn btn-primary ml-auto"><i class="fa fa-thumbs-up"> Like</i> </button>
        </div>

        <form action="Php/addComentarios.php" method="post" class="addComment" name="addComment">
            <?php
                echo "<input type='hidden' name='noticia' value='$noticiaId'>";
                echo "<input type='hidden' name='usuario' value='$varSesion'>";
            ?>
            <div class="form-group mt-5">
                <label for="textoComentario">Comentar</label>
                <textarea class="form-control" id="textoComentario" rows="3"
                    name="textoComentario"></textarea>
            </div>

            <div class="Like d-flex bd-highlight" style="padding-bottom:15px">
                <button class="btn btn-primary ml-auto" type="submit"><i class="fa fa-pencil" onclick="location.href='./noticia.php?idNoticia= <?php echo $noticiaId; ?> ';"> Comentar</i> </button>

                <!-- <input type="submit" value="Comentar" class="btn btn-primary ml-auto"
                                    onclick="location.href='aceptarNoticia.php';"> 
                                    -->

            </div>
        </form>
        <div id="seccionComentarios">
        </div>

    </div>

    <div class="p-1 mt-3 mb-3 bg-danger text-white text-center">
        <h2>Otras Noticias</h2>
    </div>

    <!-- Deck de cartas -->
    <form action="" method="post">
        <div class="card-deck mt-4" style="width: fit-content;">
            <div class="card text-white bg-dark">
                <img class="card-img-top" src=<?php echo 'multimedia/'.$set4[2]['imagenFile']?> alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $set2['0']['titulo'] ?></h5>
                    <p class="card-text"><?php echo $set2['0']['sinopsis'] ?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted"><?php echo $set2['0']['fechaCreacion'] ?></small>
                    <!-- <button class="btn btn-danger botonRegular1 mr-2" style="float: right;" name="botonRegular1">Ver más</button> -->
                    <a href='./noticia.php?idNoticia= <?php echo $set2['0']['noticiaId'] ?>'
                        class='btn btn-danger botonRegular1 mr-2' style="float: right;" name='botonRegular3'>Ver más</a>
                </div>
            </div>
            <div class="card text-white bg-dark">
                <img class="card-img-top" src=<?php echo 'multimedia/'.$set4[5]['imagenFile']?> alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $set2['1']['titulo'] ?></h5>
                    <p class="card-text"><?php echo $set2['1']['sinopsis'] ?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted"><?php echo $set2['1']['fechaCreacion'] ?></small>
                    <!-- <button class="btn btn-danger botonRegular1 mr-2" style="float: right;" name="botonRegular2">Ver más</button> -->
                    <a href='./noticia.php?idNoticia= <?php echo $set2['1']['noticiaId'] ?>'
                        class='btn btn-danger botonRegular1 mr-2' style="float: right;" name='botonRegular3'>Ver más</a>
                </div>
            </div>
            <div class="card text-white bg-dark">
                <img class="card-img-top" src=<?php echo 'multimedia/'.$set4[8]['imagenFile']?> alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $set2['2']['titulo'] ?></h5>
                    <p class="card-text"><?php echo $set2['2']['sinopsis'] ?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted"><?php echo $set2['2']['fechaCreacion'] ?></small>
                    <!-- <button class="btn btn-danger botonRegular1 mr-2" style="float: right;" name="botonRegular3">Ver más</button> -->
                    <a href='./noticia.php?idNoticia= <?php echo $set2['2']['noticiaId'] ?>'
                        class='btn btn-danger botonRegular1 mr-2' style="float: right;" name='botonRegular3'>Ver más</a>
                </div>
            </div>
        </div>
    </form>

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
    <script src="Comentarios.js"></script>

</body>

<?php
if ($varSesion == null || $varSesion = '') {
?>
<script type='text/javascript'>
$(document).ready(function() {
    $("#navbarUsuario").hide();
    $("#navbarUsuarioReportero").hide();
    $("#navbarUsuarioAdmin").hide();
});
</script>
<?php
}

if ($varSesionTipo == 'Usuario') {
?>
<script type='text/javascript'>
$(document).ready(function() {
    $("#navbarSinUsuario").hide();
    $("#navbarUsuarioReportero").hide();
    $("#navbarUsuarioAdmin").hide();
});
</script>
<?php
}

if ($varSesionTipo == 'Reportero') {
?>
<script type='text/javascript'>
$(document).ready(function() {
    $("#navbarSinUsuario").hide();
    $("#navbarUsuario").hide();
    $("#navbarUsuarioAdmin").hide();
});
</script>
<?php
}

if ($varSesionTipo == 'Admin') {
?>
<script type='text/javascript'>
$(document).ready(function() {
    $("#navbarSinUsuario").hide();
    $("#navbarUsuario").hide();
    $("#navbarUsuarioReportero").hide();
});
</script>
<?php
}
?>

</html>

<?php
  if(isset($_POST['botonRegular1'])) {
    session_start();
    error_reporting(0);
    $_SESSION['usuario'] = $varSesion;
    $_SESSION['tipo'] = $varSesionTipo;
    // $_SESSION['id'] = $set2[0]['noticiaId'];

    $yourURL="noticia.php";
    echo ("<script>location.href='$yourURL'</script>");
  }

  if(isset($_POST['botonRegular2'])) {
    session_start();
    error_reporting(0);
    $_SESSION['usuario'] = $varSesion;
    $_SESSION['tipo'] = $varSesionTipo;
    // $_SESSION['id'] = $set2[1]['noticiaId'];

    $yourURL="noticia.php";
    echo ("<script>location.href='$yourURL'</script>");
  }

  if(isset($_POST['botonRegular3'])) {
    session_start();
    error_reporting(0);
    $_SESSION['usuario'] = $varSesion;
    $_SESSION['tipo'] = $varSesionTipo;
    // $_SESSION['id'] = $set2[2]['noticiaId'];

    $yourURL="noticia.php";
    echo ("<script>location.href='$yourURL'</script>");
  }


    if(!isset($_SESSION['usuario'])){
        echo "<script>toggleDisable();</script>";
        //echo "<script>console.log('$varSesion')</script>";
    }
    
?>
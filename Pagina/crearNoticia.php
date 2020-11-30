<?php
    require 'Php/dbOrlando.php';
    session_start();
    error_reporting(0);
    
    $varSesion = $_SESSION['usuario'];
    $varSesionTipo =  $_SESSION['tipo'];
  
    $fillCat = "CALL sp_llenarCategorias()";
    $sqlquery = mysqli_query($con,  $fillCat) or die('FALLO DE CATEGORIA');
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="crearNoticia.css">
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
            <div class="navbar-nav mr-auto ml-auto text-center">
                <a class="nav-item nav-link active" href="index.html">Inicio</a>
                <a class="nav-item nav-link active" href="#">PC</a>
                <a class="nav-item nav-link active" href="#">PS5</a>
                <a class="nav-item nav-link active" href="#">PS4</a>
                <a class="nav-item nav-link active" href="#">XSeries</a>
                <a class="nav-item nav-link active" href="#">XOne</a>
                <a class="nav-item nav-link active" href="#">Switch</a>
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
                <a href="perfilUsuario.php" class="btn btn-success  mr-2">Editar Perfil</a>
                <a href="Php/cerrarSesion.php" class="btn btn-warning  mr-2">Cerrar Sesion</a>
            </div>
        </div>
    </nav>

    <!-- Creacion -->
    <div class="container-lg my-4 bg-white rounded">
        <form form action="" method="post" enctype="multipart/form-data">
            <div class="form-group" style="padding-top: 15px;">
                <label for="exampleFormControlInput1">Titulo</label>
                <input type="text" class="form-control" id="exampleFormControlInput1"
                    placeholder="Ingrese un titulo para la noticia" name="tituloBox" required>
            </div>
            <div class="form-group" style="padding-top: 15px;">
                <label for="exampleFormControlInput1">Sinopsis</label>
                <input type="text" class="form-control" id="exampleFormControlInput1"
                    placeholder="Ingrese una Sinopsis para la noticia" name="sinopsisBox" required>
            </div>
            <div class="form-group">
                <label for="categoBox">Categoria</label>
                <select class="form-control" id="categoBox" name="categoBox">
                    <?php
                        while($row = mysqli_fetch_array($sqlquery)){
                            ?>
                    <option value="<?=$row["nombre"];?>"><?=$row["nombre"];?></option>
                    <?php
                        }
                        mysqli_close($con);
                    ?>
                </select>
            </div>
            <div class="form-group" style="padding-top: 15px;">
                <label for="exampleFormControlTextarea1">Texto</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="textoBox"
                    required></textarea>
            </div>
            <div class="form-group" style="padding-top: 15px;">
                <label for="exampleFormControlInput1">PalabraClave1</label>
                <input type="text" class="form-control" id="exampleFormControlInput1"
                    placeholder="Ingrese una palabra clave" name="clave1" required>
            </div>
            <div class="form-group" style="padding-top: 15px;">
                <label for="exampleFormControlInput1">PalabraClave2</label>
                <input type="text" class="form-control" id="exampleFormControlInput1"
                    placeholder="Ingrese una palabra clave" name="clave2" required>
            </div>
            <div class="form-group" style="padding-top: 15px;">
                <label for="exampleFormControlInput1">PalabraClave3</label>
                <input type="text" class="form-control" id="exampleFormControlInput1"
                    placeholder="Ingrese una palabra clave" name="clave3" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Comentarios del Admin</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="textoBoxAdmin"
                    required></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Eliga la imagen 1 a mostrar</label>
                <input type="file" class="form-control-file" id="inpFile1" name="inpFile1" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Eliga la imagen 2 a mostrar</label>
                <input type="file" class="form-control-file" id="inpFile2" name="inpFile2" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Eliga la imagen 3 a mostrar</label>
                <input type="file" class="form-control-file" id="inpFile3" name="inpFile3" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Eliga el video a mostrar</label>
                <input type="file" class="form-control-file" id="inpFile4" name="inpFile4" required>
            </div>
            <div class="Like d-flex bd-highlight" style="padding-bottom:15px">
                <input type="submit" class="uploadfilesub btn btn-success  ml-auto" name="aceptar" value="Agregar">
                <input type="submit" class="uploadfilesub btn btn-success  mr-2 ml-2" name="especial" value="Especial">
                <a href="index.html" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer class="section footer-classic context-dark bg-image mt-3 border-top border-danger"
        style="background: #2b2b2b;">
        <div class="container">
            <div class="row row-30 mt-1">
                <div class="col-md-4 col-xl-5">
                    <div class="pr-xl-4"><a class="brand" href="index.html"><img class="brand-logo-light"
                                src="Imagenes/Header.jpg" alt="" width="140" height="37"
                                srcset="images/agency/logo-retina-inverse-280x74.png 2x"></a>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>

    <!-- JavaScript -->
    <script src="crearNoticia.js"></script>
</body>

</html>

<?php
include('Php/dbOrlando.php');
    if($con) {
        //if connection has been established display connected.
        }
        //if button with the name uploadfilesub has been clicked
    if(isset($_POST['aceptar'])) {
        //declaring variables
        $noticiaBool = false;
        $imagen1Bool = false;
        $imagen2Bool = false;
        $imagen3Bool = false;
        $videoBool = false;

        $titulo = $_POST['tituloBox'];
        $sinopsis = $_POST['sinopsisBox'];
        $texto = $_POST['textoBox'];
        $clave1 = $_POST['clave1'];
        $clave2 = $_POST['clave2'];
        $clave3 = $_POST['clave3'];
        $textoAdmin = $_POST['textoBoxAdmin'];
        $categoria = $_POST['categoBox'];

        
        $filename1 = $_FILES['inpFile1']['name'];
        $filetmpname1 = $_FILES['inpFile1']['tmp_name'];

        $filename2 = $_FILES['inpFile2']['name'];
        $filetmpname2 = $_FILES['inpFile2']['tmp_name'];

        $filename3 = $_FILES['inpFile3']['name'];
        $filetmpname3 = $_FILES['inpFile3']['tmp_name'];

        $filename4 = $_FILES['inpFile4']['name'];
        $filetmpname4 = $_FILES['inpFile4']['tmp_name'];

        //folder where images will be uploaded
        $folder = 'multimedia/';

        //function for saving the uploaded images in a specific folder
        move_uploaded_file($filetmpname1, $folder.$filename1);
        move_uploaded_file($filetmpname2, $folder.$filename2);
        move_uploaded_file($filetmpname3, $folder.$filename3);
        move_uploaded_file($filetmpname4, $folder.$filename4);

        //inserting image details (ie image name) in the database
        $insertarNoticia = "call sp_agregarNoticia ('$titulo', '$sinopsis', '$texto', '$clave1', '$clave2', '$clave3', '$varSesion', '$textoAdmin', '$categoria', false);";

        $current_id = mysqli_query($con, $insertarNoticia) or die("<b>Error:</b> Error al subir la noticia: <br/>" . mysqli_error($con));

        $row = mysqli_fetch_assoc($current_id);
        $notiID = $row['noticiaId'];

        if($current_id) {
          $noticiaBool = true;
          mysqli_close($con);
        } else {
          echo "no se pudo agregar la noticia";
          $noticiaBool = false;
        }

        if( $noticiaBool === true) {
            include('Php/dbOrlando.php');
            $image1 = "call sp_agregarImagenNoticia('$filename1')";
            $current_id = mysqli_query($con, $image1) or die("<b>Error:</b> Error al subir imagen1: <br/>" . mysqli_error($con));
            $row = mysqli_fetch_assoc($current_id);
            $imgID= $row['imagenId'];
            mysqli_close($con);

            include('Php/dbOrlando.php');
            $multimedia = "CALL sp_llenarMultimedia('$imgID','$notiID','0')";
			$insertarImagen = mysqli_query($con, $multimedia) or die("<b>Error:</b> Error al vincular imagen a noticia: <br/>" . mysqli_error($con));
            $imagen1Bool = true;
            mysqli_close($con);
        } else {
            echo "no se pudo agregar la imagen1";
        }

        if( $imagen1Bool === true) {
            include('Php/dbOrlando.php');
            $image2 = "call sp_agregarImagenNoticia('$filename2')";
            $current_id = mysqli_query($con, $image2) or die("<b>Error:</b> Error al subir imagen2: <br/>" . mysqli_error($con));
            $row = mysqli_fetch_assoc($current_id);
            $imgID= $row['imagenId'];
            mysqli_close($con);

            include('Php/dbOrlando.php');
            $multimedia = "CALL sp_llenarMultimedia('$imgID','$notiID','0')";
			$insertarImagen2 = mysqli_query($con, $multimedia) or die("<b>Error:</b> Error al vincular imagen a noticia: <br/>" . mysqli_error($con));
            $imagen2Bool = true;
            mysqli_close($con);
        } else {
            echo "no se pudo agregar la imagen2";
        }

        if( $imagen2Bool === true) {
            include('Php/dbOrlando.php');
            $image3 = "call sp_agregarImagenNoticia('$filename3')";
            $current_id = mysqli_query($con, $image3) or die("<b>Error:</b> Error al subir imagen3: <br/>" . mysqli_error($con));
            $row = mysqli_fetch_assoc($current_id);
            $imgID= $row['imagenId'];
            mysqli_close($con);

            include('Php/dbOrlando.php');
            $multimedia = "CALL sp_llenarMultimedia('$imgID','$notiID','0')";
			$insertarImagen2 = mysqli_query($con, $multimedia) or die("<b>Error:</b> Error al vincular imagen a noticia: <br/>" . mysqli_error($con));
            $imagen3Bool = true;
            mysqli_close($con);
        } else {
            echo "no se pudo agregar la imagen3";
        }

        if( $imagen3Bool === true) {
            include('Php/dbOrlando.php');
            $video1 = "call sp_agregarVideoNoticia('$filename4')";
            $current_id = mysqli_query($con, $video1) or die("<b>Error:</b> Error al subir video: <br/>" . mysqli_error($con));
            $row = mysqli_fetch_assoc($current_id);
            $videoID= $row['videoId'];
            mysqli_close($con);

            include('Php/dbOrlando.php');
            $multimedia = "CALL sp_llenarMultimedia('$videoID','$notiID','1')";
			$insertarImagen2 = mysqli_query($con, $multimedia) or die("<b>Error:</b> Error al vincular video a noticia: <br/>" . mysqli_error($con));
            $videoBool = true;
            mysqli_close($con);
            $con->close();

            $videoBool = true;
        } else {
            echo "no se pudo agregar el video";
        }

        if ($videoBool === true){
            echo "<script>window.location.href='index.php';</script>";
            exit;

            session_start();
            $_SESSION['usuario'] = $varSesion;
            $_SESSION['tipo'] = 'Reportero';
        }else{
            echo 'de aqui no escapas';
        }
    }

    if(isset($_POST['especial'])) {
        //declaring variables
        $noticiaBool = false;
        $imagen1Bool = false;
        $imagen2Bool = false;
        $imagen3Bool = false;
        $videoBool = false;

        $titulo = $_POST['tituloBox'];
        $sinopsis = $_POST['sinopsisBox'];
        $texto = $_POST['textoBox'];
        $clave1 = $_POST['clave1'];
        $clave2 = $_POST['clave2'];
        $clave3 = $_POST['clave3'];
        $textoAdmin = $_POST['textoBoxAdmin'];
        $categoria = $_POST['categoBox'];

        
        $filename1 = $_FILES['inpFile1']['name'];
        $filetmpname1 = $_FILES['inpFile1']['tmp_name'];

        $filename2 = $_FILES['inpFile2']['name'];
        $filetmpname2 = $_FILES['inpFile2']['tmp_name'];

        $filename3 = $_FILES['inpFile3']['name'];
        $filetmpname3 = $_FILES['inpFile3']['tmp_name'];

        $filename4 = $_FILES['inpFile4']['name'];
        $filetmpname4 = $_FILES['inpFile4']['tmp_name'];

        //folder where images will be uploaded
        $folder = 'multimedia/';

        //function for saving the uploaded images in a specific folder
        move_uploaded_file($filetmpname1, $folder.$filename1);
        move_uploaded_file($filetmpname2, $folder.$filename2);
        move_uploaded_file($filetmpname3, $folder.$filename3);
        move_uploaded_file($filetmpname4, $folder.$filename4);

        //inserting image details (ie image name) in the database
        $insertarNoticia = "call sp_agregarNoticia ('$titulo', '$sinopsis', '$texto', '$clave1', '$clave2', '$clave3', '$varSesion', '$textoAdmin', '$categoria', true);";

        $current_id = mysqli_query($con, $insertarNoticia) or die("<b>Error:</b> Error al subir la noticia: <br/>" . mysqli_error($con));

        $row = mysqli_fetch_assoc($current_id);
        $notiID = $row['noticiaId'];

        if($current_id) {
          $noticiaBool = true;
          mysqli_close($con);
        } else {
          echo "no se pudo agregar la noticia";
          $noticiaBool = false;
        }

        if( $noticiaBool === true) {
            include('Php/dbOrlando.php');
            $image1 = "call sp_agregarImagenNoticia('$filename1')";
            $current_id = mysqli_query($con, $image1) or die("<b>Error:</b> Error al subir imagen1: <br/>" . mysqli_error($con));
            $row = mysqli_fetch_assoc($current_id);
            $imgID= $row['imagenId'];
            mysqli_close($con);

            include('Php/dbOrlando.php');
            $multimedia = "CALL sp_llenarMultimedia('$imgID','$notiID','0')";
			$insertarImagen = mysqli_query($con, $multimedia) or die("<b>Error:</b> Error al vincular imagen a noticia: <br/>" . mysqli_error($con));
            $imagen1Bool = true;
            mysqli_close($con);
        } else {
            echo "no se pudo agregar la imagen1";
        }

        if( $imagen1Bool === true) {
            include('Php/dbOrlando.php');
            $image2 = "call sp_agregarImagenNoticia('$filename2')";
            $current_id = mysqli_query($con, $image2) or die("<b>Error:</b> Error al subir imagen2: <br/>" . mysqli_error($con));
            $row = mysqli_fetch_assoc($current_id);
            $imgID= $row['imagenId'];
            mysqli_close($con);

            include('Php/dbOrlando.php');
            $multimedia = "CALL sp_llenarMultimedia('$imgID','$notiID','0')";
			$insertarImagen2 = mysqli_query($con, $multimedia) or die("<b>Error:</b> Error al vincular imagen a noticia: <br/>" . mysqli_error($con));
            $imagen2Bool = true;
            mysqli_close($con);
        } else {
            echo "no se pudo agregar la imagen2";
        }

        if( $imagen2Bool === true) {
            include('Php/dbOrlando.php');
            $image3 = "call sp_agregarImagenNoticia('$filename3')";
            $current_id = mysqli_query($con, $image3) or die("<b>Error:</b> Error al subir imagen3: <br/>" . mysqli_error($con));
            $row = mysqli_fetch_assoc($current_id);
            $imgID= $row['imagenId'];
            mysqli_close($con);

            include('Php/dbOrlando.php');
            $multimedia = "CALL sp_llenarMultimedia('$imgID','$notiID','0')";
			$insertarImagen2 = mysqli_query($con, $multimedia) or die("<b>Error:</b> Error al vincular imagen a noticia: <br/>" . mysqli_error($con));
            $imagen3Bool = true;
            mysqli_close($con);
        } else {
            echo "no se pudo agregar la imagen3";
        }

        if( $imagen3Bool === true) {
            include('Php/dbOrlando.php');
            $video1 = "call sp_agregarVideoNoticia('$filename4')";
            $current_id = mysqli_query($con, $video1) or die("<b>Error:</b> Error al subir video: <br/>" . mysqli_error($con));
            $row = mysqli_fetch_assoc($current_id);
            $videoID= $row['videoId'];
            mysqli_close($con);

            include('Php/dbOrlando.php');
            $multimedia = "CALL sp_llenarMultimedia('$videoID','$notiID','1')";
			$insertarImagen2 = mysqli_query($con, $multimedia) or die("<b>Error:</b> Error al vincular video a noticia: <br/>" . mysqli_error($con));
            $videoBool = true;
            mysqli_close($con);
            $con->close();

            $videoBool = true;
        } else {
            echo "no se pudo agregar el video";
        }

        if ($videoBool === true){
            echo "<script>window.location.href='index.php';</script>";
            exit();
            exit;

            session_start();
            $_SESSION['usuario'] = $varSesion;
            $_SESSION['tipo'] = 'Reportero';
        }else{
            echo 'de aqui no escapas';
        }
    }

?>
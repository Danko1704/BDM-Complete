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

    require 'Php/dbOrlando.php';
    $fillCat = "CALL sp_llenarCategorias()";
    $sqlquery = mysqli_query($con,  $fillCat) or die('FALLO DE CATEGORIA');
    $con->close();

    $titulo = $data['titulo'];
    $sinopsis = $data['sinopsis'];

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
                <a href="aceptarNoticiaR.php" class="btn btn-success  mr-2">Administrar</a>
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
                    placeholder="Ingrese un titulo para la noticia" name="tituloBox"  value="<?= htmlspecialchars($titulo) ?>" required>
            </div>
            <div class="form-group" style="padding-top: 15px;">
                <label for="exampleFormControlInput1">Sinopsis</label>
                <input type="text" class="form-control" id="exampleFormControlInput1"
                    name="sinopsisBox" value="<?= htmlspecialchars($sinopsis) ?>" required>
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
                    required> <?php echo $data['texto'] ?> </textarea>
            </div>
            <div class="form-group" style="padding-top: 15px;">
                <label for="exampleFormControlInput1">PalabraClave1</label>
                <input type="text" class="form-control" id="exampleFormControlInput1"
                    placeholder="Ingrese una palabra clave" name="clave1" value="<?= htmlspecialchars($data['palabraClave1']) ?>" required>
            </div>
            <div class="form-group" style="padding-top: 15px;">
                <label for="exampleFormControlInput1">PalabraClave2</label>
                <input type="text" class="form-control" id="exampleFormControlInput1"
                    placeholder="Ingrese una palabra clave" name="clave2" value="<?= htmlspecialchars($data['palabraClave2']) ?>" required>
            </div>
            <div class="form-group" style="padding-top: 15px;">
                <label for="exampleFormControlInput1">PalabraClave3</label>
                <input type="text" class="form-control" id="exampleFormControlInput1"
                    placeholder="Ingrese una palabra clave" name="clave3" value="<?= htmlspecialchars($data['palabraClave3']) ?>" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Comentarios del Admin</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                    name="textoBoxAdmin"><?= htmlspecialchars($data['comentarioEditor']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Eliga la imagen 1 a mostrar</label>
                <input type="file" class="form-control-file" id="inpFile1" name="inpFile1">
                <label for="exampleFormControlInput1">Previamente puesta (si no desea cambiarlo, no agregue ninguna imagen):</label>
                <input type="text" class="form-control"
                     value="<?= htmlspecialchars($set[0]['imagenFile']) ?>" disabled="disabled" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Eliga la imagen 2 a mostrar</label>
                <input type="file" class="form-control-file" id="inpFile2" name="inpFile2">
                <label for="exampleFormControlInput1">Previamente puesta (si no desea cambiarlo, no agregue ninguna imagen):</label>
                <input type="text" class="form-control"
                     value="<?= htmlspecialchars($set[1]['imagenFile']) ?>" disabled="disabled" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Eliga la imagen 3 a mostrar</label>
                <input type="file" class="form-control-file" id="inpFile3" name="inpFile3">
                <label for="exampleFormControlInput1">Previamente puesta (si no desea cambiarlo, no agregue ninguna imagen):</label>
                <input type="text" class="form-control"
                     value="<?= htmlspecialchars($set[2]['imagenFile']) ?>" disabled="disabled" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Eliga el video a mostrar</label>
                <input type="file" class="form-control-file" id="inpFile4" name="inpFile4">
                <label for="exampleFormControlInput1">Previamente puesta (si no desea cambiarlo, no agregue ninguna imagen):</label>
                <input type="text" class="form-control"
                     value="<?= htmlspecialchars($set2[0]['videoFile']) ?>" disabled="disabled" required>
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
                                srcset="Imagenes/Header.jpg"></a>
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
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>

    <!-- JavaScript -->
    <script src="navbarSeccion.js"></script>

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
        if ('inpFile1' != ''){
            move_uploaded_file($filetmpname1, $folder.$filename1);

            include('Php/dbOrlando.php');
            $oldImage1 = $set[0]['imagenFile'];
            $image1 = "call sp_updateImagenNoticia('$filename1', '$oldImage1')";
            $current_id = mysqli_query($con, $image1) or die("<b>Error:</b> Error al subir imagen1: <br/>" . mysqli_error($con));
            mysqli_close($con);
        }
        if ('inpFile2' != ''){
            move_uploaded_file($filetmpname2, $folder.$filename2);

            include('Php/dbOrlando.php');
            $oldImage2 = $set[1]['imagenFile'];
            $image2 = "call sp_updateImagenNoticia('$filename2', '$oldImage2')";
            $current_id = mysqli_query($con, $image2) or die("<b>Error:</b> Error al subir imagen2: <br/>" . mysqli_error($con));
            mysqli_close($con);
        }
        if ('inpFile3' != ''){
            move_uploaded_file($filetmpname3, $folder.$filename3);
            include('Php/dbOrlando.php');
            $oldImage3 = $set[2]['imagenFile'];
            $image3 = "call sp_updateImagenNoticia('$filename3', '$oldImage3')";
            $current_id = mysqli_query($con, $image3) or die("<b>Error:</b> Error al subir imagen3: <br/>" . mysqli_error($con));
            mysqli_close($con);
        }
        if ('inpFile4' != ''){
            move_uploaded_file($filetmpname4, $folder.$filename4);

            include('Php/dbOrlando.php');
            $oldImage3 = $set2[0]['videoFile'];
            $video1 = "call sp_updateVideoNoticia('$filename4', '$oldImage3')";
            $current_id = mysqli_query($con, $video1) or die("<b>Error:</b> Error al subir video: <br/>" . mysqli_error($con));
            mysqli_close($con);
        }
               
        //inserting image details (ie image name) in the database
        include('Php/dbOrlando.php');
        $insertarNoticia = "call sp_editarNoticia ('$varTituloNoticia', '$titulo', '$sinopsis', '$texto', '$clave1', '$clave2', '$clave3', '$categoria', false);";

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

        if ($noticiaBool === true){

            session_start();
            $_SESSION['usuario'] = $varSesion;
            $_SESSION['tipo'] = 'Reportero';

            $yourURL="aceptarNoticiaR.php";
            echo ("<script>location.href='$yourURL'</script>");
            exit;
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
        if ('inpFile1' != ''){
            move_uploaded_file($filetmpname1, $folder.$filename1);

            include('Php/dbOrlando.php');
            $oldImage1 = $set[0]['imagenFile'];
            $image1 = "call sp_updateImagenNoticia('$filename1', '$oldImage1')";
            $current_id = mysqli_query($con, $image1) or die("<b>Error:</b> Error al subir imagen1: <br/>" . mysqli_error($con));
            mysqli_close($con);
        }
        if ('inpFile2' != ''){
            move_uploaded_file($filetmpname2, $folder.$filename2);

            include('Php/dbOrlando.php');
            $oldImage2 = $set[1]['imagenFile'];
            $image2 = "call sp_updateImagenNoticia('$filename2', '$oldImage2')";
            $current_id = mysqli_query($con, $image2) or die("<b>Error:</b> Error al subir imagen2: <br/>" . mysqli_error($con));
            mysqli_close($con);
        }
        if ('inpFile3' != ''){
            move_uploaded_file($filetmpname3, $folder.$filename3);
            include('Php/dbOrlando.php');
            $oldImage3 = $set[2]['imagenFile'];
            $image3 = "call sp_updateImagenNoticia('$filename3', '$oldImage3')";
            $current_id = mysqli_query($con, $image3) or die("<b>Error:</b> Error al subir imagen3: <br/>" . mysqli_error($con));
            mysqli_close($con);
        }
        if ('inpFile4' != ''){
            move_uploaded_file($filetmpname4, $folder.$filename4);

            include('Php/dbOrlando.php');
            $oldImage3 = $set2[0]['videoFile'];
            $video1 = "call sp_updateVideoNoticia('$filename4', '$oldImage3')";
            $current_id = mysqli_query($con, $video1) or die("<b>Error:</b> Error al subir video: <br/>" . mysqli_error($con));
            mysqli_close($con);
        }
               
        //inserting image details (ie image name) in the database
        include('Php/dbOrlando.php');
        $insertarNoticia = "call sp_editarNoticia ('$varTituloNoticia', '$titulo', '$sinopsis', '$texto', '$clave1', '$clave2', '$clave3', '$categoria', true);";

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

        if ($noticiaBool === true){

            session_start();
            $_SESSION['usuario'] = $varSesion;
            $_SESSION['tipo'] = 'Reportero';

            $yourURL="aceptarNoticiaR.php";
            echo ("<script>location.href='$yourURL'</script>");
            exit;
        }else{
            echo 'de aqui no escapas';
        }
    }

?>
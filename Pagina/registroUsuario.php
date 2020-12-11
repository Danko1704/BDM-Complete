<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="registroUsuario_style.css">
    <title>REGISTRARSE</title>
</head>

<body>
    <!-- ERROR -->

    <div class="container">
        <div class="row justify-content-center pt-2 mt-3 m-1">
            <div class="col-md-6 col-sm-8 col-xl-6 col-lg-5 formulario">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group text-center pt-3">
                        <h1 class="text-light">Registrarse</h1>
                    </div>

                    <div class="image-preview text-center" id="imagePreview">
                        <img src="" alt="Image Preview" class="image-preview__image rounded-circle text-center"
                            height="70%" width="70%">
                        <span class="image-preview__default-text">Image Preview</span>
                    </div>
                    <div class="text-center">
                        <input type="file" id="inpFile" name="inpFile" hidden />
                        <label for="inpFile">Choose File</label>
                        <span id="file-chosen" name='textFile'>No file chosen</span>
                    </div>

                    <div class="form-group mx-sm-4 pt-3">
                        <input type="text" class="form-control text-white" placeholder="Ingrese su nombre"
                            name="nombreBox" required>
                    </div>
                    <div class="form-group mx-sm-4 pb-3">
                        <input type="mail" class="form-control text-white" placeholder="Ingrese su correo electrónico"
                            name="correoBox" required>
                    </div>
                    <div class="form-group mx-sm-4 pb-3">
                        <input type="tel" class="form-control text-white" placeholder="Ingrese su número telefónico"
                            name="numeroBox" required>
                    </div>
                    <div class="form-group mx-sm-4 pb-3">
                        <input type="password" class="form-control text-white" placeholder="Ingrese su contraseña"
                            name="contraseñaBox" required>
                    </div>
                    <div class="form-group mx-sm-4 pb-2" style="text-align: center;">
                        <!-- <span class="text-center"><a class="btn btn-block registrarse" onclick='required()'>REGISTRARSE</a></span> -->
                        <input type="submit" class="uploadfilesub btn btn-block editar" name="uploadfilesub"
                            value="REGISTRARSE">
                    </div>
                    <div class="form-group mx-sm-4 pb-2" style="text-align: center;">
                        <span class="text-center"><a href="index.php" class="btn btn-block regresar">REGRESAR</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap.min.js"></script>

    <!-- JavaScript -->
    <script src="registroUsuario.js"></script>
</body>

</html>

<?php
include('Php/dbOrlando.php');
    if($con) {
        //if connection has been established display connected.
        }
        //if button with the name uploadfilesub has been clicked
    if(isset($_POST['uploadfilesub'])) {
        //declaring variables
        $nombre = $_POST['nombreBox'];
        $correo = $_POST['correoBox'];
        $numero = $_POST['numeroBox'];
        $contraseña = $_POST['contraseñaBox'];
        $filename = $_FILES['inpFile']['name'];
        $filedata = addslashes(file_get_contents($_FILES['inpFile']['tmp_name']));
        //$filetype = $_FILES['inpFile']['type'];

            //folder where images will be uploaded
        //$folder = 'multimedia/';

            //function for saving the uploaded images in a specific folder
        //move_uploaded_file($filetmpname, $folder.$filename);


        //echo "<script>console.log('$filedata')</script>";
        //inserting image details (ie image name) in the database
        $userInsert = "call sp_agregarUsuario('$nombre', '$correo', '$numero', '$contraseña')";
        $sql = "call sp_agregarImagenUsuario('$correo', '$filename', '$filedata')";

        $qry1 = mysqli_query($con,  $userInsert);
        $qry2 = mysqli_query($con,  $sql);

        //$error = mysqli_error($con);

        //echo "<script>console.log($error)</script>";

        if( $qry1 && $qry2) {
          header("Location:index.php");
        } else {
          echo "no se pudo guardar la imagen";
        }

        session_start();
        $_SESSION['usuario'] = $nombre;
        $_SESSION['tipo'] = 'Usuario';
    }

    $con->close();
?>
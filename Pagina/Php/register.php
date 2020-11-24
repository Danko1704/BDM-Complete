<?php
    // include('Php/dbOrlando.php');
    // $nombre = $_POST['nombreBox'];
    // $correo = $_POST['correoBox'];
    // $numero = $_POST['numeroBox'];
    // $contraseña = $_POST['contraseñaBox'];

    // $usuarios = $con->query("call sp_agregarUsuario('$nombre', '$correo', '$numero', '$contraseña')");

    // $filename = $_FILES['inpFile']['name'];
    // $filetmpname = $_FILES['inpFile']['tmp_name'];

    // $folder = 'multimedia/';

    // move_uploaded_file($filetmpname, $folder.$filename);

    // $image = $con->query("INSERT INTO Imagen(imagenfile) VALUES ('$filename');");
    // // $image = $con->query("call sp_agregarImagenUsuario('$correo','$filename')");

    // session_start();
    // $_SESSION['usuario'] = $nombre;
    // $_SESSION['tipo'] = 'Usuario';

    // mysqli_free_result($usuarios);
    // $con->close();
    
    include('dbOrlando.php');

    $nombre = $_POST['nombreBox'];
    $correo = $_POST['correoBox'];
    $numero = $_POST['numeroBox'];
    $contraseña = $_POST['contraseñaBox'];

    if($con) {
        //if connection has been established display connected.
        echo "connected";
        }
        //if button with the name uploadfilesub has been clicked
    if(isset($_POST['uploadfilesub'])) {
        //declaring variables
        $filename = $_FILES['uploadfile']['name'];
        $filetmpname = $_FILES['uploadfile']['tmp_name'];

        //folder where images will be uploaded
        $folder = 'multimedia/';

        //function for saving the uploaded images in a specific folder
        move_uploaded_file($filetmpname, $folder.$filename);

        //inserting image details (ie image name) in the database
        $userInsert = "call sp_agregarUsuario('$nombre', '$correo', '$numero', '$contraseña')";
        $sql = "call sp_agregarImagenUsuario('$correo', '$filename')";

        $qry1 = mysqli_query($con,  $userInsert);
        $qry2 = mysqli_query($con,  $sql);
    }

    session_start();
    $_SESSION['usuario'] = $nombre;
    $_SESSION['tipo'] = 'Usuario';

    $con->close();
?>
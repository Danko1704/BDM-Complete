<?php
    require 'dbOrlando.php';

    $nombre=$_POST['nombreBox'];
    $correo=$_POST['correoBox'];
    $numero=$_POST['numeroBox'];
    $contraseña=$_POST['contraseñaBox'];
    $archivo=$_POST['textFile'];

    $usuarios = $con->query("call sp_agregarUsuario('$nombre', '$correo', '$numero', '$contraseña')");
    $imagen = $con->query("call sp_agregarImagenUsuario('$correo','$archivo')");

    mysqli_free_result($usuarios);
    mysqli_free_result($imagen);
    $con->close();
?>
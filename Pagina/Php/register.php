<?php
    require 'dbRodrigo.php';

    $nombre=$_POST['nombreBox'];
    $correo=$_POST['correoBox'];
    $numero=$_POST['numeroBox'];
    $contraseña=$_POST['contraseñaBox'];

    $usuarios = $con->query("INSERT INTO Usuario(nombre, correo, telefono, contraseña, imagenIdF) values('$nombre', '$correo' ,'$numero', '$contraseña', '2')");

    mysqli_free_result($usuarios);
    $con->close();
?>
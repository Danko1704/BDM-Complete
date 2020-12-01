<?php
    require 'dbOrlando.php';

    $titulo = $_POST['tituloBox'];
    $sinposis = $_POST['sinopsisBox'];
    $catego = $_POST['categoBox'];
    $texto = $_POST['textoBox'];
    $img1 = $_POST['img1'];
    $img2 = $_POST['img2'];
    $img3 = $_POST['img3'];
    $video = $_POST['video'];

    $noticia = $con->query("INSERT INTO Noticias(titurlo, sinopsis, texto, fechacreacion, imagenIdF) values('$nombre', '$correo' ,'$numero', '$contraseña', '2')");

    mysqli_free_result($noticia);
    $con->close();
?>
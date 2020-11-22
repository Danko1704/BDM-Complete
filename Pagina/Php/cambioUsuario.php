<?php
    require 'dbOrlando.php';

    $nombre=$_POST['mySelect'];

    $nuevoReportero = $con->query("call sp_cambiarUsuario('$nombre')");

    mysqli_free_result($nuevoReportero);
    $con->close();
?>
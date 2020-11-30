<?php

require 'dbRodrigo.php';

$seccion = $_POST['nombreSeccion'];
$nombre = $_POST['usuario'];
$color = $_POST['color-picker'];

$result = mysqli_query($con, "call sp_agregarCategoria('$seccion', '$nombre', '$color')");

    // $result = mysqli_query($con, "INSERT INTO seccion SET Nombre = '$seccion', Color = '$color', usuarioIdF = 1;");

//exit();
//exit;

    //mysqli_free_result($result);
$con->close();
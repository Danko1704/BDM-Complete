<?php

require 'dbRodrigo.php';

$seccion = $_POST['nombreSeccion'];
$color = $_POST['color-picker'];

$result = mysqli_query($con, "INSERT INTO seccion SET Nombre = '$seccion', Color = '$color', usuarioIdF = 1;");

//mysqli_free_result($result);
$con->close();
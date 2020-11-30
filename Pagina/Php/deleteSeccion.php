<?php

require 'dbOrlando.php';

$seccion = $_POST['categoBox'];

// $result = mysqli_query($con, "UPDATE seccion SET isActive = 0 WHERE seccionId = $seccion");
$result = mysqli_query($con, "sp_deleteCategorias('$seccion')");

echo "<script>console.log('Debug Objects: " . gettype($seccion) . "' );</script>";
echo "<script>console.log('Debug Objects: " . $seccion . "' );</script>";

//mysqli_free_result($result);
$con->close();
?>
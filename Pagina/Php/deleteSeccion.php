<?php

require 'dbRodrigo.php';

$seccion = $_POST['categoBox'];

$result = mysqli_query($con, "UPDATE seccion SET isActive = 0 WHERE seccionId = $seccion");

//mysqli_free_result($result);
$con->close();
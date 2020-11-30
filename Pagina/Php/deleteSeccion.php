<?php

require 'dbRodrigo.php';

$seccion = $_POST['categoBox'];


        // $result = mysqli_query($con, "UPDATE seccion SET isActive = 0 WHERE seccionId = $seccion");
$result = mysqli_query($con, "CALL sp_deleteCategorias($seccion);");

        //mysqli_free_result($result);
        //echo $result;
$con->close();
<?php

require 'dbRodrigo.php';

$result = mysqli_query($con, "call sp_cargaCategorias()");

// $result = mysqli_query($con, "SELECT * FROM seccion WHERE isActive = 1");

$rows = mysqli_num_rows($result);

if($rows) {
    while($catego = mysqli_fetch_assoc($result)) {
        $categoria = $catego['nombre'];
        $id = $catego['seccionId'];

        echo "<option value='$id'>$categoria</option>";
    }
}

mysqli_free_result($result);

$con->close();
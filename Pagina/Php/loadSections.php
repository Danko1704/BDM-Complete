<?php

require 'dbRodrigo.php';

$result = mysqli_query($con, "SELECT * FROM seccion WHERE isActive = 1");

$rows = mysqli_num_rows($result);

if($rows) {
    while($catego = mysqli_fetch_assoc($result)) {
        $categoria = $catego['Nombre'];
        $id = $catego['seccionId'];

        echo "<a class='nav-item nav-link active seccion' href='#' id='color$id'>$categoria</a>";
    }
}
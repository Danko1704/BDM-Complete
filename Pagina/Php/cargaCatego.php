<?php

require 'dbRodrigo.php';

$result = mysqli_query($con, "SELECT * FROM seccion");

$rows = mysqli_num_rows($result);

if($rows) {
    while($catego = mysqli_fetch_assoc($result)) {
        $categoria = $catego['Nombre'];
        $id = $catego['seccionId'];

        echo "<option value='$id'>$categoria</option>";
    }
}

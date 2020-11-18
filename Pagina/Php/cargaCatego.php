<?php
    require 'dbRodrigo.php';
    $catego = $con->query("SELECT * FROM Seccion");

    if($catego->num_rows > 0) {
        while($row = $catego->fetch_assoc()) {
            echo "<option>$catego['Nombre']</option>";
        }
    }
    else {
        echo "<option>No hay categorías!</option>";
    }

    mysqli_free_result($noticia);
    $con->close();
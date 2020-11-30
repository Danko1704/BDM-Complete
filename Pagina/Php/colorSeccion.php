<?php

require 'dbRodrigo.php';

$result = mysqli_query($con, "SELECT * FROM seccion");

$rows = mysqli_num_rows($result);

if($rows) {
    $colors = array();

    while($catego = mysqli_fetch_assoc($result)) {
        $colors[] = array(
            'id' => $catego['seccionId'],
            'nombre' => $catego['Nombre'],
            'color' => $catego['Color']
        );
    }

    $jsonstring = json_encode($colors);
    echo $jsonstring;
}
<?php

require 'dbRodrigo.php';

$result = mysqli_query($con, "call sp_cargaCategorias()");

$rows = mysqli_num_rows($result);

if($rows) {
    $colors = array();

    while($catego = mysqli_fetch_assoc($result)) {
        $colors[] = array(
            'id' => $catego['seccionId'],
            'nombre' => $catego['nombre'],
            'color' => $catego['color']
        );
    }

    $jsonstring = json_encode($colors);
    echo $jsonstring;
}
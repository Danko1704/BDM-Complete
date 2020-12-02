<?php

require 'dbOrlando.php';

$texto = $_POST['Texto'];
$fechaIni = $_POST['FechaIni'];
$fechaFin = $_POST['FechaFin'];
$seccion = $_POST['categoBox'];

$T = "NULL";
$FI = "NULL";
$FF = "NULL";
$S = "NULL";

if(strcmp($texto, '') !== 0) {
    $T = "'".$texto."'";
}

if(strcmp($fechaIni, '') !== 0) {
    $FI = "'".$fechaIni . " 00:00:00'";
}

if(strcmp($fechaFin, '') !== 0) {
    $FF = "'".$fechaFin . " 23:59:59'";
}

if($seccion != 0) {
    $S = "'".$seccion."'";
}

//echo "CALL sp_Busqueda(".$T.", ".$S.", ".$FI.", ".$FF.");";

$result = mysqli_query($con, "CALL sp_Busqueda(".$T.", ".$S.", ".$FI.", ".$FF.");");

$rows = mysqli_num_rows($result);

if($rows) {
    $noticias = array();

    while($noticia = mysqli_fetch_assoc($result)) {
        $noticias[] = array(
            'titulo' => $noticia['titulo'],
            'sinposis' => $noticia['sinopsis']
        );
    }

    $jsonstring = json_encode($noticias);
    echo $jsonstring;
}

mysqli_free_result($result);

$con->close();
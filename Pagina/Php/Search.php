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
    //$noticias = array();

    while($noticia = mysqli_fetch_assoc($result)) {
        /*$noticias[] = array(
            'titulo' => $noticia['titulo'],
            'sinposis' => $noticia['sinopsis']
        );*/

        $titulo = $noticia['titulo'];
        $sinopsis = $noticia['sinopsis'];


        echo "<div class='row remove'>";
        echo "<div class='card mt-3 mx-auto text-white bg-dark w-75 remove'>";
        echo "<div class='card-body remove'>";
        echo "<h2 class='card-title mt-2 remove'>$titulo</h2>";
        echo "<p class='card-text remove'>$sinopsis</p>";
        echo "<a href='noticia.html' class='btn btn-danger remove mr-2'>Ver más</a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

    }


    

    /*$jsonstring = json_encode($noticias);
    echo $jsonstring;*/
}

mysqli_free_result($result);

$con->close();
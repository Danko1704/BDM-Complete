<?php
    require 'dbOrlando.php';

    $noticia = $_POST['noticia'];
    $usuario = $_POST['usuario'];
    $texto = $_POST['textoComentario'];

    if(strcmp($texto, '') !== 0){
        $result = mysqli_query($con, "CALL sp_agregarComentario('$texto', '$usuario', '$noticia')");
    }
    else{
        echo "No hay texto";
    }
    
        //mysqli_free_result($result);
    $con->close();

?>
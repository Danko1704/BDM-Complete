<?php
    require 'dbOrlando.php';
    error_reporting(0);

    $noticia = $_POST['noticiaID'];

    $temp = substr($noticia, 1);
    $qry = "CALL sp_MostrarComentarios('$temp');";

    $result = mysqli_query($con, $qry);
    
    $rows = mysqli_num_rows($result);

    if($rows) {
    //$noticias = array();

        while($comentario = mysqli_fetch_assoc($result)) {
            /*$noticias[] = array(
                'titulo' => $noticia['titulo'],
                'sinposis' => $noticia['sinopsis']
            );*/
            $usuario = $comentario['nombre'];
            $comment = $comentario['comentario'];

            echo "<div class='row remove'>";
            echo "<div class='card mt-3 mx-auto text-white bg-dark w-75 remove'>";
            echo "<div class='card-body remove'>";
            echo "<h2 class='card-title mt-2 remove'>$usuario</h2>";
            echo "<p class='card-text remove'>$comment</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";

        }

    }

    mysqli_free_result($result);

    $con->close();

?>
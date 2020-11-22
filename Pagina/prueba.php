<?php
    session_start();
    $varSesion = $_SESSION['usuario'];

    if($varSesion == null || $varSesion = ''){
      echo 'No hay usuario';
    }

    if($varSesion !== null){
    echo 'Si hay usuario';
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset = "UTF-8">
    <title> PRUEBA </title>
</head>
<body>
    <h1>PANEL DE USUARIO</h1>
    <h2>Bienvenido: <?php echo $_SESSION['usuario'] ?></h2>
    <h2>Bienvenido: <?php echo $_SESSION['tipo'] ?></h2>
</body>
</html>
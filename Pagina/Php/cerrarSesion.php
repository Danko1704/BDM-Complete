<?php
    session_start();
    error_reporting(0);
    $varSesion = $_SESSION['usuario'];

    session_destroy();
    header("Location:../index.php");
?>  
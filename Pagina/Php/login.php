<?php
    require 'dbRodrigo.php';

    $correo=$_POST['correoBox'];
    $contraseña=$_POST['contraseñaBox'];

    // $usuarios = $con->query("SELECT nombre, tipoUsuario FROM Usuario where correo='$correo' and contraseña='$contraseña'");

    $usuarios = $con->query("CALL sp_validarUsuario('$correo', '$contraseña')");
    // $usuarios = "SELECT correo FROM Usuario where correo='$correo' and contraseña='$contraseña'";

    if($usuarios->num_rows == 1):
        $datos = $usuarios->fetch_assoc();
        echo json_encode(array('error' => false, 'tipo' => $datos['tipoUsuario']));
    else:
        echo json_encode(array('error' => true));
    endif;
    $con->close();
?>

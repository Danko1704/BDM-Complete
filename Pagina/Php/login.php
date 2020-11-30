<?php
    require 'dbRodrigo.php';

    $correo=$_POST['correoBox'];
    $contraseña=$_POST['contraseñaBox'];
    $nUsuario;
    $tUsuario;

    $usuarios = $con->query("CALL sp_validarUsuario('$correo', '$contraseña')");

    if($usuarios->num_rows == 1):
        $datos = $usuarios->fetch_assoc();
        echo json_encode(array('error' => false, 'tipo' => $datos['tipoUsuario'], $nUsuario = $datos['nombre']));
        session_start();
        $_SESSION['usuario'] = $nUsuario;
        $_SESSION['tipo'] = $tUsuario = $datos['tipoUsuario'];
    else:
        echo json_encode(array('error' => true));
    endif;
    $con->close();
?>

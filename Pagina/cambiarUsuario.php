<?php
    require 'Php/dbRodrigo.php';
    $sqlquery = mysqli_query($con, "CALL sp_selectUsuarios()");
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="cambiarUsuario_style.css">
    <title>REGISTRARSE</title>
</head>

<body>
    <div class="usuario text-center bg-danger text-white" style="display:none">
        <span>USUARIO CAMBIADO A USUARIO</span>
    </div>
    <div class="reportero text-center bg-danger text-white" style="display:none">
        <span>USUARIO CAMBIADO A REPORTERO</span>
    </div>

    <div class="container">
        <div class="row justify-content-center pt-5 mt-5 m-1">
            <div class="col-md-6 col-sm-8 col-xl-6 col-lg-5 formulario">
                <form action="" name="form1" method="post" id="formCambio">
                    <div class="form-group text-center pt-3">
                        <h1 class="text-light">INICIAR SESION</h1>
                    </div>
                    <select name="mySelect" class="form-control">
                        <?php
                        while($row = mysqli_fetch_array($sqlquery)){
                            ?>
                            <option value="<?=$row["nombre"];?>"><?=$row["nombre"];?></option>
                            <?php
                        }
                    ?>
                    </select>
                    <div class="form-group text-center pt-3">
                    <span class="text-center"><a class="btn btn-block registrarse" onclick='cambioUsuario()'>USUARIO</a></span>
                    </div>
                    <div class="form-group text-center pt-3">
                    <span class="text-center"><a class="btn btn-block registrarse" onclick='cambioReportero()'>REPORTERO</a></span>
                    </div>
                    <br>
                    <div class="form-group text-center">
                        <span class="text-left"><a href="index.php" class="regresar">REGRESAR</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- JavaScript -->
    <script src="cambiarReportero.js"></script>
    <script src="cambiarUsuario.js"></script>
</body>

</html>
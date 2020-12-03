<?php
  require 'Php/dbOrlando.php';
  session_start();
  error_reporting(0);
  $varSesion = $_SESSION['usuario'];
  $varSesionTipo =  $_SESSION['tipo'];
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="busqueda_style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <h1 class="text mt-3">Busqueda</h1>
    <!-- NAVBAR SIN USUARIO -->
    <div class="navbarSinUsuario" id="navbarSinUsuario">
        <nav class="navbar navbar-expand-sm navbar-dark bg-info bg-dark navbar-toggleable-md sticky-top">
            <a class="navbar-brand" href="index.php">
                <img src="https://yt3.ggpht.com/a/AATXAJxZMZ0mKBqkcFUcoXXapAjbD0FjYbgDTe3yNCPyZA=s900-c-k-c0xffffffff-no-rj-mo"
                    width="30" height="30" class="d-inline-block align-top" alt="Logo-Boostrap">
                3DJuegos
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <div class="navbar-nav mr-auto ml-auto text-center categoria">
                    <a class="nav-item nav-link active" href="index.php">Inicio</a>

                </div>
                <form class="mx-2 my-auto d-inline w-40">
                    <div class="input-group">
                        <input type="text" class="form-control border border-right-0" placeholder="Search...">
                        <span class="input-group-append">
                            <a href="busqueda.html" class="btn btn-outline-secondary border border-left-0"
                                type="button">
                                <i class="fa fa-search"></i>
                            </a>
                        </span>
                    </div>
                </form>
                <div class="d-flex flex-row justify-content-center">
                    <a href="inicioSesion.html" class="btn btn-danger  mr-2">Login</a>
                    <a href="registroUsuario.php" class="btn btn-danger">Registrarse</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- NAVBAR CON USUARIO NORMAL-->
    <div class="navbarUsuario" id="navbarUsuario">
        <nav class="navbar navbar-expand-sm navbar-dark bg-info bg-dark navbar-toggleable-md sticky-top">
            <a class="navbar-brand" href="index.php">
                <img src="https://yt3.ggpht.com/a/AATXAJxZMZ0mKBqkcFUcoXXapAjbD0FjYbgDTe3yNCPyZA=s900-c-k-c0xffffffff-no-rj-mo"
                    width="30" height="30" class="d-inline-block align-top" alt="Logo-Boostrap">
                3DJuegos
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <div class="navbar-nav mr-auto ml-auto text-center categoria">
                    <a class="nav-item nav-link active" href="index.php">Inicio</a>

                </div>
                <form class="mx-2 my-auto d-inline w-40">
                    <div class="input-group">
                        <input type="text" class="form-control border border-right-0" placeholder="Search...">
                        <span class="input-group-append">
                            <a href="busqueda.html" class="btn btn-outline-secondary border border-left-0"
                                type="button">
                                <i class="fa fa-search"></i>
                            </a>
                        </span>
                    </div>
                </form>
                <div class="d-flex flex-row justify-content-center">
                    <a href="perfilUsuario.php" class="btn btn-success  mr-2">Editar Perfil</a>
                    <a href="Php/cerrarSesion.php" class="btn btn-warning  mr-2">Cerrar Sesion</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- NAVBAR CON USUARIO REPORTERO-->
    <div class="navbarUsuarioRepprtero" id="navbarUsuarioReportero">
        <nav class="navbar navbar-expand-sm navbar-dark bg-info bg-dark navbar-toggleable-md sticky-top">
            <a class="navbar-brand" href="index.php">
                <img src="https://yt3.ggpht.com/a/AATXAJxZMZ0mKBqkcFUcoXXapAjbD0FjYbgDTe3yNCPyZA=s900-c-k-c0xffffffff-no-rj-mo"
                    width="30" height="30" class="d-inline-block align-top" alt="Logo-Boostrap">
                3DJuegos
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <div class="navbar-nav mr-auto ml-auto text-center categoria">
                    <a class="nav-item nav-link active" href="index.php">Inicio</a>

                </div>
                <form class="mx-2 my-auto d-inline w-40">
                    <div class="input-group">
                        <input type="text" class="form-control border border-right-0" placeholder="Search...">
                        <span class="input-group-append">
                            <a href="busqueda.html" class="btn btn-outline-secondary border border-left-0"
                                type="button">
                                <i class="fa fa-search"></i>
                            </a>
                        </span>
                    </div>
                </form>
                <div class="d-flex flex-row justify-content-center">
                    <a href="aceptarNoticiaR.php" class="btn btn-success  mr-2">Administrar</a>
                    <a href="crearNoticia.php" class="btn btn-success  mr-2">Crear Noticia</a>
                    <a href="perfilUsuario.php" class="btn btn-success  mr-2">Editar Perfil</a>
                    <a href="Php/cerrarSesion.php" class="btn btn-warning  mr-2">Cerrar Sesion</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- NAVBAR CON USUARIO ADMIN-->
    <div class="navbarUsuarioAdmin" id="navbarUsuarioAdmin">
        <nav class="navbar navbar-expand-sm navbar-dark bg-info bg-dark navbar-toggleable-md sticky-top">
            <a class="navbar-brand" href="index.php">
                <img src="https://yt3.ggpht.com/a/AATXAJxZMZ0mKBqkcFUcoXXapAjbD0FjYbgDTe3yNCPyZA=s900-c-k-c0xffffffff-no-rj-mo"
                    width="30" height="30" class="d-inline-block align-top" alt="Logo-Boostrap">
                3DJuegos
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <div class="navbar-nav mr-auto ml-auto text-center categoria">
                    <a class="nav-item nav-link active" href="index.php">Inicio</a>

                </div>
                <form class="mx-2 my-auto d-inline w-40">
                    <div class="input-group">
                        <input type="text" class="form-control border border-right-0" placeholder="Search...">
                        <span class="input-group-append">
                            <a href="busqueda.html" class="btn btn-outline-secondary border border-left-0"
                                type="button">
                                <i class="fa fa-search"></i>
                            </a>
                        </span>
                    </div>
                </form>
                <div class="d-flex flex-row justify-content-center">
                    <a href="aceptarNoticia.php" class="btn btn-danger  mr-2">Administrar</a>
                    <a href="cambiarUsuario.php" class="btn btn-danger  mr-2">Cambiar</a>
                    <a href="Php/cerrarSesion.php" class="btn btn-warning  mr-2">Cerrar Sesion</a>
                </div>
            </div>
        </nav>
    </div>



    <!-- Noticias en lista -->
    <div class="container mt-3 misNoticias">


    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="navbarSeccion.js"></script>
    <script src="optionSeccion.js"></script>
    <script src="Busqueda.js"></script>

    <?php
if ($varSesion == null || $varSesion = '') {
?>
    <script type='text/javascript'>
    $(document).ready(function() {
        $("#navbarUsuario").hide();
        $("#navbarUsuarioReportero").hide();
        $("#navbarUsuarioAdmin").hide();
    });
    </script>
    <?php
}

if ($varSesionTipo == 'Usuario') {
?>
    <script type='text/javascript'>
    $(document).ready(function() {
        $("#navbarSinUsuario").hide();
        $("#navbarUsuarioReportero").hide();
        $("#navbarUsuarioAdmin").hide();
    });
    </script>
    <?php
}

if ($varSesionTipo == 'Reportero') {
?>
    <script type='text/javascript'>
    $(document).ready(function() {
        $("#navbarSinUsuario").hide();
        $("#navbarUsuario").hide();
        $("#navbarUsuarioAdmin").hide();
    });
    </script>
    <?php
}

if ($varSesionTipo == 'Admin') {
?>
    <script type='text/javascript'>
    $(document).ready(function() {
        $("#navbarSinUsuario").hide();
        $("#navbarUsuario").hide();
        $("#navbarUsuarioReportero").hide();
    });
    </script>
    <?php
}
?>
</body>

</html>

<?php
  require 'Php/dbOrlando.php';
  // if($con){
  //   echo "Hay conexion";
  // }
  // else{
  //   error.log($con);
  // }
  if(isset($_GET['idSeccion'])) {
    $idSeccion = $_GET['idSeccion'];

    $temp = "SELECT * FROM Noticia WHERE seccionIdF = '$idSeccion' AND isActive = 1";

    //echo $temp;

    $result = mysqli_query($con, $temp) or die ("Fallo el query");

    $rows = mysqli_num_rows($result);

    if($rows) {
        //$noticias = array();

        while($noticia = mysqli_fetch_assoc($result)) {
            /*$noticias[] = array(
                'titulo' => $noticia['titulo'],
                'sinposis' => $noticia['sinopsis']
            );*/
            $id = $noticia['noticiaId'];
            $titulo = $noticia['titulo'];
            $sinopsis = $noticia['sinopsis'];


            echo "<div class='row remove'>";
            echo "<div class='card mt-3 mx-auto text-white bg-dark w-75 remove'>";
            echo "<div class='card-body remove'>";
            echo "<h2 class='card-title mt-2 remove'>$titulo</h2>";
            echo "<p class='card-text remove'>$sinopsis</p>";
            echo "<a href='./noticia.php?idNoticia=$id' class='btn btn-danger remove mr-2'>Ver más</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    }
  }

?>
<?php
    require 'Php/dbRodrigo.php';
    session_start();
    error_reporting(0);
    
    $varSesion = $_SESSION['usuario'];
    $varSesionTipo =  $_SESSION['tipo'];
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
    <link rel="stylesheet" href="perfilReportero_style.css">
    <title>3DJuegos</title>
</head>

<body>
    <div class="navbarUsuarioAdmin" id="navbarUsuarioAdmin">
        <nav class="navbar navbar-expand-sm navbar-dark bg-info bg-dark navbar-toggleable-md sticky-top">
            <a class="navbar-brand" href="index.html">
                <img src="https://yt3.ggpht.com/a/AATXAJxZMZ0mKBqkcFUcoXXapAjbD0FjYbgDTe3yNCPyZA=s900-c-k-c0xffffffff-no-rj-mo"
                    width="30" height="30" class="d-inline-block align-top" alt="Logo-Boostrap">
                3DJuegos
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <div class="navbar-nav mr-auto ml-auto text-center">
                    
                </div>
                <div class="d-flex flex-row justify-content-center">
                    <a href="cambiarUsuario.php" class="btn btn-danger  mr-2">Cambiar</a>
                    <a href="Php/cerrarSesion.php" class="btn btn-warning  mr-2">Cerrar Sesion</a>
                </div>
            </div>
        </nav>
    </div>
    <!------------------------------------------------------------------------------------->
    <div class="container">
        <div class="row justify-content-between mt-3 m-1">
            <div class="col-sm-12 col-lg-6">
                <div class="perfil">
                    <div class="text-center py-3">
                        <h1 class="text-dark">Reporteros</h1>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Escoja un reportero</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="usuario">
                            <?php
                        while($row = mysqli_fetch_array($sqlquery)){
                            ?>
                            <option value="<?=$row["nombre"];?>"><?=$row["nombre"];?></option>
                            <?php
                        }
                        ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-------------------->
            <div class="col-sm-12 col-lg-6">
                <div class="perfil">
                    <div class="text-center py-3">
                        <h1 class="text-dark">Noticias</h1>
                    </div>
                    <div class="dropdown text-center py-3">
                        <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Noticias Pendientes
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="noticia.html">Noticia 1</a>
                            <a class="dropdown-item" href="noticia.html">Noticia 2</a>
                            <a class="dropdown-item" href="noticia.html">Noticia 3</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-between pt-5 mt-5 m-1">
            <div class="col-sm-12 col-lg-6">
                <div class="perfil">
                    <div class="text-center py-3">
                        <h1 class="text-dark">Agregar Secciones</h1>

                        <form action="Php/insertSeccion.php" method="post" class="addSeccion" name="addSeccion">
                            <?php
                                echo "<input type='hidden' name='usuario' value='$varSesion'>"
                            ?>
                            <div class="form-group" style="padding-top: 15px;">
                                <div class="text-dark">
                                    <label for="nombreSeccion">Nombre de la Seccion</label>
                                </div>
                                <input type="text" class="form-control" id="nombreSeccion" placeholder="Seccion"
                                    name="nombreSeccion">
                            </div>
                            <div class="form-group" style="padding-top: 15px;">
                                <div class="text-dark">
                                    <label for="color-picker">Escoja un color</label>
                                </div>
                                <input type="color" class="form-control" id="exampleFormControlInput1"
                                    name="color-picker">
                            </div>
                            <div class="justify-content-center bd-highlight"
                                style="padding-bottom:15px;padding-top: 15px;">
                                <!--<a href="#" class="btn btn-success  mr-2 ml-auto" id="crearSeccion" type="submit">Crear</a>-->
                                <input type="submit" value="Crear" class="btn btn-success  mr-2 ml-auto"
                                    onclick="location.href='aceptarNoticia.php';">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!---------------------------------------->
            <div class="col-sm-12 col-lg-6">
                <div class="perfil">
                    <div class="text-center py-3">
                        <h1 class="text-dark">Eliminar Secciones</h1>
                        <form action="Php/deleteSeccion.php" method="post" class="deleteSeccion">
                            <div class="form-group" style="padding-top: 15px;">
                                <div class="text-dark">
                                    <label for="categoriaLabel">Categoria</label>
                                </div>
                                <select class="form-control" id="categoBox" name="categoBox">
                                    
                                </select>
                            </div>
                            <div class="justify-content-center bd-highlight"
                                style="padding-bottom:15px; padding-top: 15px;">
                                <input type="submit" value="Eliminar" class="btn btn-danger  mr-2 ml-auto" onclick="location.href='aceptarNoticia.php';">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap.min.js"></script>

    <script src="optionSeccion.js"></script>
    <script src="insertSeccion.js"></script>
    <script src="deleteSeccion.js"></script>
</body>

</html>
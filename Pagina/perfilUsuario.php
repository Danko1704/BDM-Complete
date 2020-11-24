<?php
  include('Php/dbOrlando.php');
  session_start();
  error_reporting(0);
  $varSesion = $_SESSION['usuario'];
  $varSesionTipo =  $_SESSION['tipo'];

  $query= "call sp_infoUsuario('$varSesion')";
  $result = mysqli_query($con, $query, $query2) or die("Fail");
  $data = $result->fetch_assoc();
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="perfilUsuario_style.css">
    <title>3DJuegos</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center pt-2 mt-3 m-1">
            <div class="col-md-6 col-sm-8 col-xl-6 col-lg-5 perfil">
                <div class="form-group text-center pt-3">
                    <h1 class="text-dark">Usuario</h1>
                </div>

                <div class="image-preview text-center" id="imagePreview">
                    <img src=<?php echo 'multimedia/'.$data['imagenFile']?> alt="Image Preview"
                        class="image-preview__image rounded-circle text-center" height="70%" width="70%">
                    <span class="image-preview__default-text">Image Preview</span>
                </div>
                <div class="text-center">
                    <input type="file" id="inpFile" name="inpFile" hidden />
                    <label for="inpFile">Choose File</label>
                    <span id="file-chosen" name='textFile'>No file chosen</span>
                </div>

                <div class="form-group mx-sm-4 pt-3">
                    <input type="text" class="form-control text-black" placeholder="Ingrese su nombre" name="nombreBox"
                        value=<?php echo $data['nombre'] ?> required>
                </div>
                <div class="form-group mx-sm-4 pb-3">
                    <input type="mail" class="form-control text-black" placeholder="Ingrese su correo electrónico"
                        name="correoBox" value=<?php echo $data['correo'] ?> required>
                </div>
                <div class="form-group mx-sm-4 pb-3">
                    <input type="tel" class="form-control text-black" placeholder="Ingrese su número telefónico"
                        name="numeroBox" value=<?php echo $data['telefono'] ?> required>
                </div>
                <div class="form-group mx-sm-4 pb-3">
                    <input type="password" class="form-control text-black" placeholder="Ingrese su contraseña"
                        name="contraseñaBox" value=<?php echo $data['contraseña'] ?> required>
                </div>
                <div class="form-group mx-sm-4 pb-2" style="text-align: center;">
                    <span class="text-center"><a href="index.php" class="btn editar">Editar Perfil</a></span>
                </div>
                <div class="form-group mx-sm-4 pb-2" style="text-align: center;">
                    <span class="text-center"><a href="index.php" class="btn regresar">REGRESAR</a></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="perfilUsuario.js"></script>
</body>

</html>

<?php
  if($con){
    //if connection has been established display connected.
    echo 'CONECTADO';  
  }

  $result = $mysqli->query("call sp_infoUsuario('$varSesion');");

  while($data = $result->fetch_assoc()){
    echo "SI";
  }
?>
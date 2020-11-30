<?php

$host="localhost";
$user="root";
$password="Bmgbcfup123";
$dbname="proyectodb";

$con = mysqli_connect($host, $user, $password, $dbname);
if(mysqli_connect_errno()) {
	echo "Failed to connect to Data Base!";
	exit();
}

mysqli_select_db($con, $dbname) or die ("No se encuentra base de datos!");

//$con->close();
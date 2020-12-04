<?php

// $host="localhost";
// $port=3306;
// $socket="";
// $user="root";
// $password="admin";
// $dbname="proyectodb";

// $con = new mysqli($host, $user, $password, $dbname, $port, $socket)
// 	or die ('Could not connect to the database server' . mysqli_connect_error());

//$con->close();


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

?>
<?php

$host="localhost";
$port=3306;
$socket="";
$user="root";
$password="Bmgbcfup123";
$dbname="proyectodb";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

//$con->close();


?>
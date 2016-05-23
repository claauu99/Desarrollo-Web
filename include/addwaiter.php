<?php
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$rut = $_POST["rut"];

$codigo = $_POST["codigo"];


include("connect.php");
$insertar = mysql_query("INSERT INTO garzones(nombre, apellido, rut, codigo) VALUES('$nombre', '$apellido', '$rut',  '$codigo')") or die(mysql_error($link));

if($insertar){
	header("Location: ../seewaiter.php");
}else{
	echo ("Error");
}

?>
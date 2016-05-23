<?php
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$rut = $_POST["rut"];
$password = $_POST["password"];
$codigo = $_POST["codigo"];
$tipo = $_POST["tipo"];



include("connect.php");
$insertar = mysql_query("INSERT INTO usuario(nombre, apellido, rut, password, codigo, tipo) VALUES('$nombre', '$apellido', '$rut', '$password', '$codigo', '$tipo')") or die(mysql_error($link));

if($insertar){
	echo ("Exito");
}else{
	echo ("Error");
}

?>
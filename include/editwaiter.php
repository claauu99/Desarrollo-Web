<?php
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$rut = $_POST["rut"];
$codigo = $_POST["codigo"];



include("connect.php");
$actualizar = mysql_query("UPDATE garzones SET nombre = '$nombre', apellido = '$apellido', codigo='$codigo' WHERE rut='$rut' ") or die(mysql_error($link));

if($actualizar){
	header("Location: ../seewaiter.php");
	echo ("Exito");

}else{
	echo ("Error");
}

?>
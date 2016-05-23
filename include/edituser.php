<?php
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$rut = $_POST["rut"];
$password = $_POST["password"];
$codigo = $_POST["codigo"];



include("connect.php");
$actualizar = mysql_query("UPDATE usuario SET nombre = '$nombre', apellido = '$apellido', password='$password', codigo='$codigo' WHERE rut='$rut' ") or die(mysql_error($link));

if($actualizar){
	header("Location: ../seeuser.php");
	echo ("Exito");

}else{
	echo ("Error");
}

?>
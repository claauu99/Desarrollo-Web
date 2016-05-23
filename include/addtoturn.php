<?php

$personal = $_POST["personal"];
$fecha = $_POST["fecha"];
$turno = $_POST["turno"];
$i = 0;


include("connect.php");
foreach ($personal as $garzon) {
	$rut = $garzon["rut"];
	$porcentaje = $garzon["labor"];

	$insertar = mysql_query("INSERT INTO eventos(fecha, turno, garzon, propina) VALUES('$fecha', '$turno', '$rut', '$porcentaje')") or die(mysql_error($link));

	if($insertar){
		$i++;
	}else{
	
	}
}
echo $i . ' personas agregadas correctamente';
?>
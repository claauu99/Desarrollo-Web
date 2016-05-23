<?php
$turno = $_POST["turno"];
$fecha = $_POST["fecha"];
$monto = $_POST["monto"];



include("connect.php");
$insertar = mysql_query("INSERT INTO ganancia(fecha, turno, monto) VALUES('$fecha', '$turno', '$monto')") or die(mysql_error($link));

if($insertar){
	echo ("Exito");
}else{
	echo ("Error");
}
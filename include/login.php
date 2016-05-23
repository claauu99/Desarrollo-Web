<?php
$rut = $_POST["rut"];
$password = $_POST["password"];
date_default_timezone_set('America/Santiago');
$fecha = date("Y-m-d H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];

include("connect.php");
if(strcmp($rut,"administrador") == 0 && strcmp($password, "m3tr3s!garz0n3s") == 0){
	session_start(); 
	$log = mysql_query("INSERT INTO logs(usuario, ip, fecha) VALUES('administrador', '$ip','$fecha')");

	$_SESSION["usuario"] = "administrador";
	$_SESSION["tipo"] = 1;
	header("Location: ../dashboard.php");

}
else{
	$ver = mysql_query("SELECT * FROM usuario WHERE rut='$rut' AND password='$password'");
	if(mysql_num_rows($ver) > 0){
		while($row = mysql_fetch_assoc($ver)){
		session_start();
		$log = mysql_query("INSERT INTO logs(usuario, ip, fecha) VALUES('$rut', '$ip','$fecha')");
		if($row["tipo"] == 2){
			$_SESSION["tipo"] = 2;
			$_SESSION["usuario"] = $row["nombre"];
			header("Location: ../meter.php");
		}
		if($row["tipo"] == 3){
			$_SESSION["tipo"] = 3;
			$_SESSION["usuario"] = $row["nombre"];
			header("Location: ../cashier.php");
		}
		}
		

	}
	else{
		header("Location: ../index.php");
	}
}
?>
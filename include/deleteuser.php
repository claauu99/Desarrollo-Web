<?php

$rut = $_POST["rut"];

include("connect.php");
$borrar = mysql_query("DELETE FROM usuario WHERE rut='$rut'") or die(mysql_error($link));

if($borrar){
	header("Location: ../seeuser.php");
	echo ("Exito");

}else{
	echo ("Error");
}

?>
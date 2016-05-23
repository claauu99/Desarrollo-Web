<?php
$option = $_POST["option"];
include("connect.php");

$see = mysql_query("SELECT * FROM usuario WHERE tipo='$option'");
if(mysql_num_rows($see) > 0){

	$html = '
	<table class="table table-striped">
		<thead>
	    	<tr>
	      		<th>#</th>
	      		<th>RUT</th>
	      		<th>Nombre</th>
	      		<th>Código</th>
	      		<th>Acciones</th>
	    	</tr>
	  	</thead>
	  	<tbody>
	';
	$i = 1;
	while ($row = mysql_fetch_assoc($see) ) {
		$html .= '
		<tr class="userdata">
			<td>'.$i.'</td>
			<td>'.$row["rut"].'</td>
			<td>'.$row["nombre"] . " " . $row["apellido"].'</td>
			<td>'.$row["codigo"].'</td>
			<td><a href="edituser.php?u='.$row["rut"].'"><button type="button" class="btn btn-primary">Editar</button></a>
			<button type="button" class="btn btn-danger deleteuser" data-rut="'.$row["rut"].'" >Eliminar</button></td>
		</tr>
		';
		$i++;	
	}
	
	$html .= '
	</tbody>
	</table>
	';

	echo $html;
}
else{
	echo "No existen usuarios de este tipo";
}
?>
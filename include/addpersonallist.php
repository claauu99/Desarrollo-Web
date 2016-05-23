<?php
$fecha = $_POST["fecha"];
$turno = $_POST["turno"];
include("connect.php");

$see = mysql_query("SELECT * FROM garzones WHERE rut NOT IN (SELECT rut FROM eventos WHERE fecha='$fecha' AND turno='$turno')");
if(mysql_num_rows($see) > 0){

	$html = '
	<div class="addpersonal-form">
	<table style="margin-top:20px;" class="table table-striped">
		<thead>
	    	<tr>
	      		<th></th>
	      		<th>RUT</th>
	      		<th>Nombre</th>
	      		<th>Labor</th>
	    	</tr>
	  	</thead>
	  	<tbody>
	';
	$i = 1;
	while ($row = mysql_fetch_assoc($see) ) {
		$html .= '
		<tr class="row-personal">
			<td><input id="toSelect" type="checkbox" name="option"></td>
			<td id="rut">'.$row["rut"].'</td>
			<td>'.$row["nombre"] . " " . $row["apellido"].'</td>
			<td>
			<select class="form-control" id="porcentaje">
              <option value="7">Garzón</option>
              <option value="3">Ayudante</option>
          	</select>
		</tr>
		';
		$i++;	
	}
	
	$html .= '
	</tbody>
	</table>
	<button class="btn btn-success" id="addtoturn">Agregar al turno</button>
	</div>
	
	';

	echo $html;
}
else{
	echo '<div class="alert alert-danger" role="alert">Ya ha agregado todos los usuarios disponibles del sistema en este turno</div>';
}
?>
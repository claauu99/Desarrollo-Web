<?php
$fecha = $_POST["fecha"];
$turno = $_POST["turno"];
include("connect.php");

$cash = mysql_query("SELECT monto FROM ganancia WHERE fecha='$fecha' AND turno='$turno'");
if(mysql_num_rows($cash) > 0){
	while ($rowcash = mysql_fetch_assoc($cash) ) {
		$monto = $rowcash["monto"];
	}

}
else{
	$monto = 0;
}


$html = '';
$see = mysql_query("SELECT * FROM eventos where fecha='$fecha' AND turno='$turno' AND propina='7'");
if(mysql_num_rows($see) > 0){

	$html = '
	<div class="list-waiters">
	<h3>Garzones</h3>
	<table style="margin-top:20px;" class="table table-striped">
		<thead>
	    	<tr>
	      		<th>#</th>
	      		<th>RUT</th>
	      		<th>Nombre</th>
	      		<th>Propina</th>
	    	</tr>
	  	</thead>
	  	<tbody>
	';
	$i = 1;
	while ($row = mysql_fetch_assoc($see) ) {
		$rut = $row["garzon"];
		$datawaiter= mysql_query("SELECT * FROM garzones WHERE rut='$rut'");
		if($row2 =mysql_fetch_assoc($datawaiter)){
			$html .= '
			<tr>
				<td>'.$i.'</td>
				<td>'.$row["garzon"].'</td>
				<td>'.$row2["nombre"] . " " . $row2["apellido"].'</td>
				<td>$'.($monto*0.07)/mysql_num_rows($see).'</td>
			</tr>
			';
			$i++;
		}	
	}
	
	$html .= '
	</tbody>
	</table>
	</div>
	';
	
	
}
else{
	echo '<div class="alert alert-danger" role="alert" style="margin-bottom:10px; display:none;">No existen garzones en este turno</div>';
}

$see = mysql_query("SELECT * FROM eventos where fecha='$fecha' AND turno='$turno' AND propina='3'");
if(mysql_num_rows($see) > 0){

	$html .= '
	<div class="list-waiters">
	<h3>Ayudantes</h3>
	<table style="margin-top:20px;" class="table table-striped">
		<thead>
	    	<tr>
	      		<th>#</th>
	      		<th>RUT</th>
	      		<th>Nombre</th>
	      		<th>Propina</th>
	    	</tr>
	  	</thead>
	  	<tbody>
	';
	$i = 1;
	while ($row = mysql_fetch_assoc($see) ) {
		$rut = $row["garzon"];
		$datawaiter= mysql_query("SELECT * FROM garzones WHERE rut='$rut'");
		if($row2 =mysql_fetch_assoc($datawaiter)){
			$html .= '
			<tr>
				<td>'.$i.'</td>
				<td>'.$row["garzon"].'</td>
				<td>'.$row2["nombre"] . " " . $row2["apellido"].'</td>
				<td>$'.($monto*0.03)/mysql_num_rows($see).'</td>
			</tr>
			';
			$i++;
		}	
	}
	
	$html .= '
	</tbody>
	</table>
	</div>
	';

	echo $html;
}
else{
	echo '<div class="alert alert-danger" role="alert" style="margin-bottom:10px; display:none;">No existen ayudantes en este turno</div>';
}
?>
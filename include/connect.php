<?php
// Conectando, seleccionando la base de datos
$link = mysql_connect('localhost', 'root', '1231233')
    or die('No se pudo conectar: ' . mysql_error());
//echo 'Conexión exitosa';
mysql_select_db('porton_bdd') or die('No se pudo seleccionar la base de datos');
mysql_query("SET NAMES 'utf8'");
?>

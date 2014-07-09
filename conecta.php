<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
$conexion = mysql_connect('localhost','montenoso5','cartosachador') or die("No se pudo realizar la conexion con el servidor.");
mysql_query("SET NAMES 'utf8'", $conexion);
mysql_select_db("cartografia" ,$conexion) or die("No se puede seleccionar BD"); 
?>

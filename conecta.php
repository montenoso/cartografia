<?php

require_once('conf.php');

$conexion = mysql_connect($bbdd_host, $bbdd_user, $bbdd_password) or die("No se pudo realizar la conexion con el servidor.");
mysql_query("SET NAMES 'utf8'", $conexion);
mysql_select_db($bbdd_name  ,$conexion) or die("No se puede seleccionar BD"); 

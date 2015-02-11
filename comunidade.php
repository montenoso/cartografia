<?php
session_start();
include("conecta.php");
		
if ( isset($_GET['q']) && is_numeric($_GET['q']) ){
	$id = $_GET['q'];      
	
	$queryFicha = "SELECT * FROM documento WHERE material_id = $id";
	
	$result = mysql_query($queryFicha,$conexion);


		 
	$registro= mysql_fetch_object($result);	

	if (!$result || $registro->selectedradio != 'comunidade') {
		header('Location: '.$media_host);
	}
	else {


		$titulo = $registro->titulo_registro;
		$descripción= $registro->descripcion;
		$tema = $registro-> tema;
		$tag = $registro-> tag;
		$URL = $registro-> URL;
		$nombre = $registro-> nombre_archivo;
		$tag = $registro-> tag;
		$extension = $registro-> extension;
		$selectedRadio = $registro-> selectedradio;

		//
		//	Captación de datos finalizada :)
		//	Agora imos co corpo da páxina
		//


	?>







	<!DOCTYPE html>
	<html>
	<head>
	  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title> <?php echo $titulo;?> </title>
	</head>
	<body>


		<h2><?php echo $titulo;?></h2>
		<div><?php echo $descripción; ?></div>
		<div><?php echo $URL; ?> <?php echo $URL; ?></a></div>
		<div style="width:200px;height:200px;background-color:grey;" id="mapa"></div>
<?php 
		if( $selectedRadio == 'comunidade' ) {
			echo "<a href='$media_host#recurso/$registro->material_id'>Ver na cartografía</a>";
		}
?>

	<div>
<?php 
		global $typeform_export_path, $typeform_api_url, $typeform_correspondencias;
		$fpath = $typeform_export_path.'/'.$typeform_correspondencias[$id].'.php' ;
		if( file_exists( $fpath  ) ) {
			echo "<h2>Máis datos</h2>";
			require_once($fpath );
		}
?>
	</div>


    <script src="https://maps.googleapis.com/maps/api/js?libraries=geometry&v=3.exp&sensor=false"></script>
    <script src="<?php echo $media_host;?>/js/vendor/jquery.min.js"></script>
	  <script src="<?php echo $media_host;?>/js/ficha_comunidade.js"></script>
	</body>
	</html>
<?php
	}
}
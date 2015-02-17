<?php
session_start();
include("conecta.php");


function ocorreuUnErro() { die ("Ocorreu un erro, contacte coas administradoras do sistema. Moitas grazas."); }

    
if ( !isset($_GET['id']) || !is_numeric($_GET['id']) ) {
  ocorreuUnErro();
}


$id = $_GET['id'];      

$queryFicha = "SELECT * FROM documento WHERE material_id = $id";

$result = mysql_query($queryFicha,$conexion);

if(!$result) {
  ocorreuUnErro();
}

   
$registro= mysql_fetch_object($result); 


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
//  Captación de datos finalizada :)
//  Agora imos co corpo da páxina
//
?>



<?php if( $registro->selectedradio == 'comunidade') :?>

    <h2><?php echo $titulo;?></h2>
    <div><?php echo $descripción; ?></div>
    <div><?php echo $URL; ?> <?php echo $URL; ?></a></div>

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

<?php else:?>

<?php endif;?>



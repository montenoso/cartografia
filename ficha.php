<?php
session_start();
include("conecta.php");


function ocorreuUnErro() { die ("Ocorreu un erro, contacte coas administradoras do sistema. Moitas grazas."); }

function getSliderElement($e) {
  return "<li><a onclick='mapControl.mapa_selecciona_elemento(" . $e->material_id . ")' href='#'>" . $e->titulo_registro . "</a></li>";
}
















    
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



if( $selectedRadio == 'comunidade')  {
  $queryFillos = "SELECT * FROM documento WHERE pai = $id";

  $result = mysql_query($queryFillos,$conexion);
  if($result) {
    $slider = '';
    while( $e = mysql_fetch_object($result) ) {
      $slider .= getSliderElement( $e );
    }
    $slider = "<h3>Relacionados<h3><ul>".$slider."</ul>";
  }

}

//
//  Captación de datos finalizada :)
//  Agora imos co corpo da páxina
//
?>



<?php if( $selectedRadio == 'comunidade') :?>

    <h2><?php echo $titulo;?></h2>
    <div><?php echo $descripción; ?></div>
    <div><?php echo $URL; ?> <?php echo $URL; ?></a></div>
    <div><?php echo $slider; ?></div>
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

  <div>

<?php else:?>



    <h2><?php echo $titulo;?></h2>
    <div><?php echo $descripción; ?></div>
    <div><?php echo $URL; ?> <?php echo $URL; ?></a></div>

  <div>

  </div>

<?php
   $nombre_fichero_sin_espacios=str_replace(" ","",$nombre);?> 
            
        <?php
   if($extension == "image/jpeg" || $extension == "image/png" || $extension == "image/gif" || $extension == "image/tiff"){
?> <img src="uploads/<?php echo $nombre_fichero_sin_espacios; ?>"/>
    <br>
<?php }
    if($extension == "audio/x-wav" || $extension =="audio/mpeg"){
?>  <audio controls="controls" src="uploads/<?php echo $nombre_fichero_sin_espacios; ?>"/></audio>
    <br>
<?php }
    if($extension == "video/quicktime" || $extension == "video/mp4"){
?> <video controls="controls" src="uploads/<?php echo $nombre_fichero_sin_espacios; ?>" ></video>
    <br>
<?php }

    echo "<div> ".$tag."</div>";
?>
<?php endif;?>



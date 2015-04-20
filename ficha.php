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
$descripcion= $registro->descripcion;
//$tema = $registro-> tema;
$tag = $registro-> tag;
$URL = $registro-> URL;
$nombre = $registro-> nombre_archivo;
$tag = $registro-> tag;
//$extension = $registro-> extension;
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

  $queryCategorias = "SELECT group_concat(categoria) as categorias from documento where pai=$id group by pai;";

  $result = mysql_fetch_object( mysql_query($queryCategorias,$conexion) );
  if( $result ){
    $categorias = array_unique( explode(",", $result->categorias) );
  }
}




if( $selectedRadio == 'comunidade') {
  require_once('fichaComunidade.php');
}
else{
  require_once('fichaRecurso.php');

}
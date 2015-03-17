<?php

function previr_inxeccion($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);

  return $data;
}









//
//	Formulario
//
$postPost = array();
foreach ($_POST as $k => $val) {
	$postPost[$k] = previr_inxeccion($val);
}




$erros = 0;
$erros_mensaxe = "";


if( !is_numeric( $postPost['comunidade']) ) {
	$erros_mensaxe .= "- Selecciona a comunidade <br>" ;
  $erros++;
}

if( !is_numeric( $postPost['lat']) ||  !is_numeric( $postPost['lat']) ) {
  $erros_mensaxe .= "- As coordenadas non están nun formato lexible <br>" ;
  $erros++;
}




// lonxitudes
if( sizeof( $postPost['nome']) > 200  || $postPost['nome'] == '') {
  $erros_mensaxe .= "- Título demasiado longo" ;
  $erros++;
}

if( sizeof( $postPost['descripcion']) > 3000|| $postPost['descripcion'] == '') {
  $erros_mensaxe .= "- Descripción demasiado longa" ;
  $erros++;
}





// documentos
if( array_key_exists('documento_audio', $postPost) ) {

  if( sizeof( $postPost['documento_audio']) > 100  || $postPost['documento_audio'] == '' ) {
    $erros_mensaxe .= "- A url do documento audio non é válida" ;
    $erros++;
  }
}
else
if( array_key_exists('documento_video', $postPost) ) {
  if( sizeof( $postPost['documento_video']) > 100  || $postPost['documento_video'] == '' ) {

    $erros_mensaxe .= "- A url do documento video non é válida" ;
    $erros++;
  }
}
else{
  $erros_mensaxe .= "Debe engadir un arquivo ou URL";
  $erros++;
}





// RESULTADO
if( $erros ){
	include 'doc.php';
}
else {

}
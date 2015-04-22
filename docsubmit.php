<?php

  require( 'wp-load.php' );

  if ( !is_user_logged_in() ) {
    header("Location: ../web_nova/carto-login.php");
    exit;
    //require_once("conf.php");
  }

 global $CARTOGRAFIA_UPLOAD_DIR;
 $CARTOGRAFIA_UPLOAD_DIR = '../cartografia_nova/uploads';

function previr_inxeccion($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);

  return $data;
}

function garda_arquivo($arquivo) {


  global $CARTOGRAFIA_UPLOAD_DIR;

  preg_match('/\.[^\.]+$/i',$arquivo['name'],$ext);

  $nome_final = sprintf('%s%s',
        sha1_file($arquivo['tmp_name']),
        $ext[0]
    );

  $ruta = $CARTOGRAFIA_UPLOAD_DIR . '/'.$nome_final;

  move_uploaded_file(
    $arquivo['tmp_name'],
    $ruta
  );

  return $nome_final;
}

function erros_en_arquivo($arquivo, $formatos_permitidos) {


  try {
    if (
        !isset($arquivo['error']) ||
        is_array($arquivo['error'])
    ) {
        throw new RuntimeException('Parámetros inválidos.');
    }

    switch ($arquivo['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('Non se atopa o arquivo.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('O arquivo é demasiado grande.');
        default:
            throw new RuntimeException('Error descoñecido.');
    }

    if ($arquivo['size'] > 5000000) {
        throw new RuntimeException('O arquivo é demasiado grande.');
    }




    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($arquivo['tmp_name']),
        $formatos_permitidos
        ,
        true
    )) {
        throw new RuntimeException('Formato non permitido.');
    }


  } catch (RuntimeException $e) {

    return $e->getMessage();
  }


  return false;
}






//
//	Formulario
//
$postPost = array();
foreach ($_POST as $k => $val) {
	$postPost[$k] = previr_inxeccion($val);
}



$tipo_documento = false;
$erros = 0;
$erros_mensaxe = "";


if( !is_numeric( $postPost['comunidade']) ) {
	$erros_mensaxe .= "<li>Selecciona a comunidade </li>" ;
  $erros++;
}

if( !is_numeric( $postPost['lat']) ||  !is_numeric( $postPost['lat']) ) {
  $erros_mensaxe .= "<li>As coordenadas non están nun formato lexible </li>" ;
  $erros++;
}




// lonxitudes
if( sizeof( $postPost['nome']) > 200  || $postPost['nome'] == '') {
  $erros_mensaxe .= "<li>Título demasiado longo</li>" ;
  $erros++;
}

if( sizeof( $postPost['descripcion']) > 3000|| $postPost['descripcion'] == '') {
  $erros_mensaxe .= "<li>Descripción demasiado longa </li>" ;
  $erros++;
}




// documentos
if( array_key_exists('documento_audio', $postPost) ) {
  $tipo_documento = 'audio';
  if( sizeof( $postPost['documento_audio']) > 100  || $postPost['documento_audio'] == '' ) {
    $erros_mensaxe .= "<li>A url do documento audio non é válida </li>" ;
    $erros++;
  }
}
else
if( array_key_exists('documento_video', $postPost) ) {
  $tipo_documento = 'video';
  if( sizeof( $postPost['documento_video']) > 100  || $postPost['documento_video'] == '' ) {

    $erros_mensaxe .= "<li>A url do documento video non é válida </li>" ;
    $erros++;
  }
}
else
if( array_key_exists('documento_foto', $_FILES) ) {
  $tipo_documento = 'foto';

  $tipos_permitidos = array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif'
        );

  if( $erro = erros_en_arquivo( $_FILES['documento_foto'], $tipos_permitidos) ) {

    $erros_mensaxe .= "<li>".$erro." </li>" ;
    $erros++;
  }
}
else
if( array_key_exists('documento_texto', $_FILES) ){
  $tipo_documento = 'texto';

  $tipos_permitidos = array(
            'odt' => 'application/vnd.oasis.opendocument.text',
            'odf' => 'application/odt',
            'doc' => 'application/doc',
            'pdf' => 'application/pdf'
        );

  if( $erro = erros_en_arquivo( $_FILES['documento_texto'], $tipos_permitidos) ) {

    $erros_mensaxe .= "<li>".$erro." </li>" ;
    $erros++;
  }
}
else{
  $erros_mensaxe .= "<li>Debe engadir un arquivo ou URL </li>";
  $erros++;
}




// RESULTADO
if( $erros ){
  require_once( 'doc.php');
}
else {

  if( $tipo_documento == 'video' ) {
    $tipo_campo = 'URL';
    $nome_documento = $postPost['documento_video'];
  }
  else
  if( $tipo_documento == 'audio' ) 
  {    
    $tipo_campo = 'URL';
    $nome_documento = $postPost['documento_audio'];
  }
  else
  if( $tipo_documento=='foto' ){
    $tipo_campo = 'nombre_archivo';
    $nome_documento = garda_arquivo($_FILES['documento_foto']);

    // redimensiona imaxe
    global $CARTOGRAFIA_UPLOAD_DIR;
    require_once('redimensionaImaxe.php');
    redimensionaImaxe( $CARTOGRAFIA_UPLOAD_DIR.'/'.$nome_documento,  $CARTOGRAFIA_UPLOAD_DIR.'/200_'.$nome_documento, 200);
    redimensionaImaxe( $CARTOGRAFIA_UPLOAD_DIR.'/'.$nome_documento,  $CARTOGRAFIA_UPLOAD_DIR.'/800_'.$nome_documento, 800);

/*
    $im = new Imagick( 'uploads/'.$nome_documento  );

    $im->scaleImage(1024, 1024, true); 
    $im->writeImage('uploads/1024_'.$nome_documento);
    $im->scaleImage(300, 300, true); 
    $im->cropImage(300, 150, 0, 0);
    $im->writeImage('uploads/300_'.$nome_documento);
*/

  }
  else
  if( $tipo_documento=='texto' ){
    $tipo_campo = 'nombre_archivo';
    $nome_documento = garda_arquivo($_FILES['documento_texto']);
  }

  $username='Anonymous';

  
  global $current_user;
  get_currentuserinfo();
  $username= $current_user->user_login;

  // crea rexistro
  require_once("conecta.php");
  $retObj = false;
  $queryFicha = " INSERT INTO documento (usuari, pai, titulo_registro, descripcion, ".$tipo_campo.", latitud, longitud, selectedradio, tag, categoria, fecha_inser  )
              VALUES ('" . $username ."' ,".$postPost['comunidade'].", '".$postPost['nome']."', '".$postPost['descripcion']."', '".$nome_documento."', '".$postPost['lat']."','".$postPost['lon']."', '".$tipo_documento."', '".$postPost['tags']."', '".$postPost['categorias']."', '".date('Y-m-d H:i:s')."' );";

//echo $queryFicha;
//exit;
  $result = mysql_query($queryFicha,$conexion);



?>
  <html>
    <head>
    </head>
    <style>
    </style>
    <body>
      <?php echo "Redirixindo ..."; ?>
      <script>
        parent.window.location = 'http://montenoso.net/web_nova/?page_id=66';
      </script>

    </body>
  </html>

<?php

}
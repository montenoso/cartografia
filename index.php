<?php

if( !isset( $_SESSION )) {
  session_start();
}

require_once("conf.php");
include("conecta.php");
?>

<!--

  CARTOGRAFÍA

-->


    <script src="https://maps.googleapis.com/maps/api/js?libraries=geometry&v=3.exp&sensor=false"></script>

    <script src="<?php echo $media_host;?>/js/estilos_mapa.js"></script>
    <script src="<?php echo $media_host;?>/js/vendor/tiny_map_utilities/marker_clusterer/vendor/rbush.js"></script>
    <script src="<?php echo $media_host;?>/js/vendor/tiny_map_utilities/marker_clusterer/marker_clusterer.js"></script>
    <script src="<?php echo $media_host;?>/js/vendor/tiny_map_utilities/smart_infowindow/vendor/jQueryRotate.js"></script>
    <script src="<?php echo $media_host;?>/js/vendor/tiny_map_utilities/smart_infowindow/smart_infowindow.js"></script>      
    <script src="<?php echo $media_host;?>/js/vendor/nzAutoCompleter/nzAutoCompleter.js"></script> 

    <link rel="stylesheet" href="http://libs.cartocdn.com/cartodb.js/v3/themes/css/cartodb.css" />
    <link rel="stylesheet" href="<?php echo $media_host;?>/css/estilos_mapa.css" />
    <link rel="stylesheet" href="<?php echo $media_host;?>/css/iconografias.css" />
    <link rel="stylesheet" href="<?php echo $media_host;?>/js/vendor/nzAutoCompleter/nzAutoCompleter.css" />

    <script src="http://libs.cartocdn.com/cartodb.js/v3/cartodb.js"></script>

    <script src="<?php echo $media_host;?>/js/utils.js"></script>
    <script src="<?php echo $media_host;?>/js/filtrosController.js"></script>
    <script src="<?php echo $media_host;?>/js/interfazController.js"></script>
    <script src="<?php echo $media_host;?>/js/formController.js"></script>
    <script src="<?php echo $media_host;?>/js/mapController.js"></script>
    <script src="<?php echo $media_host;?>/js/main.js"></script>


    <script type="text/javascript" >
    
      <?php
        $sql = "SELECT material_id, longitud, latitud, selectedradio, titulo_registro, tag  FROM documento ORDER BY fecha_inser DESC";
        $consulta = mysql_query($sql) or die ("No se pudo ejecutar la consulta");
        $datos = mysql_query($sql, $conexion);
        $markers= array();
        while ($resultado = mysql_fetch_assoc($datos)) {
          $markers[]=$resultado;
        }
        $markersJson=json_encode($markers);

        echo "var host_cartografia = '".$media_host."';";
        echo "var recursos = ".$markersJson.";";

        echo "var mvmc_url='". $media_host ."/mvmc_centroids_min.json';";
        echo "var micromarker_png='". $media_host ."/images/micromarker.png';";
      ?> 

    </script>

    <div id="espacio_mapa" >
      <div id="map"></div> 
      <div id="cortina_mapa" style="display:none;"></div>
      <div id="display_mapa" >
        <div id="display_mapa_engadir" style="display:none;">
          <iframe src="/cartografia_nova/doc.php" id="iframe_formulario" style="width:100%;border:0;"></iframe>

        </div>
        <div id="display_mapa_content" style="display:none;"></div>

        <div id="display_mapa_filters">          
          <div> <input id="buscaRecursos" type="text" class="caixaBusqueda" style="display:none;"></div>
          <div class="filtro filtros-buscar boton-filtros"></div>
          <div class="filtro categorias"></div>
          <div class="filtro filtros-add boton-filtros" onclick="mapa_establece_url('#novo' );" ></div>
        </div>
        <div id="display_destacados">
          Aquí <br>
          tes <br>
          a <br>
          túa <br>
          magnífica <br>
          barra <br>
          de <br>
          destacados <br>
        </div>
      </div>
    </div>

<!--

  CARTOGRAFÍA

-->
<?php
session_start();
require_once("conf.php");
include("conecta.php");
?>

<!DOCTYPE HTML>
<html>
  <head>
      <title>Cartografía</title>
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      <meta name="description" content="" />
      <meta name="keywords" content="" />


      <script src="https://maps.googleapis.com/maps/api/js?libraries=geometry&v=3.exp&sensor=false"></script>
      <script src="<?php echo $media_host;?>/js/vendor/jquery.min.js"></script>
      <script src="<?php echo $media_host;?>/js/estilos_mapa.js"></script>
      <script src="<?php echo $media_host;?>/js/vendor/tiny_map_utilities/marker_clusterer/vendor/rbush.js"></script>
      <script src="<?php echo $media_host;?>/js/vendor/tiny_map_utilities/marker_clusterer/marker_clusterer.js"></script>
      <script src="<?php echo $media_host;?>/js/vendor/tiny_map_utilities/smart_infowindow/vendor/jQueryRotate.js"></script>
      <script src="<?php echo $media_host;?>/js/vendor/tiny_map_utilities/smart_infowindow/smart_infowindow.js"></script>      
      <script src="<?php echo $media_host;?>/js/vendor/nzAutoCompleter/nzAutoCompleter.js"></script> 
  
      <link rel="stylesheet" href="http://libs.cartocdn.com/cartodb.js/v3/themes/css/cartodb.css" />
      <link rel="stylesheet" href="css/estilos_mapa.css" />
      <link rel="stylesheet" href="<?php echo $media_host;?>/js/vendor/nzAutoCompleter/nzAutoCompleter.css" />

      <script src="http://libs.cartocdn.com/cartodb.js/v3/cartodb.js"></script>

      <script src="<?php echo $media_host;?>/js/utils.js"></script>
      <script src="<?php echo $media_host;?>/js/filtrosController.js"></script>
      <script src="<?php echo $media_host;?>/js/interfazController.js"></script>
      <script src="<?php echo $media_host;?>/js/mapController.js"></script>
      <script src="<?php echo $media_host;?>/js/main.js"></script>


      <script type="text/javascript" >
      
        <?php
          $sql = "SELECT material_id, longitud, latitud, selectedradio, titulo_registro FROM documento ORDER BY fecha_inser DESC";
          $consulta = mysql_query($sql) or die ("No se pudo ejecutar la consulta");
          $datos = mysql_query($sql, $conexion);
          $markers= array();
          while ($resultado = mysql_fetch_assoc($datos)) {
            $markers[]=$resultado;
          }
          $markersJson=json_encode($markers);

          echo "var recursos = ".$markersJson.";";
          //echo 'var recursos = [{"material_id":"381","longitud":"-7.885548","latitud":"42.652097","selectedradio":"comunidade","titulo_registro":"C.M de Argoz\u00f3n"},{"material_id":"379","longitud":"-8.422291","latitud":"42.181160","selectedradio":"comunidade","titulo_registro":"C.M de Guillade"},{"material_id":"350","longitud":"-8.423557820101438","latitud":"42.17172591101379","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Guillade Esp\u00edritu da Tribu"},{"material_id":"312","longitud":"-7.875625433779154","latitud":"42.661015735400454","selectedradio":"foto","titulo_registro":"Baixada do Faro"},{"material_id":"332","longitud":"-8.419298472186432","latitud":"42.18681664969104","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Mouriscados Proxecto Arqueol\u00f3xico divulgativo"},{"material_id":"330","longitud":"-8.413118662616986","latitud":"42.19904833050993","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Mouriscados Patrimonio Mu\u00ed\u00f1os"},{"material_id":"329","longitud":"-8.419749083300644","latitud":"42.18877644354176","selectedradio":"video","titulo_registro":" Monte Veci\u00f1al en Mancom\u00fan Mouriscados Apicultura Heroica"},{"material_id":"327","longitud":"-8.416079821368712","latitud":"42.18686593746857","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Mouriscados Paisaxe Mosaico"},{"material_id":"328","longitud":"-8.418182673235908","latitud":"42.19116016537233","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Mouriscados Panor\u00e1mica"},{"material_id":"322","longitud":"-8.112754168334819","latitud":"43.34128998751351","selectedradio":"foto","titulo_registro":"Os Estatutos da Comunidade"},{"material_id":"324","longitud":"-8.124405684294397","latitud":"43.34971648070634","selectedradio":"foto","titulo_registro":"Suso e o plano do monte"},{"material_id":"306","longitud":"-7.887598814819993","latitud":"42.65195766920013","selectedradio":"video","titulo_registro":"Xantar no pi\u00f1eiro, onde se calzan as medias"},{"material_id":"321","longitud":"-8.109771551910653","latitud":"43.35083992472073","selectedradio":"foto","titulo_registro":"Campo de f\u00fatbol vello"},{"material_id":"314","longitud":"-7.886731916484649","latitud":"42.660379809322386","selectedradio":"video","titulo_registro":"A capela de Santa Eufemia relatada"},{"material_id":"315","longitud":"-7.883255773601741","latitud":"42.661590091769675","selectedradio":"audio","titulo_registro":"O Lu\u00eds"},{"material_id":"316","longitud":"-8.105866255585525","latitud":"43.34272569494364","selectedradio":"foto","titulo_registro":"O plano do monte"},{"material_id":"317","longitud":"-7.89023811","latitud":"42.63225892","selectedradio":"video","titulo_registro":"F\u00e1cendose amigo dos lobos"},{"material_id":"318","longitud":"-8.067757429907207","latitud":"43.334173371233554","selectedradio":"foto","titulo_registro":"O plano do monte"},{"material_id":"319","longitud":"-8.12153035623002","latitud":"43.349825705345566","selectedradio":"foto","titulo_registro":"Suso, presidente da CVMV de Torres Vilarmaior"},{"material_id":"320","longitud":"-8.124319853605433","latitud":"43.349841308848575","selectedradio":"foto","titulo_registro":"Suso, presidente da Comunidade de Veci\u00f1os"},{"material_id":"351","longitud":"-8.424555601854468","latitud":"42.17240389779881","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Guillade Pervivencia do Comunal"},{"material_id":"352","longitud":"-8.424104990740165","latitud":"42.17269650666581","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Guillade Comunal Garante da Natureza"},{"material_id":"353","longitud":"-8.42511350132973","latitud":"42.172117642355815","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Guillade Historia do Mancom\u00fan"},{"material_id":"354","longitud":"-8.426830115098696","latitud":"42.17504212796754","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Guillade O Comunal e os Veci\u00f1os"},{"material_id":"355","longitud":"-8.433782400864603","latitud":"42.17674368911231","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Guillade Xesti\u00f3n Sustentable"},{"material_id":"356","longitud":"-8.426765742082534","latitud":"42.17493875714933","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Guillade Agricultura"},{"material_id":"357","longitud":"-8.427296819467534","latitud":"42.174775255794685","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Guillade Vaca Cachena "},{"material_id":"358","longitud":"-8.427151980180673","latitud":"42.17470659015684","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Guillade Gando para mantemento "},{"material_id":"359","longitud":"-8.44150716282625","latitud":"42.18461826051617","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Guillade Obxectivos "},{"material_id":"361","longitud":"-8.136164488613769","latitud":"43.417211004447395","selectedradio":"foto","titulo_registro":"Ram\u00f3n"},{"material_id":"362","longitud":"-8.11324769479347","latitud":"43.29017542753534","selectedradio":"foto","titulo_registro":"Vaca no Monte Comunal"},{"material_id":"364","longitud":"-8.117110075774608","latitud":"43.28870723957193","selectedradio":"foto","titulo_registro":"Monte de San Ant\u00f3n"},{"material_id":"365","longitud":"-8.118140044035629","latitud":"43.42643731503796","selectedradio":"video","titulo_registro":""},{"material_id":"366","longitud":"-8.118140044035629","latitud":"43.42643731503796","selectedradio":"video","titulo_registro":""},{"material_id":"367","longitud":"-8.129984679044234","latitud":"43.42718533265417","selectedradio":"video","titulo_registro":"Perto das oficinas do Parque Natural Fragas do Eume"},{"material_id":"368","longitud":"-8.119609894575854","latitud":"43.417816326766754","selectedradio":"video","titulo_registro":"en coche polo MVMC de Ombre "},{"material_id":"370","longitud":"-8.131003918469617","latitud":"43.42718533265352","selectedradio":"foto","titulo_registro":"Eugenio "},{"material_id":"372","longitud":"-8.122088255705464","latitud":"43.42138795437048","selectedradio":"foto","titulo_registro":"De vistas ao Eume"},{"material_id":"374","longitud":"-8.125092329801715","latitud":"43.4216061453277","selectedradio":"foto","titulo_registro":"Monte adentro"},{"material_id":"375","longitud":"-8.115822615447412","latitud":"43.4170863149464","selectedradio":"foto","titulo_registro":"O linde do monte"},{"material_id":"376","longitud":"-8.124620261015238","latitud":"43.34974768776449","selectedradio":"foto","titulo_registro":"casa e industria labrega"},{"material_id":"377","longitud":"-8.125864805997638","latitud":"43.34934199473407","selectedradio":"foto","titulo_registro":"Horreo"},{"material_id":"378","longitud":"-8.12582189065374","latitud":"43.349498030836266","selectedradio":"video","titulo_registro":"Conversando co presidente da Comunidade do Monte"},{"material_id":"373","longitud":"-903821.87143298","latitud":"5376199.1631678","selectedradio":"foto","titulo_registro":"O Eume m\u00e1is que un parque"},{"material_id":"371","longitud":"-905073.52777098","latitud":"5375568.5576845","selectedradio":"foto","titulo_registro":"Cos eucaliptos"},{"material_id":"369","longitud":"-905278.95228446","latitud":"5376132.280768","selectedradio":"foto","titulo_registro":"De paseo"},{"material_id":"333","longitud":"-937129.30650358","latitud":"5188914.1081617","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Mouriscados Paneis Proxecto Arqueolox\u00eda "},{"material_id":"339","longitud":"-936570.36073435","latitud":"5188827.1609836","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Mouriscados Multifuncionalidade Incendios"},{"material_id":"360","longitud":"-905670.69205435","latitud":"5375750.0956265","selectedradio":"foto","titulo_registro":"o horizonte do monte"},{"material_id":"363","longitud":"-903162.60206411","latitud":"5356244.3214737","selectedradio":"foto","titulo_registro":"Vaca no Monte Comunal"},{"material_id":"349","longitud":"-938108.6559284","latitud":"5187234.8824886","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Guillade Conflictos entre veci\u00f1os"},{"material_id":"348","longitud":"-937752.74601549","latitud":"5186703.1671775","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Guillade Conflictos"},{"material_id":"347","longitud":"-937802.90781526","latitud":"5186683.1023989","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Guillade Patriarcado"},{"material_id":"346","longitud":"-937845.9036437","latitud":"5186546.710135","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Guillade Avellentamento"},{"material_id":"345","longitud":"-938873.02621112","latitud":"5187550.6626991","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Guillade Colectividade"},{"material_id":"344","longitud":"-938920.79935381","latitud":"5187472.3147741","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Guillade Aumento de Comuneiras"},{"material_id":"343","longitud":"-938925.57666806","latitud":"5187596.5272777","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Guillade Perspectiva dunha Comuneira"},{"material_id":"342","longitud":"-937580.76270187","latitud":"5188817.3676207","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Guillade Arqueolox\u00eda Petroglifo Laxe"},{"material_id":"341","longitud":"-937669.14301579","latitud":"5186364.2167446","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Guillade Futuro do Monte"},{"material_id":"340","longitud":"-937783.79855822","latitud":"5186347.2610549","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Guillade presentaci\u00f3n do Monte"},{"material_id":"338","longitud":"-937473.27313087","latitud":"5189788.3595885","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Mouriscados Delincuencia Porco celta"},{"material_id":"337","longitud":"-937181.85696055","latitud":"5189553.3166889","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Mouriscados Imaxes Porco celta"},{"material_id":"336","longitud":"-937009.87364691","latitud":"5189490.2522918","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Mouriscados dieta cabalos"},{"material_id":"335","longitud":"-937040.92618967","latitud":"5189569.4017813","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Mouriscados Cabalos "},{"material_id":"334","longitud":"-937186.63427481","latitud":"5188720.9498631","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Mouriscados Arqueolox\u00eda Marcos M\u00e1moas "},{"material_id":"331","longitud":"-936527.36490595","latitud":"5190801.7902401","selectedradio":"video","titulo_registro":"Monte Veci\u00f1al en Mancom\u00fan Mouriscados Patrimonio R\u00edos "},{"material_id":"326","longitud":"-903950.85891819","latitud":"5376910.9829937","selectedradio":"video","titulo_registro":"Falando con Jorge V\u00e1zquez, director do Parque Natural Fragas do Eume"},{"material_id":"325","longitud":"-901108.35692925","latitud":"5364714.4996695","selectedradio":"foto","titulo_registro":"As pi\u00f1as"},{"material_id":"323","longitud":"-901065.36110082","latitud":"5364833.9325261","selectedradio":"foto","titulo_registro":"Marco linde do monte"},{"material_id":"307","longitud":"-875712.15428501","latitud":"5259833.3422483","selectedradio":"video","titulo_registro":"Non hai monte sen base social"},{"material_id":"313","longitud":"-878049.69322288","latitud":"5259177.8919753","selectedradio":"video","titulo_registro":"Fin do xantar no pi\u00f1eiro"},{"material_id":"305","longitud":"-876839.60045207","latitud":"5260731.4773305","selectedradio":"video","titulo_registro":"A fonte Sana Barrigas"},{"material_id":"311","longitud":"-876051.34359798","latitud":"5260607.2671594","selectedradio":"foto","titulo_registro":"Presentaci\u00f3n do proxecto O monte \u00e9 noso"},{"material_id":"309","longitud":"-876051.34359798","latitud":"5260607.2671594","selectedradio":"foto","titulo_registro":"Presentaci\u00f3n do proxecto O monte \u00e9 noso"},{"material_id":"310","longitud":"-876051.34359798","latitud":"5260607.2671594","selectedradio":"foto","titulo_registro":"Presentaci\u00f3n do proxecto O monte \u00e9 noso"},{"material_id":"308","longitud":"-877775.95404842","latitud":"5260397.0653319","selectedradio":"foto","titulo_registro":"Os e\u00f3licos"},{"material_id":"304","longitud":"-876185.10839747","latitud":"5260643.0970165","selectedradio":"foto","titulo_registro":"A Casa Rectoral "},{"material_id":"380","longitud":"-8.428194","latitud":"42.199056","selectedradio":"comunidade","titulo_registro":"C.M de Mouriscados"},{"material_id":"382","longitud":"-8.133933","latitud":"43.419922","selectedradio":"comunidade","titulo_registro":"C.M de Ombre"},{"material_id":"383","longitud":"-8.094279","latitud":"43.289550","selectedradio":"comunidade","titulo_registro":"C.M de M\u00e1ntaras"},{"material_id":"384","longitud":"-8.105995","latitud":"43.347781","selectedradio":"comunidade","titulo_registro":"C.M de Torres e Vilamateo"}]; ';

        ?> 

        //console.log(recursos);

      </script>
              
  </head>

	<body >
    <div id="espacio_mapa">
      <div id="map"></div> 
      <div id="display_mapa" >
        <div id="display_mapa_close" style="display:none;"> <a href="#">Pechar [X]</a> </div>   
        <div id="display_mapa_content" style="display:none;"></div>
        <div id="display_mapa_filters">
          <div>Búsqueda:</div>
          <div class="buscador">
          <div> <input id="buscaRecursos" type="text"></div>

          <div> Categorías dispoñibles:</div>
          <div class="categorias"></div>
        </div>
      </div>
    </div>
	</body>
</html>
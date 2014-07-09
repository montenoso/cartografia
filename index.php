<?php
session_start();
include("conecta.php");
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Cartografía</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <!--<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700|Open+Sans+Condensed:300,700" rel="stylesheet" />-->
        <link rel="stylesheet" type="text/css" href="http://montenoso.net/cartografia/css/accordion.css" />
        <link rel="stylesheet" type="text/css" href="http://montenoso.net/cartografia/css/bdd.css" />
        
        <script src="http://montenoso.net/cartografia/js/jquery.min.js"></script>
        <script src="http://montenoso.net/cartografia/js/config.js"></script>
        <script src="http://montenoso.net/cartografia/js/skel.min.js"></script>
        <script src="http://montenoso.net/cartografia/js/skel-panels.min.js"></script>
        <noscript>
            <link rel="stylesheet" href="http://montenoso.net/cartografia/css/skel-noscript.css" />
            <link rel="stylesheet" href="http://montenoso.net/cartografia/css/style.css" />
            <link rel="stylesheet" href="http://montenoso.net/cartografia/css/style-desktop.css" />
            <link rel="stylesheet" href="http://montenoso.net/cartografia/css/style-wide.css" />
        </noscript>
        <!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><script src="js/html5shiv.js"></script><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
        <!--[if lte IE 7]><link rel="stylesheet" href="css/ie7.css" /><![endif]-->
        
        <script src="http://montenoso.net/cartografia/js/jquery.easing.1.3.js"></script> <!-- easing -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> <!-- jQuery -->
        
        <script type="text/javascript" src="http://montenoso.net/cartografia/js/prototype.js"></script>
        <script type="text/javascript" src="http://montenoso.net/cartografia/js/effects.js"></script>
        <script type="text/javascript" src="http://montenoso.net/cartografia/js/accordion.js"></script>
        
         <script src="http://montenoso.net/cartografia/openlayersmaster/lib/OpenLayers.js"></script> 
        <link rel="stylesheet" href="http://montenoso.net/cartografia/openlayersmaster/theme/default/style.css" type="text/css">
       
     <!-- <script src="http://www.openlayers.org/api/OpenLayers.js"></script>-->
        
        <!--<script src="js/jquery-1.3.2.js"></script>-->
        <script src="http://montenoso.net/cartografia/postMap-montes2.js"></script>
        <script src="http://montenoso.net/cartografia/js/ajax.js"></script> <!-- cargar contenido en div -->
        <script src="http://montenoso.net/cartografia/js/ajax9.js"></script> <!-- buscador general -->
        
          <script src="http://montenoso.net/cartografia/js/verTodo.js"></script> <!-- ver todos archivos en el mapa-->
        <script src="http://montenoso.net/cartografia/js/ocultarTodo.js"></script><!-- ocultar todos archivos en el mapa-->
        <script src="http://montenoso.net/cartografia/js/posicionarElemento.js"></script>
        <script src="http://montenoso.net/cartografia/js/valoresInsertar.js"></script>
        <script src="http://montenoso.net/cartografia/js/valoresFormRuta.js"></script>
        <script src="http://montenoso.net/cartografia/js/valoresArchivosSelec.js"></script>
        <script src="http://montenoso.net/cartografia/js/upload.js"></script>
        <script src="http://montenoso.net/cartografia/js/pasarIdDoc.js"></script>
        <script src="http://montenoso.net/cartografia/js/ficha.js"></script>
        
        <script src="http://montenoso.net/cartografia/js/CargarRelatos.js"></script>
        <script src="http://montenoso.net/cartografia/js/ficha-mask.js"></script>
        
        <script type="text/javascript">
            function showUser(str)
            {
            if (str=="")
              {
              document.getElementById("txtHint").innerHTML="";
              return;
              } 
            if (window.XMLHttpRequest)
              {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
              }
            else
              {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
            xmlhttp.onreadystatechange=function()
              {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
                }
              }
            xmlhttp.open("GET","bTema.php?q="+str,true);
            xmlhttp.send();
            }
        </script>

        <SCRIPT type="text/javascript">
            function updateMap(paneName) {
                map.updateSize();
                if (window.console) console.log("RESIZE");
            }
            
            $(document).ready(function () {
                    $('body').layout({ 
                        applyDefaultStyles: true, 
                        onopen_end: updateMap,
                        onclose_end: updateMap
                    });
                    
                    $("#buscador_form").submit(function(){
                        var valor=$("#input_busqueda").val();
                        console.log(valor);
                        showBusqueda(valor);
                        return false;
                    });
            });
        </SCRIPT>
        
    	<script type="text/javascript"> <!-- ACORDEON -->
			
		//
		//  In my case I want to load them onload, this is how you do it!
		// 
		Event.observe(window, 'load', loadAccordions, false);
	
		//
		//	Set up all accordions
		//
		function loadAccordions() {
			var topAccordion = new accordion('horizontal_container', {
				classNames : {
					toggle : 'horizontal_accordion_toggle',
					toggleActive : 'horizontal_accordion_toggle_active',
					content : 'horizontal_accordion_content'
				},
				defaultSize : {
					width : 250
				},
				direction : 'horizontal'
			});
			
			var bottomAccordion = new accordion('vertical_container');
			
			var nestedVerticalAccordion = new accordion('vertical_nested_container', {
			  classNames : {
					toggle : 'vertical_accordion_toggle',
					toggleActive : 'vertical_accordion_toggle_active',
					content : 'vertical_accordion_content'
				}
			});
			
			// Open first one
			bottomAccordion.activate($$('#vertical_container .accordion_toggle')[0]);
			
			// Open second one
			topAccordion.activate($$('#horizontal_container .horizontal_accordion_toggle')[2]);
		}
		
	</script> <!-- FIN ACORDEON -->
                
    </head>
    <!--
		Note: Set the body element's class to "left-sidebar" to position the sidebar on the left.
		Set it to "right-sidebar" to, you guessed it, position it on the right.
	-->
	<body onload="init()" class="left-sidebar">

        <!-- Wrapper -->
            <div id="wrapper">

            <!-- Content -->
                <div id="content">
                        <div id="map"></div> 
                </div>

                <!-- Sidebar -->
                <div id="sidebar">
               <!-- Logo -->
                <form id="form1" name="form1" method="post" action="http://montenoso.net/cartografia/">
                    <div id="logo" a href="#" onclick="javascript:document.form1.submit();" style="cursor:pointer;"> 
                </form>
                    </div>
                     </br>
                    <div id="texto">  "Cartografía aberta.</br> En Desenvolvemento."</div>
                    </br>
                <!--------------------------- MENÚ ACORDEÓN ------------------------------>
                <div id="accordion">
                <div id="vertical_container" >
             
                     <!--------------------------- BUSCA------------------------------>   
                    <!---     <h1 class="accordion_toggle">Busca</h1>
                        <div class="accordion_content">   
                            <div>
                            <br/>
                                <form id="buscador_form">
                                    <input type="text" name="busqueda" id="input_busqueda"></input>
                                    <input type="submit" value="Buscar"></input>
                                </form>
                            <br/>
                                <div id="resultadosBusqueda"></div>
                            </div>
                          <!--<p>  </div></p>-->

                      
                
                        <h1 class="accordion_toggle">Visualiza</h1>
                        <div class="accordion_content">
                        <!------------------------------ DOCUMENTOS --------------------------------->
                            <!--<p></p>-->
                            <br/>
                            <?php
                                 $sql = "SELECT material_id, longitud, latitud, selectedradio, titulo_registro FROM documento ORDER BY fecha_inser DESC";
                                        $consulta = mysql_query($sql) or die ("No se pudo ejecutar la consulta");
                                        $datos = mysql_query($sql, $conexion);
                                        
                                        $markers=  array();
                                         while ($resultado = mysql_fetch_assoc($datos)) {
                                                    $markers[]=$resultado;
                                        }
                                        $markersJson=json_encode($markers);
                                 ?> 
                                <script language="JavaScript" type="text/javascript">
                                    var markersdata=eval(<?php echo $markersJson; ?>);
                                    //console.log(markersdata+"todo");
                                    //var longitudesJs = eval(<?php echo $longitudesJson; ?>);
                                    //var latitudesJs= eval(<?php echo $latitudesJson; ?>);
                                    //var selectedradiosJs= eval(<?php echo $selectedradiosJson; ?>);
                                </script>
                                    
                                     <!--<form>
                                        <input type="button" id="ver" value="Ver arquivos" onClick="verTodo()"/>
                                    </form>--->
                                    <form>
                                        <input type="button" id="ver" value="Ver Documentos" onClick="verTodo()"/>
                                        <input type="button" id="ocultar" value="Ocultar arquivos" onClick="ocultarTodo()"/>
                                    </form>
                        <br/>
                        </div>
                        <!------------------------------ EDITAR --------------------------------->
                        <h1 class="accordion_toggle">Edita</h1>
                        <div class="accordion_content">
                            <div>
                            <br/>
                                <form>
                                <input type="button" name="insertar_nuevo_archivo" id="insertar_nuevo_archivo" value="Engadir arquivo" onClick="posicionar(); Enviar('insertar_archivo.php','mostrar_insertar'); calendario()"/>
                                </form>
                                <div id= "mostrar_insertar"></div>
                                <div id= "insertar"></div>
                                <div id="output"></div>
                            <br/>
                                <form>
                                <input type="button" value="Formulario Comunidades" onclick="window.open('http://montenoso.net/formularioMontes/');"/>
                                </form>
                            </div>
                            <p></p>

                        </div>
                         <!------------------------------ RELATOS--------------------------------->
                         <h1 class="accordion_toggle">Relatos</h1>
                        <div class="accordion_content">
                        <div class="accordion_content">
                            <div>
                            <br/>
                      <input type="button" href="javascript:void(0);" value ="ARGOZÓN" onclick="Cargar1('relArg.php','content');"><br/> 
                      <input type="button" href="javascript:void(0);" value ="OMBRE" onclick="Cargar2('relOmb.php','content');"><br/>        
                      <input type="button" href="javascript:void(0);" value ="VILAMATEO" onclick="Cargar3('relVila.php','content');"><br/> 
                       <input type="button" href="javascript:void(0);" value ="GUILLADE" onclick="Cargar4('relGui.php','content');"><br/>
                       <input type="button" href="javascript:void(0);" value ="MOURISCADOS" onclick="Cargar5('relMou','content');"><br/>      
                            <br/>
                            </div>
                        </div>
                        </div>

                        <h1 class="accordion_toggle">Contacta</h1>
                        <div class="accordion_content">
                          <form method='post' action= 'send.php'>
                                  Nome: <input name='nombre' type='text'><br>
                                  Email: <input name='mailUs' type='text'><br>
                                  Asunto: <input name='Subject' type='text'><br>
                                  Mensaxe:<br>
                                  <textarea name='descripcion' rows='15' cols='26'>
                                  </textarea><br>
                                  <input type='submit'>
                                  </form>
                            <p></p>
                        </div>
                    
                    <!--------------------------- SOBRE ------------------------------>       
                    
                    <h1 class="accordion_toggle">Sobre</h1>
                        <div class="accordion_content">
                            <div>
                            <br/>
                                Este espazo créase co obxetivo de contrubuír á visibilización dos Montes Veciñais en Man Común galegos e as comunidades que os xestionan. Nel situamos as comunidades e facilitamos os datos básicos sobre elas. Tamén poñemos en común experiencias, documentación e reflexións en torno ás xornadas do equipo en algúns deles. Dan conta dunha liña de traballo do proxecto en torno aos comúns situados e ó hiperlocalismo como estratexia para o estudo desta realidade que racha coa dicotomía público-privado. Son xornadas moi heteroxéneas nas que nos achegamento ás comunidades a través de encontros informais con comuneirxs. Argozón, Guillade, Torres e Vilamateo, Ombre e Mouriscados son as comunidades escollidas para estes primeiros traballos de campo, que han ir espallándose a outras comunidades de montes da nosa xeografía.
                            </div>
                        </div>
                
                    </div> <!-- end vertical_container -->
                    
                     <br>
                        <div id="horizontal_container" >
                        </div>
                </div> <!------------------------------------- end accordion ------------------------------------------>
                        

                </div>
                
            </div>
            

	</body>
</html>
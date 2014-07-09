<?php
session_start();
include("conecta.php");

   ?>     
    <form name="añadirNuevo" id="añadirNuevo" enctype="multipart/form-data" method="post">
                                
    Clicka sobre o mapa para posicionar o teu documento.
    </br>
    <p><input type="text" name="longitud" value='' readonly></p>
    <p><input type="text" name="latitud" value="" readonly></p>
    
    <p> <span class="texto">Documento </span> <input type="file" name="archivo" id="archivo" size="30"></p>
    <p> <span class="texto">Título</span> <input type="text" name="nombre_archivo" ></p>
    <p> <span class="texto"></span> <input type="hidden" name="usuari" > </p>
    <p> <span class="texto">Data   [xxxx-xx-xx]</span> <input type="text" name="fecha_mat" id="datepicker" > </p>
    <p> <span class="texto">URL (clips)</span> <input type="text" name=" URL" size="auto" maxlength="2000" > </p>
    <p> <span class="texto">Descripción</span> <textarea type="text" name="descripcion" rows="7" cols="30" size="auto" maxlength="2000" > </textarea> </p>
    <p> <span class="texto">Tipo</span></br>
        <div id "radios"  style="overflow: hidden; width: auto; height:140">                     
            <img src="images/marcadores/foto.png" alt="foto" />
            <input type="Radio" name="selectedradio" value= 'foto'>Foto 
            <img src="images/marcadores/video.png" alt="video" />
            <input type="Radio" name="selectedradio" value= 'video'>Video </br>
            <img src="images/marcadores/texto.png" alt="texto" />
            <input type="Radio" name="selectedradio" value= 'texto'>Texto 
            <img src="images/marcadores/audio.png" alt="audio" />
            <input type="Radio" name="selectedradio" value= 'audio'>Audio </br>
        </div>
                                    
                                 <p> <span class="texto">_Tags</span></p>
                                <div id="cajaTags"  style="float: left; width: 170px; height: 100px; overflow: auto; border: 1px solid black;" scroll: "yes">                
                                <?php 
                                         $consulta_pestañasTag = "SELECT nombre_tag FROM tag ORDER BY nombre_tag ASC" ;
                                         $resultTag = mysql_query($consulta_pestañasTag,$conexion);
                                               if (!$resultTag) {
                                                    $error=mysql_error($conexion);
                                                    echo ("Ups! Produciuse un erro na consulta.<br>MySQL di: $error<br>A consulta era: $consulta_pestañasTag")."<br>";
                                                }
                        
                                        $tags=  array();
                                                while ($resultado = mysql_fetch_assoc($resultTag)) {
                                                $nombreTag = $resultado['nombre_tag'];
                                                array_push($tags, $nombreTag);
                                                }
                                            $totalTags = count($tags);
                                            for ($i=0;$i<=$totalTags-1;$i++) {
                                                //echo $tags[$i]."</br>";
                                            echo "<input type='checkbox' name='tag[]' value=   '".$tags[$i]."'   /> "       .$tags[$i].  "<br>";
                                             }
                                ?>
                                </div>
                                </br>
                                </br>
                                </br>
                                </br>
                                </br>
                                </br>
                                </br>

                                <div>
                                    <p class="enlace_nuevoTag">crear nuevo tag
                                     <input type='text' name='tagnuevo1'/><input type='text' name='tagnuevo2'/><input type='text' name='tagnuevo3'/></p>
                                </div>

                                </br>
                          
        <p><input type="button" name="Guardar" value="Gardar" size="100" onclick=" borrarMarcadorInsertar() ; uploadAjax()"/></p>
    </form>

<?php


    $longitud = $_POST['longitud'];
    $longitudes= explode(",", $longitud);
    $latitud = $_POST['latitud'];
    $latitudes= explode(",", $latitud);

    $totalLongitudes=count($longitudes);
                                            //for($i=0;$i<$totalLongitudes;$i++){
                                                //echo $longitudes[0]."long"."</br>";
                                                //echo $latitudes[0]."lat"."</br>";
                                                //}


?>
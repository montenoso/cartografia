
      <?php


require_once("conecta.php");

              $sql = "SELECT material_id, selectedradio, titulo_registro, nombre_archivo, url  FROM documento where  true AND selectedradio!='texto' AND selectedradio!='audio' ORDER BY  RAND() LIMIT 28";
              $consulta = mysql_query($sql) or die ("No se pudo ejecutar la consulta");
              $datos = mysql_query($sql, $conexion);
              $markers= array();
      
              while ($resultado = mysql_fetch_assoc($datos)) {
                ?>
                  <div onclick="mapControl.mapa_selecciona_elemento(<?php echo $resultado['material_id']; ?>);" style="position: absolute; left: 0px; top: 0px; transform: translate(0px, 0px) scale(1); opacity: 1;" class="isotope-item">
              <?php
                if( $resultado["selectedradio"] == "foto" ) {
                  echo '<img src="/cartografia_nova/uploads/200_'.$resultado['nombre_archivo'].'" alt="'.$resultado['titulo_registro'].'">';
                  echo '<div class="titulo" style="margin-top:-10px;">'.$resultado['titulo_registro'].'</div>';
                }
                else
                if( $resultado["selectedradio"] == "video" ) {

                  if( preg_match( "#(http|https)://(www\.)?youtube\.com\/watch\?v\=(.*)#",  $resultado['url'], $result)  ){
                    $imaxe_video = "http://img.youtube.com/vi/".$result[3]."/mqdefault.jpg";

                    echo '<img width="200" height="113" src="'.$imaxe_video.'" alt="'.$resultado['titulo_registro'].'">';
                    echo '<div class="titulo" style="margin-top:-10px;">'.$resultado['titulo_registro'].'</div>';
                  }

                }
              ?>
                  </div>
                <?php
              }

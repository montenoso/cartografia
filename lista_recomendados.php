
      <?php


require_once("conecta.php");

              $sql = "SELECT material_id, selectedradio, titulo_registro, nombre_archivo, url ,categoria FROM documento where  true AND selectedradio!='texto' AND selectedradio!='audio' ORDER BY  RAND() LIMIT 28";
              $consulta = mysql_query($sql) or die ("No se pudo ejecutar la consulta");
              $datos = mysql_query($sql, $conexion);
              $markers= array();
      
              while ($resultado = mysql_fetch_assoc($datos)) {
                ?>
              <?php
                if( $resultado["selectedradio"] == "foto" ) {
                  echo '<div onclick="mapControl.mapa_selecciona_elemento('. $resultado['material_id'].');" style="position: absolute; left: 0px; top: 0px; transform: translate(0px, 0px) scale(1); opacity: 1;height:110px;" class="isotope-item">';
                  echo '<div class="tipo inv documento-foto-16" ></div>';
                  echo '<div class="categorias">';
                  

                  $categorias = explode(",", $resultado["categoria"] );
                  if( sizeof( $categorias ) ) {
                    foreach( $categorias as $cat) {
                      if($cat != "") {
                        echo '
                        <div class="cat bgcolor-'.$cat.'">
                          <img src="/cartografia_nova/images/categorias/16x16/'.$cat.'_inv.png">
                        </div>
                        ';
                      }
                    }
                  }


                  echo '</div>';
                  echo '<div class="titulo" >'.$resultado['titulo_registro'].'</div>';
                  echo '<img src="/cartografia_nova/uploads/200_'.$resultado['nombre_archivo'].'" alt="'.$resultado['titulo_registro'].'">';
                  echo '</div>';

                }
                else
                if( $resultado["selectedradio"] == "video" ) {

                  if( preg_match( "#(http|https)://(www\.)?youtube\.com\/watch\?v\=(.*)#",  $resultado['url'], $result)  ){
                    $imaxe_video = "http://img.youtube.com/vi/".$result[3]."/mqdefault.jpg";
                    echo '<div onclick="mapControl.mapa_selecciona_elemento('. $resultado['material_id'].');" style="position: absolute; left: 0px; top: 0px; transform: translate(0px, 0px) scale(1); opacity: 1;height:110px;" class="isotope-item">';
                    echo '<div class="tipo inv documento-video-16" ></div>';
                   echo '<div class="categorias">';
                  

                  $categorias = explode(",", $resultado["categoria"] );
                  if( sizeof( $categorias ) ) {
                    foreach( $categorias as $cat) {
                      if($cat != "") {
                        echo '
                        <div class="cat bgcolor-'.$cat.'">
                          <img src="/cartografia_nova/images/categorias/16x16/'.$cat.'_inv.png">
                        </div>
                        ';
                      }
                    }
                  }


                  echo '</div>';
                    echo '<div class="titulo" >'.$resultado['titulo_registro'].'</div>';
                    echo '<img width="200" height="113" src="'.$imaxe_video.'" alt="'.$resultado['titulo_registro'].'">';
                    echo '</div>';
                  }

                }
              ?>
                <?php
              }

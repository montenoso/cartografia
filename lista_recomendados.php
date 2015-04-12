      <?php


require_once("conecta.php");

              $sql = "SELECT material_id, selectedradio, titulo_registro, nombre_archivo  FROM documento where selectedradio='foto' ORDER BY fecha_inser DESC LIMIT 20";
              $consulta = mysql_query($sql) or die ("No se pudo ejecutar la consulta");
              $datos = mysql_query($sql, $conexion);
              $markers= array();
      
              while ($resultado = mysql_fetch_assoc($datos)) {
                ?>
                  <div onclick="mapControl.mapa_selecciona_elemento(<?php echo $resultado['material_id']; ?>);" style="position: absolute; left: 0px; top: 30x; transform: translate(0px, 0px) scale(1); opacity: 1;" class="isotope-item">
                <?php
                echo '<div class="titulo">'.$resultado['titulo_registro'].'</div>';
                echo '<img src="/cartografia_nova/uploads/300_'.$resultado['nombre_archivo'].'" alt="'.$resultado['titulo_registro'].'">';
                ?>
                  </div>
                <?php
              }
      


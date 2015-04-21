 <style>
div.titulo
{

  background-color: #ffffff;
  opacity:0.5;
  filter:alpha(opacity=50); /* For IE8 and earlier */
}
div.titulo
{
opacity:100%;
  font-weight: bold;
  color: #000000;
  padding-left: 5px;
  text-shadow: 5px 5px 5px #aaa;
}
</style>
      <?php


require_once("conecta.php");

              $sql = "SELECT material_id, selectedradio, titulo_registro, nombre_archivo  FROM documento where selectedradio='foto' ORDER BY fecha_inser DESC LIMIT 4";
              $consulta = mysql_query($sql) or die ("No se pudo ejecutar la consulta");
              $datos = mysql_query($sql, $conexion);
              $markers= array();
      
              while ($resultado = mysql_fetch_assoc($datos)) {
                ?>
             
                  <div onclick="mapControl.mapa_selecciona_elemento(<?php echo $resultado['material_id']; ?>);" style="position: absolute; left: 0px; top: 30x; transform: translate(0px, 0px) scale(1); opacity: 1;" class="isotope-item"></div>
                <?php
                echo '<div class="imaxe" style= "margin-top:0px;"> <img src="/cartografia_nova/uploads/200_'.$resultado['nombre_archivo'].'" alt="'.$resultado['titulo_registro'].'">';

                echo '<div class="titulo" style= " margin-top:-43px;">'.$resultado['titulo_registro'].'</div>';
                ?>
                  </div>

                
                <?php
              }
      

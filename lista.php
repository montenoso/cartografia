<?php
session_start();
include("conecta.php");
										
    //$listado = array();
    $queryBuscar = "SELECT titulo_registro, selectedradio, tag, fecha_inser, material_id FROM documento";
    $result = mysql_query($queryBuscar,$conexion);
                                                                                        
        if (!$result) {
        $error=mysql_error($conexion);
        die ("Se ha producido un error al ejecutar la búsqueda.<br>MySQL dice: $error<br>La query era: $query")."<br>";
        }
                                                                                        
        while ($registro= mysql_fetch_object($result)) {
        $titulo = $registro -> titulo_registro;
        $selectedradio = $registro -> selectedradio;
        $tag = $registro -> tag;
        $fecha_inser = $registro -> fecha_inser;
        $id_doc = $registro -> material_id;
        //array_push($listado, $titulo);
        ?>
        
            <div id="description<?php echo $id_doc; ?>"></div>
            <br>
            <div id="description" onclick="showDoc(<?php echo $id_doc; ?>)"><?php
               echo "Título: ".$titulo."</br>";
               echo "Tipo de archivo: ".$selectedradio."</br>";
               echo "Fecha: ".$fecha_inser."</br>";
               echo "Tag: ".$tag."</br>"; ?>
            </div><?php
        }

?>
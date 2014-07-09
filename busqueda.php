<?php
session_start();
include("conecta.php");
    
   if (isset($_GET['busqueda'])){
      $busqueda = $_GET['busqueda'];
      echo "Búsqueda: ".$busqueda;
      
      if($busqueda == ""){
          echo "introduce tu busqueda"."</br>"."</br>";
          }else{
        $palabras= explode(" ",$busqueda);
        $numeroPalabras=count($palabras);
        //echo $numeroPalabras."    numerototal mix"."</br>";
      
     if($numeroPalabras == 1){
     $queryBuscar = "SELECT * FROM documento WHERE titulo_registro LIKE '%$busqueda%' OR tema LIKE '%$busqueda%' OR tag LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%' OR nombre_archivo LIKE '%$busqueda%' ";


     }elseif($numeroPalabras > 1){
      $queryBuscar = "SELECT * FROM documento WHERE MATCH(titulo_registro, nombre_archivo, descripcion, tema, tag) AGAINST ('%$busqueda%')";
      
      }
      
      $result = mysql_query($queryBuscar,$conexion);
      
  if (!$result) {
     $error=mysql_error($conexion);
     die ("Se ha producido un error al ejecutar la query.<br>MySQL dice: $error<br>La query era: $query")."<br>";
   }
    
    $markers = array();
    
  while ($registro= mysql_fetch_assoc($result)) {
      $markers[]=$registro;
      
       $titulo = $registro['titulo_registro'];
       $descripción= $registro['descripcion'];
       $tema = $registro['tema'];
       $tag = $registro['tag'];
       $nombre = $registro['nombre_archivo'];
       $id_doc = $registro['material_id'];
       //$longitud = $registro['longitud'];
       //$latitud = $registro['latitud'];
       //$selectedRadio = $registro['selectedradio'];

       ?>
        <div id="description<?php echo $id_doc; ?>"></div>
        <br>
        <div id="description" onclick="showDoc(<?php echo $id_doc; ?>)"><?php
           echo "Título: ".$titulo."</br>";
           echo "Descripción: ".$descripción."</br>";
           echo "Tema: ".$tema."</br>";
           echo "Tag: ".$tag."</br>";
           echo "Nombre: ".$nombre; ?>
        </div>
        
        <?php
       }
       
       $markersJson=json_encode($markers);
       ?>
       <script language="JavaScript" type="text/javascript">
                            var markersdata=eval(<?php echo $markersJson; ?>);
                            console.log("busqueda");
                            verTodo();
       </script>
       <?php
    }
}
?>

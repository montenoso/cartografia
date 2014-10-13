<?php
session_start();
include("conecta.php");
    
   if ( isset($_GET['id']) && is_numeric($_GET['id']) ){
      $id = $_GET['id'];      
      
      $queryFicha = "SELECT * FROM documento WHERE material_id = $id";
      
      $result = mysql_query($queryFicha,$conexion);
      
  if (!$result) {
     $error=mysql_error($conexion);
     die ("Producíuse un erro ó executar a consulta.<br>MySQL dice: $error<br>A consulta era: $query")."<br>";
   }
   
   while ($registro= mysql_fetch_object($result)) {
       $titulo = $registro->titulo_registro;
       $descripción= $registro->descripcion;
       $tema = $registro-> tema;
       $tag = $registro-> tag;
       $URL = $registro-> URL;
       $nombre = $registro-> nombre_archivo;
       $tag = $registro-> tag;
       $extension = $registro-> extension;
       $selectedRadio = $registro-> selectedradio;
       ?>
       
        <div id="ficha">
        </br>

        <?php
     
           echo  "<h2>".$titulo."</h2>";
           echo "<div>".$descripción."</div>";
           echo "<div><a href='".$URL."'/>".$URL."</a></div>";
          
           
           /*echo "Tema: ".$tema."</br>";
           echo "Tag: ".$tag."</br>";
           echo "Nombre: ".$nombre."</br>";*/ ?>
            <br>
            
        <?php
       }
   
   }
   
   $nombre_fichero_sin_espacios=str_replace(" ","",$nombre);?> 
            
        <?php
   if($extension == "image/jpeg" || $extension == "image/png" || $extension == "image/gif" || $extension == "image/tiff"){
?> <img src="uploads/<?php echo $nombre_fichero_sin_espacios; ?>"/>
    <br>
<?php }
    if($extension == "audio/x-wav" || $extension =="audio/mpeg"){
?>  <audio controls="controls" src="uploads/<?php echo $nombre_fichero_sin_espacios; ?>"/></audio>
    <br>
<?php }
    if($extension == "video/quicktime" || $extension == "video/mp4"){
?> <video controls="controls" src="uploads/<?php echo $nombre_fichero_sin_espacios; ?>" ></video>
    <br>
<?php }

    echo "<div> ".$tag."</div>";
?>

    <br>
    </br>
              
</div>
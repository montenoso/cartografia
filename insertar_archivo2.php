<?php
session_start();
include("conecta.php");
        
        //echo "dataaaaa".$_POST['nombre_archivo'];
        $binario_titulo=$_FILES['archivo']['name'];

        $binario_peso=$_FILES['archivo']['size'];
        $binario_tipo=$_FILES['archivo']['type'];
        
        $nombre=$_POST['nombre_archivo'];
        $usuari = $_SESSION['nombreusuari'];
        $fecha_mat = $_POST['fecha_mat'];
        $URL=$_POST['URL'];
        $descripcion=$_POST['descripcion'];
        
        $selectedradio = $_POST['selectedradio'];
        $tema=$_POST['tema'];
        $tag=$_POST['tag'];
        $tagnuevo = array();
        $tagnuevo[0]=$_POST['tagnuevo1'];
        $tagnuevo[1]=$_POST['tagnuevo2'];
        $tagnuevo[2]=$_POST['tagnuevo3'];

        $longitud=$_POST['longitud'];
        $latitud=$_POST['latitud'];
        //echo $longitud."long"."</br>";
        //echo $latitud."lat"."</br>";
    
        //if(!empty($_POST['nombre_archivo'])){
            //echo "insert";
    if( $longitud==NULL || $latitud==NULL){             //$binario_titulo==NULL ||
        
        echo "No se pudo finalizar el proceso, falta posicionar un marcador en el mapa...";
        
        }else{
           
           ///////////////////////////////////////////////////////////////////////////// 
           $uploaddir = 'uploads/';
           $tmp_name = $_FILES['archivo']['tmp_name'];
           $nombre_fichero_sin_espacios=str_replace(" ","",$_FILES['archivo']['name']);
           
           $ruta = $uploaddir . $nombre_fichero_sin_espacios;
           
           move_uploaded_file($tmp_name,$ruta);
           
           //echo "tipo   ".$binario_tipo;
           
           switch ($binario_tipo) {
                case "image/jpeg":
                    $fuente = @imagecreatefromjpeg($ruta);
                    $imgAncho = imagesx ($fuente);
                    $imgAlto =imagesy($fuente);
                    
                    $thumbWidth = 100;
                    $new_width = $thumbWidth;
                    $new_height = floor( $imgAlto * ( $thumbWidth / $imgAncho ) );
                    
                    $imagen = imagecreatetruecolor( $new_width, $new_height );
                    //$imagen = ImageCreate($ancho,$alto); 
                    
                      ImageCopyResized($imagen,$fuente,0,0,0,0,$new_width,$new_height,$imgAncho,$imgAlto);
                      
                        //Header("Content-type: image/jpeg");
                        imageJpeg($imagen,"miniaturas/".$nombre_fichero_sin_espacios);
                    break;
                case "image/png":
                    $fuente = @imagecreatefrompng($ruta); //////
                    $imgAncho = imagesx ($fuente);
                    $imgAlto =imagesy($fuente);
                    
                    $thumbWidth = 100;
                    $new_width = $thumbWidth;
                    $new_height = floor( $imgAlto * ( $thumbWidth / $imgAncho ) );
                    
                    $imagen = imagecreatetruecolor( $new_width, $new_height ); ////////////
                    //$imagen = ImageCreate($ancho,$alto); 
                    
                      ImageCopyResized($imagen,$fuente,0,0,0,0,$new_width,$new_height,$imgAncho,$imgAlto);
                      
                        //Header("Content-type: image/png");
                        imagePng($imagen,"miniaturas/".$nombre_fichero_sin_espacios);   ///////////////
                    break;
                case "image/gif":
                    $fuente = @imagecreatefromgif($ruta); //////
                    $imgAncho = imagesx ($fuente);
                    $imgAlto =imagesy($fuente);
                    
                    $thumbWidth = 100;
                    $new_width = $thumbWidth;
                    $new_height = floor( $imgAlto * ( $thumbWidth / $imgAncho ) );
                    
                    $imagen = imagecreatetruecolor( $new_width, $new_height ); ////////////
                    //$imagen = ImageCreate($ancho,$alto); 
                    
                      ImageCopyResized($imagen,$fuente,0,0,0,0,$new_width,$new_height,$imgAncho,$imgAlto);
                      
                        //Header("Content-type: image/jpeg");
                        imageGif($imagen,"miniaturas/".$nombre_fichero_sin_espacios);   ///////////////
                    break;
            }
           
           
           
         ////////////////////////////////////////////////////////////////////////////////       
        
    for($i=0; $i<count($tagnuevo);$i++){
        if(!empty($tagnuevo[$i])){
            $checktag = mysql_query("SELECT nombre_tag FROM tag WHERE nombre_tag='$tagnuevo[$i]'");
            $tagnuevo_exist = mysql_num_rows($checktag);
          
            if ($tagnuevo_exist>0) {
                echo "El tag: $tagnuevo[$i] está en uso";
                
            }else {
            $consulta_insertar= "INSERT INTO tag (nombre_tag) VALUE ('$tagnuevo[$i]')";
            mysql_query($consulta_insertar,$conexion) or die("No se pudo insertar los datos en la base de datos.");
                    echo "Tag: $tagnuevo[$i] introducido";
                    array_push($tag, $tagnuevo[$i]);	
            }
            
            
        }
    }
        
    $tagsSeleccionados = count($tag);
    echo $tagsSeleccionados."tagsSeleccionados";
    
        if($tagsSeleccionados > 1){
            $cadenaTags = implode(',',$tag);
            //echo $cadenaTags."cadenaTags";
            //echo $cadenaTags."tags"."</br>";
            
            $consulta_insertarConTags = "INSERT INTO documento (titulo_registro, peso, extension, descripcion, nombre_archivo, longitud, latitud, URL, selectedradio, tema, tag, usuari,fecha_material) VALUES 
            ('$nombre', '$binario_peso', '$binario_tipo','$descripcion','$binario_titulo', '$longitud','$latitud','$URL', '$selectedradio','$tema', '$cadenaTags', '$usuari','$fecha_mat')";
            mysql_query($consulta_insertarConTags,$conexion) or die("que no que no tags.");
        }else{
            $consulta_insertar = "INSERT INTO documento (titulo_registro, peso, extension, descripcion, nombre_archivo, longitud, latitud, URL, selectedradio, tema, tag, usuari,fecha_material) VALUES 
            ('$nombre', '$binario_peso', '$binario_tipo','$descripcion','$binario_titulo', '$longitud','$latitud','$URL', '$selectedradio','$tema', '$tag[0]', '$usuari', '$fecha_mat')";
            mysql_query($consulta_insertar,$conexion) or die("que no que no.");
        }
    }
            
            
//                                $querymaterial_id= "SELECT material_id FROM documento WHERE titulo_registro='$nombre'";
//                                $resultmaterial_id= mysql_query($querymaterial_id,$conexion) or die("que no que no.");
//                                while ($resultado = mysql_fetch_assoc($resultmaterial_id)) {
//                                                    $material_id = $resultado['material_id'];
//                                                    echo $material_id."iddd"."</br>";
//                                }
                                
//                                $selRutaId="SELECT ruta_id FROM ruta WHERE (usuari_nombre= '$usuario') ORDER BY fechaRuta DESC LIMIT 1";
//                                $resultRutaId = mysql_query($selRutaId,$conexion) or die("que no que no ruta_id.");
//                                    while ($resultado = mysql_fetch_assoc($resultRutaId)) {
//                                            $rutaId = $resultado['ruta_id'];
//                                            echo $rutaId."RutaId"."</br>";
//                                    }
                                
//                                $rutaDoc="INSERT INTO rutaDoc (ruta_id, material_id) VALUES ('$rutaId','$material_id')";
//                                mysql_query($rutaDoc,$conexion) or die("que no que no rutaDoc.");
        //}
    //}
    
    /////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Ficha Comunidade</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/jquery-latest.js" type="text/javascript"></script> 
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="css/styleficha.css">
    <link rel="stylesheet" href="css/taboaComunidade.css" type="text/css"/> 
</head>
<body>
  <div class="site-wrapper" style="overflow:hidden">
  <div id="container"></div>
  <p id="container" class="lead"><a class="btn btn-lg btn-info" style="margin:5px;" onclick="parent.mapControl.mapa_desselecciona();">X</a></p>
  <div class="site-wrapper-inner">
    <div class="cover-container">
      <div class="inner cover">
        <h1 class="cover-heading"><?php echo $titulo;?></h1>

        <p class="lead">
          <?php echo $descripcion;?> 
        </p>
        <p id="mostrartodo" class="lead"><a class="btn btn-lg btn-info" onclick="$('.tablinha').show();$('#mostrartodo').hide();$('#ocultartodo').show();" href="#">Amosar datos</a></p>
        <p id="ocultartodo" style="display:none;" class="lead"><a class="btn btn-lg btn-info" onclick="$('.tablinha').hide();$('#mostrartodo').show();$('#ocultartodo').hide();" href="#">Ocultar datos</a></p>
      </div>

      <div class="tablinha" style="display:none;">
        <?php 
        
          include("conf.php");
          global $typeform_correspondencias;

          include("typeform_export/".$typeform_correspondencias[$id].".php");

        ?> 

      </div>

    </div>
      <div class="transbox">
        <!--p class="lead">
        Localización: Chantada, Lugo. 
        Dimensións: 175ha. 
        </p-->
          <p class="iconos">
            <?php

            if(isset($categorias) && sizeof($categorias) > 0 ) {

              // tamaño de iconos de categoria
              if( sizeof($categorias)  > 5 ) {
                $categoria_size = "64x64";
              }
              else{
                 $categoria_size = "32x32";
              }


              
              foreach($categorias as $cat) {
                if($cat != ""){
                  echo '<IMG SRC="/cartografia_nova/images/categorias/'.$categoria_size.'/'.$cat.'.png">';

                }
              }
            }

            ?> 

        </p>

      </div>
</div>
</div>
  <script type="text/javascript">
  
  </script>
</body>
</html>

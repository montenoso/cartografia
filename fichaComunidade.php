<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Ficha Comunidade></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="css/styleficha.css">
    
</head>
<body>
  <div class="site-wrapper">
  <div class="site-wrapper-inner">
    <div class="cover-container">
      <div class="inner cover">
        <h1 class="cover-heading"><?php echo $titulo;?></h1>

        <p class="lead">
          <?php echo $descripcion;?> 
        </p>
        <p class="lead"><a class="btn btn-lg btn-info" href="#">Ver todos os datos</a></p>
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

<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Ficha recurso</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="css/styleFichaRecurso.css">

    <style type="text/css">
html, body {
  overflow: hidden;
}
</style>
 
</head>
<body>
  <div class="transbox2">
    <h1 class="cover-heading" style="text-align:center; padding:20px;"><?php echo $titulo;?></h1>
  </div>
  <div class="site-wrapper" >      
    <div class="site-wrapper-inner">
    
    <div class="cajadevideo">
      <div class="video">
      <?php 


      if( $selectedRadio == "video" ) {

        if( preg_match( "#(http|https)://(www\.)?vimeo\.com/(\d+)#",  $URL, $result) ){

          echo '<iframe src="https://player.vimeo.com/video/'.$result[3].'"frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';

        }
        else
        if( preg_match( "#(http|https)://(www\.)?youtube\.com\/watch\?v\=(.*)#",  $URL, $result)  ){
          echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$result[3].'" frameborder="0" allowfullscreen></iframe>';
        }
      }
      else 
      if( $selectedRadio == "foto" ) {
        echo '<img src="/cartografia_nova/uploads/800_'.$nombre.'" alt="'.$titulo.'">';
      }
      else
      if( $selectedRadio == "audio" ) {
        if( preg_match( "#(http|https)://(www\.)?soundcloud\.com\/(.*)#",  $URL, $result)  ){

          //Get the JSON data of song details with embed code from SoundCloud oEmbed
          $getValues=file_get_contents('http://soundcloud.com/oembed?format=js&url='.$URL.'&iframe=true');
          //Clean the Json to decode
          $decodeiFrame=substr($getValues, 1, -2);
          //json decode to convert it as an array
          $jsonObj = json_decode($decodeiFrame);

          //Change the height of the embed player if you want else uncomment below line
          echo  $jsonObj->html;
        }
      }
      else
      if( $selectedRadio == "documento" ) {
        echo '<a href="/cartografia_nova/uploads/'.$nombre.'">DESCARGA</a>';
      }



      ?>
      </div>

        <div class="cover-container" >
          <div class="inner cover">
          </div>
        </div>
          <div class="transbox">
            <p class="lead">
            Monte: <?php echo $nomePai;?>. 
            Documentadorx: <?php echo $usuari;?>.
            Descripación: <?php echo $descripcion;?>
            </p>
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
  <script type="text/javascript">
  
  </script>
</body>
</html>

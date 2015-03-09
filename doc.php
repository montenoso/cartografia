<?php




  function lista_comunidades() {
    require_once("conecta.php");
    
    $retObj = false;
    $queryFicha = "SELECT * FROM documento WHERE selectedradio = 'comunidade'";

    $result = mysql_query($queryFicha,$conexion);

    if(!$result) {
      $retObj = false;
    }
    else {
      while ( $item = mysql_fetch_object( $result ) ) {
        $retObj[] = $item;
      }
    }


    return $retObj;
  }

  $comunidades = lista_comunidades();


?>


<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="css/iconografias.css" rel="stylesheet">
    <link href="js/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style> 
      .help-block {visibility:hidden;height:0;width:0;padding:0;margin:0;} 

    </style>
  </head>
  <body>

    <div class="form-group col-xs-12">
      <h1>Novo documento</h1>
    </div>
    <form >
          <div class="form-group" style="height:140px;">
            <label class="control-label col-xs-12" for="lastname">Comunidade á que pertence</label>
            <div class="col-xs-5">
              <select class="form-control" onchange="parent.formControl.seleccionaComunidade(this);" name="comunidade" id="comunidade" >
                <option value="default" >Elixe unha opción</option>
                <?php 

                  foreach( $comunidades as $comunidade ) {
                    echo "<option value='".$comunidade->material_id."'  lat='".$comunidade->latitud."' lon='".$comunidade->longitud."' >".$comunidade->titulo_registro."</option>";
                  }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group" style="height:60px;">
              <label class="control-label col-xs-10" for="lastname">Localización xeográfica:</label>
              <div class="col-xs-4">
                  <div class="input-group">
                    <button type="button" class="btn btn-primary" onclick="parent.formControl.capturaCoordenadas();">
                      <span class="glyphicon glyphicon glyphicon-screenshot"></span> Click no mapa
                    </button>
                  </div>
              </div>
              <div class="col-xs-4">
                  <div class="input-group">
                      <span class="input-group-addon">lat</span>
                      <input type="text" name="lat" id="lat" class="form-control" placeholder="43,3624">
                  </div>
              </div>
              <div class="col-xs-4">
                  <div class="input-group">
                      <span class="input-group-addon">lon</span>
                      <input type="text" name="lon" id="lon" class="form-control" placeholder="-8,4115">
                  </div>
              </div>

          </div>


        <div class="form-group col-xs-12" >
            <label class="control-label" for="lastname">Acerca do documento:</label>
            <input class="form-control" placeholder="Nome do documento" name="nome" type="text" />
        </div>
        <div class="form-group col-xs-12">
            <textarea name="descripcion" class="form-control" placeholder="Breve descrición" ></textarea>
        </div>
        <div class="form-group" style="height:220px;">

            <label class="control-label col-xs-12" for="lastname">Documento:</label>

            <div class="dropdown col-xs-2">
              <button class="btn btn-info dropdown-toggle" type="button" id="tipoDocumento" data-toggle="dropdown" aria-expanded="true">
                <span class="txt">Vídeo</span>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu" >
                <li role="presentation" onclick="parent.formControl.setTipoDocumento('foto')"><a role="menuitem" tabindex="-1" href="#">Foto</a></li>
                <li role="presentation" onclick="parent.formControl.setTipoDocumento('video')"><a role="menuitem" tabindex="-1" href="#">Video</a></li>
                <li role="presentation" onclick="parent.formControl.setTipoDocumento('audio')"><a role="menuitem" tabindex="-1" href="#">Audio</a></li>
                <li role="presentation" onclick="parent.formControl.setTipoDocumento('arquivo')"><a role="menuitem" tabindex="-1" href="#">Arquivo</a></li>
              </ul>
            </div>
            <div class="col-xs-9">
              <input class="form-control" placeholder="http:// (youtube ou vimeo)" name="firstname" type="text" />
            </div>

        </div>

        <div class="form-group col-xs-12" >
            <label class="control-label" for="lastname">Categorías ás que pertence:</label>
            <div class="btn-group col-xs-13" role="group" aria-label="...">
              <button type="button" title="Actividades" class="btn btn-default"><div class="categoria-actividades-16"></div></button>
              <button type="button" title="Agricultura" class="btn btn-default"><div class="categoria-agriucltura-16"></div></button>
              <button type="button" title="Banco de coñecemento" class="btn btn-default"><div class="categoria-bancoConecemento-16"></div></button>
              <button type="button" title="Comúns" class="btn btn-default"><div class="categoria-comuns-16"></div></button>
              <button type="button" title="Comunidades" class="btn btn-default"><div class="categoria-comunidades-16"></div></button>
              <button type="button" title="Ecoloxía" class="btn btn-default"><div class="categoria-ecoloxia-16"></div></button>
              <button type="button" title="Gandeiría" class="btn btn-default"><div class="categoria-gandeiria-16"></div></button>
              <button type="button" title="Instalacións" class="btn btn-default"><div class="categoria-instalacions-16"></div></button>
              <button type="button" title="Lexislación" class="btn btn-default"><div class="categoria-lexislacion-16"></div></button>
              <button type="button" title="Mancomún" class="btn btn-default"><div class="categoria-mancomun-16"></div></button>
              <button type="button" title="Monte madeirable" class="btn btn-default"><div class="categoria-monteMadeirable-16"></div></button>
              <button type="button" title="Feminismos" class="btn btn-default"><div class="categoria-transfeminismos-16"></div></button>
              <button type="button" title="Xestión" class="btn btn-default"><div class="categoria-xestion-16"></div></button>
            </div>
        </div>
        <div class="form-group col-xs-8" >
            <label class="control-label" for="tags">Etiquetas:</label>
            <input class="form-control" placeholder="separadas por coma (,)" name="tags" type="text" />
        </div>

        <div class="form-group pull-right" >
          <div class="col-xs-4  ">
            <div class="input-group">
              <button  class="btn btn-danger">Cancelar</button>
            </div>
          </div>
          <div class="col-xs-1">
            <div class="input-group">
             <button type="submit" class="btn btn-success">Subir documento</button>
            </div>
          </div>
        </div>
    </form>


    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/vendor/jquery.validate.js"></script>
    <script type="text/javascript">

       $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg != value;
       }, "Value must not equal arg.");

      $('form').validate({
          rules: {
 
              comunidade: { valueNotEquals: "default" },
              lat: {
                  minlength: 2,
                  required: true
              },
              lon: {
                  minlength: 2,
                  required: true
              },
              nome: {
                  minlength: 5,
                  maxlength: 200,
                  required: true
              },
              descripcion: {
                  minlength: 5,
                  maxlength: 700,
                  required: true
              }
          },
          highlight: function(element) {
              $(element).closest('.form-group').addClass('has-error');
          },
          unhighlight: function(element) {
              $(element).closest('.form-group').removeClass('has-error');
          },
          errorElement: 'span',
          errorClass: 'help-block',
          errorPlacement: function(error, element) {
              if(element.parent('.input-group').length) {
                  error.insertAfter(element.parent());
              } else {
                  error.insertAfter(element);
              }
          }
      });




    </script>
  </body>
</html>
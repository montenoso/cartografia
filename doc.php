<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="js/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style> .help-block {visibility:hidden;height:0;width:0;padding:0;margin:0;} </style>
  </head>
  <body>


    <form>
        <div class="form-group">
          <label class="control-label" for="localizacion">Localización:</label>      
          <div class="row">

              <div class="col-xs-3">
                <select class="form-control" name="comunidade" id="comunidade" >
                  <option value="default">Comunidade</option>
                  <option value="1">Tal cual</option>
                </select>
              </div>

              <div class="col-xs-3">
                  <div class="input-group">
                      <span class="input-group-addon">lat</span>
                      <input type="text" class="form-control" placeholder="43,3624">
                  </div>
              </div>
              <div class="col-xs-3">
                  <div class="input-group">
                      <span class="input-group-addon">lon</span>
                      <input type="text" class="form-control" placeholder="-8,4115">
                  </div>
              </div>
              <div class="col-xs-2">
                  <div class="input-group">
                    <button type="button" class="btn btn-default">
                      <span class="glyphicon glyphicon glyphicon-screenshot"></span> No mapa
                    </button>
                  </div>
              </div>
          </div>
        </div>


        <div class="form-group" >
            <label class="control-label" for="lastname">Nomes:</label>
            <input class="form-control" placeholder="Nome do documento" name="firstname" type="text" />
        </div>
        <div class="form-group">
            <label class="control-label" for="lastname">Descripción:</label>
                <textarea class="form-control"></textarea>
        </div>
        
            <button type="submit" class="btn btn-primary">Submit</button>
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
              firstname: {
                  minlength: 3,
                  maxlength: 15,
                  required: true
              },
              lastname: {
                  minlength: 3,
                  maxlength: 15,
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
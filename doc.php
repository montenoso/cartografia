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
            <label class="control-label" for="comunidade">Comunidade:</label>
            <div class="input-group">
                <select class="form-control" name="comunidade" >
                  <option value="default">Selecciona...</option>
                  <option value="1">Comunidade 1</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="firstname">Nome:</label>
            <div class="input-group">
                <span class="input-group-addon">$</span>
                <input class="form-control" placeholder="Insira o seu nome próprio" name="firstname" type="text" />
            </div>
        </div>
            
        <div class="form-group">
            <label class="control-label" for="lastname">Apelido:</label>
            <div class="input-group">
                <span class="input-group-addon">€</span>
                <input class="form-control" placeholder="Insira o seu apelido" name="lastname" type="text" />
            </div>
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
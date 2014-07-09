function PasarFormInsertar(){
    var dataString = $('#añadirNuevo').serialize();
    
    alert('Datos serializados: '+dataString);

        $.ajax({
            data:  dataString,
            url:   'insertar_archivo2.php',
            type:  'POST',
            
            success:  function (data) {
                $("#insertar").html(data);

            }
        });
}

function PasarFormAgente(){
    var dataString = $('#añadirNuevoAgente').serialize();
    
    alert('Datos serializados: '+dataString);

        $.ajax({
            data:  dataString,
            url:   'insertar_agente2.php',
            type:  'POST',
            
            success:  function (data) {
                $("#agente").html(data);

            }
        });
}

function PasarFormInsertarRuta(){
    var dataString = $('#añadirNuevoArchivoRuta').serialize();
    
    alert('Datos serializados: '+dataString);

        $.ajax({
            data:  dataString,
            url:   'insertarArchivoRuta2.php',
            type:  'POST',
            
            success:  function (data) {
                $("#insertarCrearRuta").html(data);

            }
        });
}
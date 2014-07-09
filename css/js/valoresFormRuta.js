function PasarFormRuta(){
    var valoresInfoRuta = $('#info_ruta').serialize();
    
    //alert('Datos serializados: '+valoresInfoRuta);

        $.ajax({
            data:  valoresInfoRuta,
            url:   'crearRutaGONO.php',
            type:  'POST',
            
            success:  function (data) {
                $("#info_crearRuta").html(data);

            }
        });
}
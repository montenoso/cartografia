
function formController() {
  var that = this;
  var form = $('#recurso_form');

  that.showForm = function() {
    // establece layout en modo formulario
    interfazControl.setSidebarEngadir();

    // pon cortina sobre mapa 
    mapa.setMapTypeId(google.maps.MapTypeId.HYBRID);
    mapa.setOptions({styles:{}});
    interfazControl.showCortina();

    // Oculta markers e establece zoom en mapa a toda galicia

    mapa.setCenter({lat: 42.7956247, lng: -7.9483766 } )
    mapa.setZoom(8);
    cl.hide_all_markers();
  }


  that.seleccionaProvincia = function() {
    interfazControl.hideCortina();
    $('#selector_provincia .value0').hide();



    switch($('#selector_provincia').val() ){
      case '15':
          mapa.setCenter({lat: 43.0481799, lng: -8.4531704 } );
          mapa.setZoom(10);
        break;
      case '27':
          mapa.setCenter({lat: 43.1175482, lng: -7.8549405 } );
          mapa.setZoom(10);
      
        break;
      case '32': 
          mapa.setCenter({lat: 42.205087, lng: -7.712387 } );
          mapa.setZoom(10);
        break;
      case '36':
          mapa.setCenter({lat: 42.2736426, lng: -8.3454329 } );
          mapa.setZoom(10);
        break;
    }
  }

  that.submit = function() {

  }




  ///
  // Eventos formulario
  ///

  $('#selector_provincia').bind('change', function(){
    that.seleccionaProvincia();
  });

}

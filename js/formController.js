
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


  that.situaMapa = function(lat, lon) {
      interfazControl.hideCortina();
      $('#selector_provincia .value0').hide();
      mapa.setCenter({lat: lat, lng: lon } );
      mapa.setZoom(13);
  }


}


function formController() {
  var that = this;
  var form = $('#recurso_form');


  that.marker = new google.maps.Marker({
    //  position: mapa.getCenter(),
    //  map: false,
  });



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
      $("#iframe_formulario").contents().find('#lat').val(lat);
      $("#iframe_formulario").contents().find('#lon').val(lon);
  }



  that.capturaCoordenadas = function() {
    mapa.setOptions({ draggableCursor: 'crosshair' });
    google.maps.event.addListenerOnce(mapa, 'click', function( event ){
      mapa.setOptions({ draggableCursor: 'move' });
      that.situaMapa(event.latLng.lat(), event.latLng.lng());
    });
  }


}

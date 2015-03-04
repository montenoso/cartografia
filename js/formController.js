
function formController() {
  var that = this;
  var form = $('#recurso_form');


  that.marker = new google.maps.Marker({
        draggable:true
  });

  google.maps.event.addListener( that.marker, 'dragend', function() 
  {
    that.situaMapa( that.marker.getPosition().lat(), that.marker.getPosition().lng() );
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


  that.seleccionaComunidade =  function( select ) {
    var opt = $(select).find(':selected');
    that.situaMapa( parseFloat(opt.attr('lat')), parseFloat(opt.attr('lon')) );
  }

  that.situaMapa = function(lat, lon) {
      interfazControl.hideCortina();
      $('#selector_provincia .value0').hide();

      mapa.setCenter({lat: lat, lng: lon } );
      
      mapa.setZoom(13);
      $("#iframe_formulario").contents().find('#lat').val(lat);
      $("#iframe_formulario").contents().find('#lon').val(lon);

      that.marker.setPosition(new google.maps.LatLng( lat, lon) );
      that.marker.setMap(mapa);
  }



  that.capturaCoordenadas = function() {
    mapa.setOptions({ draggableCursor: 'crosshair' });
    google.maps.event.addListenerOnce(mapa, 'click', function( event ){
      mapa.setOptions({ draggableCursor: 'move' });
      that.situaMapa(event.latLng.lat(), event.latLng.lng());
    });
  }


  that.setTipoDocumento = function( tipo ) {

    var textoBoton = '';
    switch( tipo ){
      case 'foto':
        textoBoton = 'Foto';
        break;
      case 'video':
        textoBoton = 'Video';
        break 
      case 'audio':
        textoBoton = 'Audio';
        break;
      case 'arquivo':
        textoBoton = 'Arquivo';
        break;

    }

    $("#iframe_formulario").contents().find('#tipoDocumento .txt').text( textoBoton );
  }


}

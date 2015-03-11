
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
      
      mapa.setZoom(15);
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


  that.categoria = function( cat ) {
    
    var input_categorias = $("#iframe_formulario").contents().find('#categorias');
    var btn = $("#iframe_formulario").contents().find('#contenedor_categorias .categoria-'+cat+'-16').parent();
    
    if(btn.hasClass('active')){
      input_categorias.val( input_categorias.val().replace(','+cat ,'') );
      btn.removeClass('active');
    }
    else{
      input_categorias.val( input_categorias.val()+','+cat );
      btn.addClass('active');
    }

    btn.blur();


  }


  that.setTipoDocumento = function( tipo ) {

    $("#iframe_formulario").contents().find('#tipoDocumento .selector-documento').removeClass( 'documento-video-16' );
    $("#iframe_formulario").contents().find('#tipoDocumento .selector-documento').removeClass( 'documento-audio-16' );
    $("#iframe_formulario").contents().find('#tipoDocumento .selector-documento').removeClass( 'documento-texto-16' );
    $("#iframe_formulario").contents().find('#tipoDocumento .selector-documento').removeClass( 'documento-foto-16' );


    var textoBoton = '';
    var icono = '';
    switch( tipo ){
      case 'foto':
        textoBoton = 'Foto';
        icono = 'foto';
        break;
      case 'video':
        textoBoton = 'Video';
        icono = 'video';
        break 
      case 'audio':
        textoBoton = 'Audio';
        icono = 'audio';
        break;
      case 'texto':
        textoBoton = 'Texto';
        icono = 'texto';
        break;
    }

    $("#iframe_formulario").contents().find('#tipoDocumento .txt').text( textoBoton );
    $("#iframe_formulario").contents().find('#tipoDocumento .selector-documento').addClass( 'documento-'+icono+'-16' );


    // caixas documento
    $("#iframe_formulario").contents().find('#caixa_documento input').hide();
    $("#iframe_formulario").contents().find('#caixa_documento input').val('');
    $("#iframe_formulario").contents().find('#documento_'+tipo).show();
  }




}



function interfazController() {
  var that = this;

  that.headerHeight = 0;
  that.filtersWidth = 270;
  that.fichaWidth = 500;
  that.engadirWidth = 600;

  that.screenWidth = false;
  that.screenHeight = false;

  that.sidebarStatus = 'filtros';

  that.setScreenSizes = function(){
    that.screenWidth = $(window).width();
    that.screenHeight = $(window).height();


    // establece altos
    var altoReal = that.screenHeight - that.headerHeight;
    
    $('#display_mapa').height( altoReal );
    $('#display_mapa_content').height( altoReal );
    $('#display_mapa_filters').height( altoReal );
    $('#map').height( altoReal);

    // establece anchos
    if( that.sidebarStatus == 'filtros' ) {
      $('#display_mapa').width( that.filtersWidth  );
      $('#display_mapa').css( 'margin-left', that.screenWidth - that.filtersWidth + 'px' );
      $('#map').width( that.screenWidth - that.filtersWidth );
    } 
    else 
    if( that.sidebarStatus == 'ficha_recurso' ) {
      $('#display_mapa').width( that.fichaWidth );
      $('#display_mapa').css( 'margin-left', that.screenWidth - that.fichaWidth + 'px' );
      $('#map').width( that.screenWidth - that.fichaWidth );
    }
    else
    if( that.sidebarStatus == 'engadir' ) {
      $('#display_mapa').width( that.engadirWidth );
      $('#display_mapa').css( 'margin-left', that.screenWidth - that.engadirWidth + 'px' );
      $('#map').width( that.screenWidth - that.engadirWidth );
    }

    if(typeof mapa != 'undefined')
      google.maps.event.trigger(mapa, 'resize')
  }


  that.setSidebarFichaRecurso = function() {
    that.sidebarStatus = 'ficha_recurso';
    $('#display_mapa_filters').hide();
    $('#display_mapa_engadir').hide();
    $('#display_mapa_content').show();
    that.setScreenSizes();
  }

  that.setSidebarFiltros = function() {
    that.sidebarStatus = 'filtros';
    $('#display_mapa_content').hide();
    $('#display_mapa_engadir').hide();
    $('#display_mapa_filters').show();
    that.setScreenSizes();
  }

  that.setSidebarEngadir = function() {
    that.sidebarStatus = 'engadir';
    $('#display_mapa_content').hide();
    $('#display_mapa_filters').hide();
    $('#display_mapa_engadir').show();
    that.setScreenSizes();
  }
}
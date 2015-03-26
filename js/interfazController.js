

function interfazController() {
  var that = this;

  that.headerHeight = $("#nav-topbar").outerHeight();
  console.log(that.headerHeight);
  that.filtersWidth = 55;
  that.fichaWidth = 500;
  that.comunidadeWidth = 700;
  that.engadirWidth = 600;

  that.screenWidth = false;
  that.screenHeight = false;

  that.sidebarStatus = 'filtros';


  that.hideCortina = function() {
    $('#cortina_mapa').hide();
  }

  that.showCortina = function() {

    $('#cortina_mapa').css('background-color', '#000');
    $('#cortina_mapa').css('position', 'absolute');
    $('#cortina_mapa').css({ opacity: 0.5 });

    $('#cortina_mapa').height( $('#map').height() );
    $('#cortina_mapa').width( $('#map').width() );

    $('#cortina_mapa').show();
  }

  that.setScreenSizes = function(){
    that.screenWidth = $(window).width();
    that.screenHeight = $(window).height();


    // establece altos
    var altoReal = that.screenHeight - that.headerHeight;
    
    $('#display_mapa').height( altoReal );
    //$('#display_mapa_content').css('top', 0);
    //$('#display_mapa_content').css('margin-top', that.headerHeight+'px');
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
    if( that.sidebarStatus == 'ficha_comunidade' ) {
      $('#display_mapa').width( that.comunidadeWidth );
      $('#display_mapa').css( 'margin-left', that.screenWidth - that.comunidadeWidth + 'px' );
      $('#map').width( that.screenWidth - that.comunidadeWidth );
    }
    else
    if( that.sidebarStatus == 'engadir' ) {
      $('#display_mapa').width( that.engadirWidth );
      $('#display_mapa').css( 'margin-left', that.screenWidth - that.engadirWidth + 'px' );
      $('#map').width( that.screenWidth - that.engadirWidth );
      $('#display_mapa_engadir iframe').css('height', altoReal-10);
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

  that.setSidebarFichaComunidade = function() {
    that.sidebarStatus = 'ficha_comunidade';
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
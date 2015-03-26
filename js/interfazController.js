

function interfazController() {
  var that = this;

  document.documentElement.style.overflow = 'hidden';  // firefox, chrome
  document.body.scroll = "no"; // ie only


  that.headerHeight = $("#nav-topbar").outerHeight();
  console.log(that.headerHeight);
  that.filtersWidth = 55;
  that.fichaWidth = 500;
  that.comunidadeWidth = 700;
  that.engadirWidth = 600;

  that.destacadosWidth = 200;
  that.destacados_a_partir_de = 800; // tamaño a partir do que se mostrará a barra de destacados

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

      if( that.screenWidth >= this.destacados_a_partir_de ) {// con barra de destacados
        $('#display_mapa').width( that.filtersWidth  );
        $('#display_mapa').css( 'margin-left', that.screenWidth - that.filtersWidth - that.destacadosWidth + 'px' );
        $('#map').width( that.screenWidth - that.filtersWidth - that.destacadosWidth );
        $('#display_destacados').width( that.destacadosWidth  );
        $('#display_destacados').show()
      }
      else { // Sen barra de destacados
        $('#display_mapa').width( that.filtersWidth  );
        $('#display_mapa').css( 'margin-left', that.screenWidth - that.filtersWidth + 'px' );
        $('#map').width( that.screenWidth - that.filtersWidth );
      }

      //$('#buscaRecursos').css( 'top',  $('#buscaRecursos').height() + 'px' );
      //$('#buscaRecursos').css( 'right',  $('#buscaRecursos').width()-60 + 'px' );

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
    $('#display_destacados').hide();
    $('#display_mapa_content').show();
    that.setScreenSizes();
  }

  that.setSidebarFichaComunidade = function() {
    that.sidebarStatus = 'ficha_comunidade';
    $('#display_mapa_filters').hide();
    $('#display_mapa_engadir').hide();
    $('#display_destacados').hide();
    $('#display_mapa_content').show();
    that.setScreenSizes();
  }

  that.setSidebarFiltros = function() {
    that.sidebarStatus = 'filtros';
    $('#display_mapa_content').hide();
    $('#display_mapa_engadir').hide();
    $('#display_destacados').hide();
    $('#display_mapa_filters').show();
    that.setScreenSizes();
  }

  that.setSidebarEngadir = function() {
    that.sidebarStatus = 'engadir';
    $('#display_mapa_content').hide();
    $('#display_mapa_filters').hide();
    $('#display_destacados').hide();
    $('#display_mapa_engadir').show();
    that.setScreenSizes();
  }
}
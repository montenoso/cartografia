

function interfazController() {
  var that = this;

  document.documentElement.style.overflow = 'hidden';  // firefox, chrome
  document.body.scroll = "no"; // ie only
 
console.log($("header.home-header").outerHeight());

  that.headerHeight = $("header.home-header").outerHeight()

  that.fichaWidth = 500;
  that.comunidadeWidth = 700;
  that.engadirWidth = 600;

  that.destacadosHeight = $("#display_destacados").height();
  that.filtersHeight = $("#display_mapa_filters").height();


  that.screenWidth = false;
  that.screenHeight = false;

  that.sidebarStatus = 'filtros';


  that.hideCortina = function() {
    $('#cortina_mapa').hide();
  }

  that.showCortina = function() {
/*
    $('#cortina_mapa').css('background-color', '#000');
    $('#cortina_mapa').css('position', 'absolute');
    $('#cortina_mapa').css({ opacity: 0.5 });

    $('#cortina_mapa').height( $('#map').height() );
    $('#cortina_mapa').width( $('#map').width() );

    $('#cortina_mapa').show();
*/
  }

  that.setScreenSizes = function(){

    that.screenWidth = $(window).width();
    that.screenHeight = $(window).height();




    $('#espacio_mapa').css("margin-top", that.headerHeight +"px");
    $('#espacio_mapa').height(that.screenHeight- that.headerHeight );

    $("#map").height(that.screenHeight-that.headerHeight-that.destacadosHeight-that.filtersHeight);

    $("#display_destacados").css("top", ($("#map").height()+that.filtersHeight+that.headerHeight)+"px" );

/*
    // establece altos
    var altoReal = that.screenHeight - that.headerHeight;
    $('#espacio_mapa').width(  that.screenWidth+ "px" );
    $('#display_mapa').height( altoReal );
    //$('#display_mapa_content').css('top', 0);
    //$('#display_mapa_content').css('margin-top', that.headerHeight+'px');
    $('#display_mapa_content').height( altoReal );
    $('#display_mapa_filters').height( altoReal );
    $('#map').height( altoReal);
*/



    var leftSideWidth = that.screenWidth;


    // establece anchos
    if( that.sidebarStatus == 'filtros' ) {

      setTimeout(function(){
        $('#display_tooltip').css( { left: (that.screenWidth/2)+"px", top: ($("#map").height()-40)+"px"} )
        $("#filtros_cat").css( { marginLeft : (that.screenWidth/2 - $("#filtros_cat").width()/2)+"px" });
      }, 1000); 

/*
      if( that.screenWidth >= this.destacados_a_partir_de ) {// con barra de destacados
        $('#display_mapa').width( that.filtersWidth  );
        $('#display_mapa').css( 'margin-left', that.screenWidth - that.filtersWidth - that.destacadosWidth + 'px' );
        $('#map').width( that.screenWidth - that.filtersWidth - that.destacadosWidth );
        $('#display_destacados').width( that.destacadosWidth  );
        $('#display_destacados').height( altoReal  );
        $('#display_destacados').css( "left", that.screenWidth-that.destacadosWidth  +"px"  );
        $('#display_destacados').show()
      }
      else { // Sen barra de destacados
        $('#display_mapa').width( that.filtersWidth  );
        $('#display_mapa').css( 'margin-left', that.screenWidth - that.filtersWidth + 'px' );
        $('#map').width( that.screenWidth - that.filtersWidth );
      }

      //$('#buscaRecursos').css( 'top',  $('#buscaRecursos').height() + 'px' );
      //$('#buscaRecursos').css( 'right',  $('#buscaRecursos').width()-60 + 'px' );
*/
    } 
    else 
    if( that.sidebarStatus == 'ficha_recurso' ) {
      //$('#display_mapa').width( that.fichaWidth );
      $('#display_mapa_content').css( 'position', "absolute");
      $('#display_mapa_content').css( 'top', that.headerHeight +"px");
      $('#display_mapa_content').css( 'width', that.fichaWidth +"px");
      $('#display_mapa_content').css( 'left', that.screenWidth - that.fichaWidth + 'px' );
      $('#display_mapa_content').height(that.screenHeight-that.headerHeight)
      $("#map").height( that.screenHeight - that.headerHeight);
      leftSideWidth = that.screenWidth - that.fichaWidth;
    }
    else
    if( that.sidebarStatus == 'ficha_comunidade' ) {

      $('#display_mapa_content').css( 'position', "absolute");
      $('#display_mapa_content').css( 'top', that.headerHeight +"px");
      $('#display_mapa_content').css( 'width', that.comunidadeWidth +"px");
      $('#display_mapa_content').css( 'left', that.screenWidth - that.comunidadeWidth + 'px' );
      $('#display_mapa_content').height(that.screenHeight-that.headerHeight)

      $("#map").height( that.screenHeight - that.headerHeight);

      leftSideWidth = that.screenWidth - that.comunidadeWidth;



    }
    else
    if( that.sidebarStatus == 'engadir' ) {
      //$('#display_mapa').width( that.engadirWidth );
  /*    $('#display_mapa').css( 'margin-left', that.screenWidth - that.engadirWidth + 'px' );
      $('#display_mapa_engadir iframe').css('height', altoReal-10);
      leftSideWidth = that.screenWidth - that.engadirWidth;*/

      $('#display_mapa_engadir').css( 'position', "absolute");
      $('#display_mapa_engadir').css( 'top', that.headerHeight +"px");
      $('#display_mapa_engadir').css( 'width', that.comunidadeWidth +"px");
      $('#display_mapa_engadir').css( 'left', that.screenWidth - that.comunidadeWidth + 'px' );
      $('#display_mapa_engadir').height(that.screenHeight-that.headerHeight)
      $('#iframe_formulario').height(that.screenHeight-that.headerHeight)

      $("#map").height( that.screenHeight - that.headerHeight);

      leftSideWidth = that.screenWidth - that.comunidadeWidth;

    }



    // LEFT SIDE WIDTH
    $('#espacio_mapa').width(leftSideWidth);
    $("#display_destacados").width(leftSideWidth);
    $("#display_mapa_filters").width(leftSideWidth);
    $("#map").width(leftSideWidth);


    if(typeof mapa != 'undefined') {
      setTimeout(function(){
        google.maps.event.trigger(mapa, 'resize');
      }, 1000); 

    }
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
    $('#display_destacados').show();
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

  that.showTooltip = function( text ) {
    $('#display_tooltip').html(text);    
    $('#display_tooltip').css( { marginLeft : (-$('#display_tooltip').width()/2)+"px" });
    $('#display_tooltip').show();
  }
  that.hideTooltip = function( ) {
    $('#display_tooltip').hide();
  }

}
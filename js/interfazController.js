
var interfazControl = false;

$(document).ready(
  function (){
    interfazControl = new interfazController();
    interfazControl.setScreenSizes();
  }
);



function interfazController() {

  this.headerHeight = 0;
  this.filtersWidth = 200;
  this.fichaWidth = 500;


  this.screenWidth = false;
  this.screenHeight = false;

  this.sidebarStatus = 'filtros';

  this.setScreenSizes = function(){
    this.screenWidth = $(window).width();
    this.screenHeight = $(window).height();


    // establece altos
    var altoReal = this.screenHeight - this.headerHeight;
    
    $('#display_mapa').height( altoReal );
    $('#display_mapa_content').height( altoReal );
    $('#display_mapa_filters').height( altoReal );
    $('#map').height( altoReal);

    // establece anchos
    if( this.sidebarStatus == 'filtros' ) {
      $('#display_mapa_filters').width( this.filtersWidth  );
      $('#display_mapa').css( 'margin-left', this.screenWidth - this.filtersWidth + 'px' );
      $('#map').width( this.screenWidth - this.filtersWidth );
    } 
    else 
    if( this.sidebarStatus == 'ficha_recurso' ) {
      $('#display_mapa_content').width( this.fichaWidth );
      $('#display_mapa').css( 'margin-left', this.screenWidth - this.fichaWidth + 'px' );
      $('#map').width( this.screenWidth - this.fichaWidth );
    }

  }


  this.setSidebarFichaRecurso = function() {
    this.sidebarStatus = 'ficha_recurso';
    $('#display_mapa_filters').hide();
    $('#display_mapa_content').show();
    this.setScreenSizes();
  }

  this.setSidebarFiltros = function() {
    this.sidebarStatus = 'filtros';
    $('#display_mapa_content').hide();
    $('#display_mapa_filters').show();
    this.setScreenSizes();
  }
}
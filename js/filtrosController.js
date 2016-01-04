

function filtrosController() {
  var that = this;
  that.tipodocumentoMapa = {};
  that.selectedCategories = [];


  that.buscadorDiv = '#display_mapa_filters .buscador';
  //that.categoriaDiv = '#display_mapa_filters .categoria';
  that.tipodocumentoDiv = '#display_mapa_filters .categoria';


  that.categoriasFiltros = {
    mancomun: 'Mancomún',    
    feminismos: 'Feminismos'

  };

  that.tipodocumentoFiltros = {
/*    comunidade: 'Comunidades',    
    foto: 'Fotografías',
    video: 'Vídeos',
    audio: 'Audios',
    texto: 'Audios'*/


    actividades: "Actividades",
    agricultura: "Agricultura",
    bancoConecemento: "Banco de Coñecemento",
    comuns: "Comúns",
    comunidades: "Comunidades",
    ecoloxia: "Ecoloxía",
    gandeiria: "Gandeiría",
    instalacions: "Instalacións",
    lexislacion: "Lexislación",
    mancomun: "Mancomún",
    monteMadeirable: "Monte Madeirable",
    transfeminismos: "Transfeminismos",
    xestion: "Xestión"
  };

  that.settipodocumento = function() {
    that.tipodocumentoMapa =  getAllCategories();

console.log(that.tipodocumentoMapa)

    $.each(that.tipodocumentoFiltros, function(i,e){
      //$( that.tipodocumentoDiv ).append('<div class="cat selected inv documento-'+i+'-32"  categoria="' + i + '" ><!--img src="/cartografia_nova/images/marcadores_cluster/filters/' + i + '.png"-->  </div>');
      $( that.tipodocumentoDiv ).append('<div categoria="' + i + '"  class="cat bgcolor-'+i+' selected"><img src="/cartografia_nova/images/categorias/32x32/'+i+'_inv.png"></div>');
      that.selectedCategories.push(i);
    });


    $( that.tipodocumentoDiv ).find('.cat img').click( function( elemento ){
      that.toogleCategoria( $(elemento.target).parent() );
    });
    $( that.tipodocumentoDiv ).find('.cat').click( function( elemento ){
      that.toogleCategoria( $(elemento.target) );
    });


    $( that.tipodocumentoDiv ).find('.cat img').hover( function( elemento ){
      var cat = $(elemento.target).parent().attr('categoria');
      eval('interfazControl.showTooltip( that.tipodocumentoFiltros.'+cat+' );');
    });
    $( that.tipodocumentoDiv ).find('.cat').mouseout( function( elemento ){
      interfazControl.hideTooltip();
    });
  }


  that.toogleCategoria = function( categoriaDiv ) {

    var cat = categoriaDiv.attr('categoria');

    if( $.inArray( cat,  that.selectedCategories )  == -1) {
      // is unselected, then select
      that.selectedCategories.push(cat);
    }
    else {
      // is selected, then unselect
      //that.selectedCategories = $.removeFromArray( cat, that.selectedCategories);
      that.selectedCategories.splice($.inArray(cat, that.selectedCategories),1);
    }

    that.updateCategoryButtons();
  }


  that.updateCategoryButtons = function() {
    $( that.tipodocumentoDiv ).find('.cat').removeClass('selected');

    $.each( $( that.tipodocumentoDiv ).find('.cat'), function(i,e) {
      var cat = $(e).attr('categoria');
      if( $.inArray( cat, that.selectedCategories )  != -1 ) {
        $(e).removeClass('unselected');
        $(e).addClass('selected');
      }
      else {
        $(e).removeClass('selected');
        $(e).addClass('unselected');
      }
    });

    that.filterSelectedCategories();

  }

  that.filterSelectedCategories = function() {
    var enabledPoints = [];

    $.each( that.tipodocumentoMapa, function( i, e ) {

      //console.log(e);
      eval( 'enabledPoints = $.merge( enabledPoints, that.tipodocumentoMapa.' + i + '.elements);');

      /*
      if( $.inArray( i,  that.selectedCategories )  != -1  ) {

        eval( 'enabledPoints = $.merge( enabledPoints, that.tipodocumentoMapa.' + i + '.elements);');
      }*/
    });
    mapControl.setFilters( enabledPoints );
  }

  //
  // Constructor
  //
  
  // categorías
  that.settipodocumento();

  // Buscador

  $('div.filtros-buscar').click(function() {

    $('#buscaRecursos').show( "slow" );
    $('#buscaRecursos').focus();

  });

  that.bodyClickEvent = $('body').bind('click', function( ev){

    if(ev.target.className != 'filtro filtros-buscar boton-filtros' && ev.target.className != 'caixaBusqueda'  ) {
      $('#buscaRecursos').hide( "slow" );
    }
  })




  that.iniciaBuscador = function( recursos_mvmc ) {

//console.log(recursos_mvmc);
//console.log(recursos);

//r = $.merge(recursos, recursos_mvmc);
  //var r = $.merge([], recursos);
  r = $.merge( [], recursos_mvmc );

  //console.log(r);

    that.buscador = new nzAutoCompleter ({
        divId: 'buscaRecursos',
        dialogId: 'buscaRecursosDialog',
        data: r,
        searchIds: ['nome', 'pertence', 'concello', 'distrito'],
        //visiblePattern: ' "<img src=\'/images/marcadores_cluster/" + row.selectedradio + "_point_small.png\'>" +row.titulo_registro',
        visiblePattern:  '"<div class=\'elemento recurso tipo_"+row.selectedradio+"\' >" + "<div class=\'icona bgcolor-"+row.selectedradio+"\'></div>" + "<div class=\'tit\'>" + row.nome + "</div>" + "<div class=\'categoria\'>Concello:"+row.concello+" ("+row.distrito+")</div>" + "</div>"',
        actionSelect: function( row ) { 

          if( row.id ) {
            mapControl.notRegMvmc( row )
            console.log(row);
          }

          $('#buscaRecursos').val('');
          $('#buscaRecursos').hide();
        }
    });
  }
  //console.log(recursos)
}





function filtrosController() {
  var that = this;
  that.categoriasMapa = {};
  that.selectedCategories = [];


  that.buscadorDiv = '#display_mapa_filters .buscador';
  that.categoriasDiv = '#display_mapa_filters .categorias';


  that.categoriasFiltros = {
    comunidade: 'Comunidades',    
    foto: 'Fotografías',
    video: 'Vídeos',
    audio: 'Audios',
    texto: 'Audios'

  };

  that.setCategorias = function() {
    that.categoriasMapa =  getAllCategories();

    $.each(that.categoriasFiltros, function(i,e){
      $( that.categoriasDiv ).append('<div class="cat selected inv documento-'+i+'-32"  categoria="' + i + '" ><!--img src="/cartografia_nova/images/marcadores_cluster/filters/' + i + '.png"-->  </div>');
      that.selectedCategories.push(i);
    });


    $( that.categoriasDiv ).find('.cat img').click( function( elemento ){
      that.toogleCategoria( $(elemento.target).parent() );
    });
    $( that.categoriasDiv ).find('.cat').click( function( elemento ){
      that.toogleCategoria( $(elemento.target) );
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
    $( that.categoriasDiv ).find('.cat').removeClass('selected');

    $.each( $( that.categoriasDiv ).find('.cat'), function(i,e) {
      var cat = $(e).attr('categoria');
      if( $.inArray( cat, that.selectedCategories )  != -1 ) {
        $(e).addClass('selected');
      }
    });

    that.filterSelectedCategories();

  }

  that.filterSelectedCategories = function() {
    var enabledPoints = [];

    $.each( that.categoriasMapa, function( i, e ) {
      if( $.inArray( i,  that.selectedCategories )  != -1  ) {

        eval( 'enabledPoints = $.merge( enabledPoints, that.categoriasMapa.' + i + '.elements);');
      }
    });

    mapControl.setFilters( enabledPoints );
  }

  //
  // Constructor
  //
  
  // categorías
  that.setCategorias();

  // Buscador

  $('#display_mapa_filters div.filtros-buscar').click(function() {
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
  var r = $.merge([], recursos);
  r = $.merge( r, recursos_mvmc );

//console.log(r)
    that.buscador = new nzAutoCompleter ({
        divId: 'buscaRecursos',
        dialogId: 'buscaRecursosDialog',
        data: r,
        searchIds: ['titulo_registro', 'selectedradio'],
        //visiblePattern: ' "<img src=\'/images/marcadores_cluster/" + row.selectedradio + "_point_small.png\'>" +row.titulo_registro',
        visiblePattern:  '"<div class=\'elemento recurso tipo_"+row.selectedradio+"\' >" + "<div class=\'icona bgcolor-"+row.selectedradio+"\'></div>" + "<div class=\'tit\'>" + row.titulo_registro + "</div>" + "<div class=\'categoria\'></div>" + "</div>"',
        actionSelect: function( row ) { 

          if(row.id == false) {
            mapControl.notRegMvmc( row )
          }
          else {
            mapa_establece_url('#recurso/'+row.material_id)
          }
          $('#buscaRecursos').val('');
          $('#buscaRecursos').hide();
        }
    });
  }
  //console.log(recursos)
}





function filtrosController() {
  var that = this;
  that.categoriasMapa = {};
  that.selectedCategories = [];


  that.buscadorDiv = '#display_mapa_filters .buscador';
  that.categoriasDiv = '#display_mapa_filters .categorias';


  that.setCategorias = function() {
    that.categoriasMapa =  getAllCategories();

    $.each(that.categoriasMapa, function(i,e){
      $( that.categoriasDiv ).append('<div class="cat selected"  categoria="' + e.id + '"> <img src="/images/marcadores_cluster/filters/' + i + '.png"></div>');
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
      that.selectedCategories = jQuery.removeFromArray( cat, that.selectedCategories);
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

  that.buscador = new nzAutoCompleter ({
      divId: 'buscaRecursos',
      dialogId: 'buscaRecursosDialog',
      data: recursos,
      searchIds: ['titulo_registro', 'selectedradio'],
      //visiblePattern: ' "<img src=\'/images/marcadores_cluster/" + row.selectedradio + "_point_small.png\'>" +row.titulo_registro',
      visiblePattern: ' "<div class=\'elemento recurso tipo_" + row.selectedradio + "\'>"+ row.titulo_registro+"</div>" ',
      actionSelect: function( row ) { 
        mapControl.mapa_establece_url('#recurso/'+row.material_id)
        $('#buscaRecursos').val('');
      }
  });
}
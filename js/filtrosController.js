

function filtrosController() {
  var that = this;
  that.categoriasMapa = {};
  that.selectedCategories = [];


  that.buscadorDiv = '#display_mapa_filters .buscador';
  that.categoriasDiv = '#display_mapa_filters .categorias';


  that.setCategorias = function() {
    that.categoriasMapa =  getAllCategories();

    $.each(that.categoriasMapa, function(i,e){
      $( that.categoriasDiv ).append('<div class="cat selected"  categoria="' + e.id + '">' + '</div>');
      that.selectedCategories.push(i);
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

  // Constructor
  that.setCategorias();

}
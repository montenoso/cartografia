

function filtrosController() {
  var that = this;
  that.categoriasMapa = {};
  that.selectedCategories = [];


  that.buscadorDiv = '#display_mapa_filters .buscador';
  that.categoriasDiv = '#display_mapa_filters .categorias';


  that.setCategorias = function() {
    that.categoriasMapa =  getAllCategories();

    $.each(that.categoriasMapa, function(i,e){
      $( that.categoriasDiv ).append('<div class="cat" categoria="' + e.id + '">' + '</div>');
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

    //console.log($( that.categoriasDiv ).html())
    $.each( $( that.categoriasDiv ).find('.cat'), function(i,e) {
      console.log(e)
      var cat = $(e).attr('categoria');
      if( $.inArray( cat, that.selectedCategories )  != -1 ) {
        $(e).addClass('selected');
      }
    });

  }

  // Constructor
  that.setCategorias();

}
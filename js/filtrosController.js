

function filtrosController() {
  var that = this;
  that.categoriasMapa = {};


  that.buscadorDiv = $('#display_mapa_filters .buscador');
  that.categoriasDiv = $('#display_mapa_filters .buscador');


  that.setCategorias = function() {
    that.categoriasMapa =  getAllCategories();

    $.each(that.categoriasMapa, function(i,e){
      //alert(i)
      that.categoriasDiv.append('<div class="cat" categoria="'+e.id+'">'+e.id+'</div>');
    });

    that.categoriasDiv.find('.cat').click( function( elemento ){
      that.toogleCategoria( $(elemento.target) );
    });
  }


  that.toogleCategoria = function( categoriaDiv ) {
    alert(categoriaDiv.attr('categoria'))
  }

  // Constructor
  that.setCategorias();

}
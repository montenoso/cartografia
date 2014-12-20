function mapController() {
  var that = this;

  that.clusterer = function( mapa , resources) {

    var iwindow = new smart_infowindow({
      map:mapa,
      box_id: 'caixa_mapa',
      width: 300,
      box_padding:0,
      max_height:250,
      marker_distance: [0,-10], // [top, bottom]
    });

    return new marker_clusterer(
      { icon_path: icons_path, anchor: [12,28] }, // pequenos
      { icon_path: icons_path, anchor: [12,28] },// medianos
      { icon_path: icons_path, anchor:[16,36] }, // ghrandes
      { }, // disabled
      { }, // selected

      {
        map: mapa,
        json_data: resources,
        data_structure: {id: 'material_id', lat: 'latitud', lng: 'longitud'},
        zoom_range : [9,25],
        zIndex: 1 ,
        cluster_radious: 20,
        //show_disabled_points: false, 
        //nocluster_zoom_range: [13,25],
        hover_event: function(marker, data) {

          var recursos="";
          var comunidade="";

          $(data).each( function(i,e) {


            var evento_click = "onclick=\'mapa_establece_url( \"#recurso/" + e.material_id + "\" );\'";

            if( e.titulo_registro != '') {
              if( e.selectedradio == 'comunidade' ) {
                comunidade = comunidade + "<div class='elemento comunidade' " + evento_click + "  >" + e.titulo_registro + "</div>" ;
              }
              else {
                recursos = recursos + "<div class='elemento recurso tipo_"+e.selectedradio+"'  " +evento_click + " >" + e.titulo_registro + "</div>";
              }
            }
          });

          iwindow.open(marker, 'mouseover' , comunidade + recursos );
        }

        
        //debug:true // abre ventana debug de cluster icons
      }
    );
  }


  // define os filters para o sistema de clustering
  that.setFilters = function(listaActivados) {

    var tipos;




    if( typeof listaActivados == 'undefined' ) {
      var listaActivados = [];
      $(recursos).each( function(i,e){
        listaActivados.push( e.material_id );
      });
    }

    tipos = getAllCategories();

    var f = {
      enabled_list: listaActivados,
      categories: []
    };

    $.each(tipos, function(i,e) {
      f.categories.push( e );
    });


    console.log(f.categories)

    cl.filter( f );
  }


  that.mapa_selecciona_elemento = function(id) {


    $.each(recursos, function(i, recurso_data) {

      if ( recurso_data.material_id == id ) {
        console.log(recurso_data.latitud, recurso_data.longitud)
        mapa.setCenter({lat: parseFloat(recurso_data.latitud), lng: parseFloat(recurso_data.longitud) } )
        mapa.setZoom(14);


        cl.marker_select(
            id,
            {
              url: icons_path + "point_selected.png",
              anchor: new google.maps.Point(19,42)
            }
          );

        $.ajax({

          url: "ficha.php" ,
          data: {id:id},
          success: function(datos) {
            $("#display_mapa_content").html( datos );
            interfazControl.setSidebarFichaRecurso();
            //console.log( interfazControl )
          }
        });

      }
    });
  }


  that.mapa_desselecciona = function() { 
    cl.marker_unselect();
      window.location="#";
    $("#display_mapa_content").html( "" );
    interfazControl.setSidebarFiltros();
    if( mapa.getZoom() > 12 ){
      mapa.setZoom(12);  
    }
  }
}

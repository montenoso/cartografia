


$(document).ready(
 function (){

    var url = 'http://montenoso2.cartodb.com/api/v2/viz/9ad57d16-0552-11e4-8ccb-0e10bcd91c2b/viz.json';
/*
    var mapa = new L.Map('map', {
      center: [42.7956247,-7.9483766],
      zoom: 8
    });
*/

/*
    cartodb.createVis(
      'map', 
      url, 
      {
        legends: false
      })
      .done(function(vis, layers) {


        var marker_latlng = new google.maps.LatLng( 42.7956247,-7.9483766 );
        mapa = vis.getNativeMap();
        console.log(mapa);

        var marker = new google.maps.Marker({
          position: marker_latlng,
          map: mapa
        });

        //var cluster_recursos = clusterer(vis.map);
      }
    );*/

/*
 var url = 'http://montenoso2.cartodb.com/api/v2/viz/9ad57d16-0552-11e4-8ccb-0e10bcd91c2b/viz.json';
 cartodb.createVis('map', url)
 .done(function(vis, layers) {
 }); 
*/



    var map;

    var mapOptions = {
      zoom: 9,
      center: new google.maps.LatLng(42.7956247,-7.9483766),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      zoomControl:true,
      zoomControlOptions: { style:google.maps.ZoomControlStyle.SMALL },
      streetViewControl:false,
      panControl:false,
      styles: estilos_mapa
    };
    map = new google.maps.Map(document.getElementById('map'), mapOptions);


    // layer simple desde vista
    cartodb.createLayer(map, 'http://montenoso2.cartodb.com/api/v2/viz/d5f2c756-182a-11e4-9427-0e73339ffa50/viz.json', { legends: false })
    .addTo(map)
    .on('done', function(layer) {
      //console.log(layer);
    });


   // cluster clusterer(map);

    // convertir id's string en integer
    $.each( recursos, function(i,e) {
      recursos[i].material_id = parseInt( e.material_id );
    });



    google.maps.event.addListenerOnce(map, 'idle', function(){
      var cl = clusterer(map, recursos);
      cl.filter( defineFilters() )
      /*cl.filter(
          {enabled_list: [378,376,374],  categories:[]}
        );*/
      //show_all_markers();
    });


  }

);


function clusterer( mapa , resources) {

  var icons_path = 'images/marcadores_cluster/';

  return new marker_clusterer(
    { // pequenos
      icon_path: icons_path,
    },
    { // medianos
      icon_path: icons_path,
      anchor: [12,28]
    },
    { // ghrandes
      icon_path: icons_path,
      anchor:[16,36]
    },
    {
    },
    {
    },
    {
      map: mapa,
      json_data: resources,
      data_structure: {id: 'material_id', lat: 'latitud', lng: 'longitud'},
      zoom_range : [9,25],
      zIndex: 10,
      cluster_radious: 20,
      //show_disabled_points: false, 
      //nocluster_zoom_range: [13,25],
      hover_event: function(marker, data){
        $(data).each(function(i,e){

          //console.log( e.selectedradio );
        });
      }

      
      //debug:true // abre ventana debug de cluster icons
    }
  );
}


// este método queda algo bizarro, pero é debido á natureza do propio marker clusterer e a maneira que ten de categorizar iconos
function defineFilters() {

  var tipos = {};
  var lista_todos = [];


  $(recursos).each( function(i,e){
    eval(
      "if( typeof tipos." + e.selectedradio + "  == 'undefined' ){ " +
      "  tipos." + e.selectedradio + " = {id:'" + e.selectedradio + "', important:false, elements:[], hide:false };" +
      "}" +
      "tipos." + e.selectedradio + ".elements.push(" + e.material_id + ");"
    );

    if( typeof tipos.comunidade != 'undefined' ) {
      tipos.comunidade.important = true;
    }

    lista_todos.push( e.material_id );

  });
  //console.log(tipos);

  var f = {
    enabled_list: lista_todos,
    categories: []
  };

  $.each(tipos, function(i,e) {
    //console.log(e);
    //console.log(e)
    f.categories.push( e );
  });

  console.log(f)
  
//console.log(JSON.stringify( f ))
  return f;
}


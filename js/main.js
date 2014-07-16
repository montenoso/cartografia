


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



    var map;

    var mapOptions = {
      zoom: 8,
      center: new google.maps.LatLng(42.7956247,-7.9483766),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById('map'), mapOptions);


    clusterer(map);

    google.maps.event.addListenerOnce(map, 'idle', function(){
      var cl = clusterer(map, recursos);
      cl.filter(
          {enabled_list: [378,376,374],  categories:[]}
        );
      show_all_markers();
    });


  }
);


function clusterer( mapa , resources) {
  return new marker_clusterer({
    map: mapa,
    json_data: resources,
    data_structure: {id: 'material_id', lat: 'latitud', lng: 'longitud'},
    zoom_range : [12,13],
    zIndex: 10,
    cluster_radious: 20,
    //icon_path: '/img/nntmap/cluster_icons/',
    icon_small_diameter: 18,
    icon_medium_diameter: 20,
    icon_big_diameter: 22,
    //show_disabled_points: false, 
//    nocluster_zoom_range: [16,25],

    debug:true // abre ventana debug de cluster icons
  });

}
  

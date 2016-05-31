
var comunidadesImageMap;

$(document).ready(
  function (){

    interfazControl = new interfazController();
    mapControl = new mapController();
    filtrosControl = new filtrosController();
    formControl = new formController();


    // set sizes
    interfazControl.setScreenSizes();
    $( window ).resize(function() {
      interfazControl.setScreenSizes();
    });



    //var url = 'http://montenoso2.cartodb.com/api/v2/viz/9ad57d16-0552-11e4-8ccb-0e10bcd91c2b/viz.json';

    icons_path = '/cartografia_nova/images/marcadores_cluster/';
    cl = false;

    var mapOptions = {
      zoom: 9,
      center: new google.maps.LatLng(42.7956247,-7.9483766),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      zoomControl:true,
      zoomControlOptions: { style:google.maps.ZoomControlStyle.SMALL},
      mapTypeControl:false,
      streetViewControl:false,
      panControl:false,
      styles: estilos_mapa
    };
    mapa = new google.maps.Map(document.getElementById('map'), mapOptions);


    // recomendados
    google.maps.event.addListener(mapa,'idle',function(){
      actualiza_recomendados();
    });

/*

    var customParams = [
      "LAYERS=Montenoso:mvmc10"
    ];

loadWMS(mapa, "http://213.60.67.111:8080/geoserver/Montenoso/wms", customParams);
*/

  var capaComunidadesOptions = {

      getTileUrl: function(coord, zoom) {

//         var pr = mapa.getProjection();
//var b1 = pr.fromPointToLatLng(coord);
//var b2 = pr.fromPointToLatLng( {x:coord.x+256, y:coord.y+256} );

        var s = Math.pow(2, zoom);
        var twidth = 256;
        var theight = 256;

        //latlng bounds of the 4 corners of the google tile
        //Note the coord passed in represents the top left hand (NW) corner of the tile.
        var gBl = mapa.getProjection().fromPointToLatLng(
          new google.maps.Point(coord.x * twidth / s, (coord.y + 1) * theight / s)); // bottom left / SW
        var gTr = mapa.getProjection().fromPointToLatLng(
          new google.maps.Point((coord.x + 1) * twidth / s, coord.y * theight / s)); // top right / NE

        // Bounding box coords for tile in WMS pre-1.3 format (x,y)
        var bbox = gBl.lng() + "," + gBl.lat() + "," + gTr.lng() + "," + gTr.lat();

        var url = "http://213.60.67.111:8080/geoserver/Montenoso/wms?";

        url += "service=WMS";           //WMS service
        url += "&version=1.1.0";         //WMS version
        url += "&request=GetMap";        //WMS operation
        url += "&layers=Montenoso:mvmc_web"; //WMS layers to draw
        url += "&styles=mvmc_web_montenoso";               //use default style
        url += "&format=image/png";      //image format
        url += "&TRANSPARENT=TRUE";      //only draw areas where we have data
        url += "&srs=EPSG:4326";         //projection WGS84
        url += "&bbox=" + bbox;          //set bounding box for tile
        url += "&width=256";             //tile size used by google
        url += "&height=256";
        //url += "&tiled=true";



        //console.log(mapa.getBounds().getNorthEast().lat(),mapa.getBounds().getNorthEast().lng(), mapa.getBounds().getSouthWest().lat(),mapa.getBounds().getSouthWest().lng() );
        //return "http://213.60.67.111:8080/geoserver/Montenoso/wms?LAYERS=Montenoso:mvmc10&STYLES=&transparent=true&FORMAT=image/png&SERVICE=WMS&VERSION=1.1.1&REQUEST=GetMap&SRS=EPSG:23029&BBOX=521131.00584847,4704432.6312255,622788.37010629,4813549.1312255&WIDTH=477&HEIGHT=512";
//console.log(url);
        return url;

      },

      tileSize: new google.maps.Size(256, 256),
      isPng: true,
      opacity: 1

    };


   comunidadesImageMap = new google.maps.ImageMapType(capaComunidadesOptions);
   mapa.overlayMapTypes.insertAt(0, comunidadesImageMap);


    //loadWMS(mapa, "http://spatial.ala.org.au/geoserver/wms?", customParams);
/*
        var customParams = [
      "FORMAT=image/jpeg",
      "LAYERS=Montenoso:mvmc10"
    ];


    loadWMS(mapa, "http://213.60.67.111:8080/geoserver/Montenoso/wms", customParams);

    */
    // layer simple desde vista
    /*cartodb.createLayer(mapa, 'http://montenoso2.cartodb.com/api/v2/viz/d5f2c756-182a-11e4-9427-0e73339ffa50/viz.json', { legends: false })
    .addTo(mapa)
    .on('done', function(layer) {
      //console.log(layer);
    });*/


    // mvmc centroids (puntos de comunidades que non están en montenoso)
    $.ajax({
      dataType: "json",
      cache : true,
      url: mvmc_url,
      success: function(data){
        mapControl.cargaMVMC(data);
      }
    });

   // cluster clusterer(map);

    // convertir id's string en integer
    $.each( recursos, function(i,e) {
      recursos[i].material_id = parseInt( e.material_id );
    });


    google.maps.event.addListenerOnce(mapa, 'idle', function(){
      cl = mapControl.clusterer(mapa, recursos);
      mapControl.setFilters();

      mapa_establece_url($(location).attr('hash') );


      //show_all_markers();
    });


    $("#display_mapa_close").click(function(){
      mapControl.mapa_desselecciona();
    });

    google.maps.event.addListener(mapa, 'click', function(){

      if( $("#display_mapa_content").attr('src') != '' )
        mapControl.mapa_desselecciona();
    });
  }

);


// Devolve todas as categorías diferentes

function getAllCategories() {

  var tipos = {}

  $(recursos).each( function(i,e){


    $.each(e.categoria, function(i2,ct){
      if(ct !="") {
        eval(
          "if( typeof tipos." + ct + "  == 'undefined' ){ " +
          "  tipos." + ct + " = {id:'" + ct + "', elements:[], hide:false };" +
          "}" +
          "tipos." + ct + ".elements.push(" + e.material_id + ");"
        );
      }
    });


  });


  return tipos;
}


// Devolve todas as categorías diferentes

function getAllDocTypes() {

  var tipos = {}

  $(recursos).each( function(i,e){

    if(e.selectedradio == 'comunidade') {
      var importante = 'true';
    }
    else {
      var importante = 'false';
    }

    eval(
      "if( typeof tipos." + e.selectedradio + "  == 'undefined' ){ " +
      "  tipos." + e.selectedradio + " = {id:'" + e.selectedradio + "', important:"+importante+", elements:[], hide:false };" +
      "}" +
      "tipos." + e.selectedradio + ".elements.push(" + e.material_id + ");"
    );
  });

  return tipos;

}

mapa_establece_url = function(uri) {

  var ruta = uri.replace( /^#/, '' );
  var params = ruta.split('/');

  if(params[0] == 'recurso'){
    mapControl.mapa_selecciona_elemento( params[1] );
    window.location = uri;
  }
  else
  if(params[0] == 'novo'){
    formControl.showForm();
    window.location = uri;
  }
  else
  if(params[0] == 'portada'){
    formControl.showForm();
    window.location = host_cartografia;
  }
}


function actualiza_recomendados() {


  $.ajax({
    type: "POST",
    url: "/cartografia_nova/lista_recomendados.php",
    data: {
      sw_lng: mapa.getBounds().getSouthWest().lng(),
      sw_lat: mapa.getBounds().getSouthWest().lat(),
      ne_lng: mapa.getBounds().getNorthEast().lng(),
      ne_lat: mapa.getBounds().getNorthEast().lat()

    },
    success: function(result) {
      $("#display_destacados_contido").html(result);

    }
  });

}

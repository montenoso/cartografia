


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
    


    var url = 'http://montenoso2.cartodb.com/api/v2/viz/9ad57d16-0552-11e4-8ccb-0e10bcd91c2b/viz.json';

    icons_path = 'images/marcadores_cluster/';
    cl = false;

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
    mapa = new google.maps.Map(document.getElementById('map'), mapOptions);


    // layer simple desde vista
   /* cartodb.createLayer(mapa, 'http://montenoso2.cartodb.com/api/v2/viz/d5f2c756-182a-11e4-9427-0e73339ffa50/viz.json', { legends: false })
    .addTo(mapa)
    .on('done', function(layer) {
      //console.log(layer);
    });*/


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
      if( $("#display_mapa_content").html() != '' )
        mapControl.mapa_desselecciona();
    });
  }

);


// Devolve todas as categorías diferentes

function getAllCategories() {

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
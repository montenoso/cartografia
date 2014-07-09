         var flag=0;
	  var positionMarker;
          var map;
          var longitud = new Array();
          var latitud = new Array();
          var longitud;
          var latitud;
          var longitudRuta;
          var latitudRuta;
          //var activo = new Boolean();
          var insertar;
          var insertarArchivoRuta;
          
function posicionar(){
        insertar = new OpenLayers.Layer.Markers( "Insertar" );
        insertar.id = "Insertar";
        map.addLayer(insertar);		
       
                        
                        //activo = false;
                        
                        console.log("posicionado!");
                        map.events.register("click", map, function(e) {
                        //map.updateSize();
                        positionMarker = map.getLonLatFromPixel(e.xy);
                        console.log(e.xy);
                        
                        console.log("Lon: "+positionMarker.lon+", Lat:"+positionMarker.lat);
                        var size = new OpenLayers.Size(21,25);
                        var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
                        var icon = new OpenLayers.Icon('http://www.montenoso.net/cartografia/images/marker-gold.png', size, offset);
                        var markersInsertar = map.getLayer('Insertar');
                        //if(flag=0){
                        var marcadorcius = new OpenLayers.Marker(positionMarker,icon);
                        //if(activo == false){
                        markersInsertar.addMarker(marcadorcius);
                        //activo = true;
                        console.log("marcar");
                        //flag =1;
                        //} else {
                        
                        //marcadorcius = new OpenLayers.Marker(positionMarker,icon);
                        //markersInsertar.addMarker(marcadorcius);
                        //console.log("Re-marcar");
                        
                        //}
                        //longitud.push(positionMarker.lon);
                        //latitud.push(positionMarker.lat);
                        longitud = positionMarker.lon;
                        //console.log(longitud);
                        latitud = positionMarker.lat;
                        //console.log(latitud);
                        //if(longitud.length > 1){

                        document.añadirNuevo.longitud.value=longitud;
                        document.añadirNuevo.latitud.value=latitud;
                        //console.log(document.añadirNuevo.longitud.value=longitud.toString());
                        //}
                        
            });
}

function posicionarAgente(){
        insertarAgente = new OpenLayers.Layer.Markers( "InsertarAgente" );
        insertarAgente.id = "InsertarAgente";
        map.addLayer(insertarAgente);		
       
                        
                        //activo = false;
                        
                        console.log("posicionadoAgente!");
                        map.events.register("click", map, function(e) {
                        //map.updateSize();
                        positionMarker = map.getLonLatFromPixel(e.xy);
                        console.log(e.xy);
                        
                        console.log("Lon: "+positionMarker.lon+", Lat:"+positionMarker.lat);
                        var size = new OpenLayers.Size(20,20);
                        var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
                        var icon = new OpenLayers.Icon('http://www.constelacionesonline.net/barriosaltos/images/puntero.png', size, offset);
                        var markersInsertarAgente = map.getLayer('InsertarAgente');
                        //if(flag=0){
                        var marcadorcius = new OpenLayers.Marker(positionMarker,icon);
                        //if(activo == false){
                        markersInsertarAgente.addMarker(marcadorcius);
                        //activo = true;
                        console.log("marcarAgente");
                        //flag =1;
                        //} else {
                        
                        //marcadorcius = new OpenLayers.Marker(positionMarker,icon);
                        //markersInsertar.addMarker(marcadorcius);
                        //console.log("Re-marcar");
                        
                        //}
                        //longitud.push(positionMarker.lon);
                        //latitud.push(positionMarker.lat);
                        longitud = positionMarker.lon;
                        //console.log(longitud);
                        latitud = positionMarker.lat;
                        //console.log(latitud);
                        //if(longitud.length > 1){

                        document.añadirNuevoAgente.longitud.value=longitud;
                        document.añadirNuevoAgente.latitud.value=latitud;
                        //console.log(document.añadirNuevo.longitud.value=longitud.toString());
                        //}
                        
            });
}

function posicionar2(){
        insertarArchivoRuta = new OpenLayers.Layer.Markers( "InsertarRuta" );
        insertarArchivoRuta.id = "InsertarRuta";
        map.addLayer(insertarArchivoRuta);		

                        //activo = false;
                        
                        
                        console.log("posicionadoRuta!");
                        //if(flag=0){
                            //falg=1;
                        map.events.register("click", map, function(e) {
                        positionMarker = map.getLonLatFromPixel(e.xy);
                        
                        console.log("Lon: "+positionMarker.lon+", Lat:"+positionMarker.lat);
                        var size = new OpenLayers.Size(20,20);
                        var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
                        var icon = new OpenLayers.Icon('http://www.constelacionesonline.net/barriosaltos/images/icono_video.png', size, offset);
                        var markersInsertarRuta = map.getLayer('InsertarRuta');
                        var marcadorciusus = new OpenLayers.Marker(positionMarker,icon);
                        //if(activo == false){
                        markersInsertarRuta.addMarker(marcadorciusus);
                        //activo = true;
                        //console.log("marcar");
                        //} else {
                          //  console.log("borrar");
                        //markersInsertarRuta.removeMarker(marcadorciusus);
                        //activo = false;
                        //}
                        
                        //longitud.push(positionMarker.lon);
                        //latitud.push(positionMarker.lat);
                        longitudRuta = positionMarker.lon;
                        //console.log(longitud);
                        latitudRuta = positionMarker.lat;
                        //console.log(latitud);
                        //if(longitud.length > 1){

                        document.añadirNuevoArchivoRuta.longitudRuta.value=longitudRuta;
                        document.añadirNuevoArchivoRuta.latitudRuta.value=latitudRuta;
                        //console.log(document.añadirNuevo.longitud.value=longitud.toString());
                        //}
                        
            });
            }


function borrarMarcadorInsertar(){
    console.log("borrado!");
    var capaInsertar = map.getLayer('Insertar');
    capaInsertar.destroy();
    }
    
function borrarMarcadorInsertarAgente(){
    console.log("borradoAgente!");
    var capaInsertarAgente = map.getLayer('InsertarAgente');
    capaInsertarAgente.destroy();
    }    
function borrarMarcadorInsertarRuta(){
    }
      
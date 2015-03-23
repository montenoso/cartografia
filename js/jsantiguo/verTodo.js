var flag=0;
var positionMarker;
var iconos = new Array();
iconos[0] = "/cartografia_nova/images/marcadores/foto.png";
iconos[1] = "/cartografia_nova/images/marcadores/video.png";
iconos[2] = "/cartografia_nova/images/marcadores/audio.png";
iconos[3] = "/cartografia_nova/images/marcadores/texto.png";
//iconos[4] = "iconos_png/";
var icono;
var map;
          
function verTodo(){
    markers = new OpenLayers.Layer.Markers( "Markers" );
    markers.id = "Markers";
    map.addLayer(markers);		
       
    var size = new OpenLayers.Size(32,37); //tamaño del icono!!!
    var offset = new OpenLayers.Pixel(-(size.w), -size.h);
    
    //alert(selectedradiosJs[1]);
    console.log("miau");
    //selectedradiosJs = eval(<?php echo $selectedradiosJson; ?>);
    //console.log(selectedradiosJs[1]);
    for(i=0; i< markersdata.length;i++){
        //document.write(selectedradiosJs[i]);
        //console.log(markersdata[i].selectedradio);
        switch(markersdata[i].selectedradio){
            case "foto":
                icono = iconos[0];
            break;
            case "video":
                icono = iconos[1];
            break;
            case "audio":
                icono = iconos[2];
            break;
            default :
                icono = iconos[3];
        }                        
        //new OpenLayers.Layer.Markers(idmaterial[i]);
        //var idmaterial[i] = new OpenLayers.Marker(new OpenLayers.LonLat(longitudesJs[i],latitudesJs[i]),icon));
        //markers.addMarker(idmaterial[i]);
        var icon = new OpenLayers.Icon(icono, size, offset);
        var newmarker=new OpenLayers.Marker(new OpenLayers.LonLat(markersdata[i].longitud,markersdata[i].latitud),icon);
        newmarker.documentoId=markersdata[i].material_id;
        newmarker.nombre = markersdata[i].titulo_registro;
        newmarker.events.register('mouseover', newmarker, function(evt) { console.log(this.documentoId); OpenLayers.Event.stop(evt); $("#info_marcador").html(this.nombre); });
        newmarker.events.register('click', newmarker, function(evt) { 
            
             if (this.documentoId=="")
  {
  document.getElementById("map").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("map").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ficha.php?id="+this.documentoId,true);
xmlhttp.send();
              
               
                
                 
                  
                   
                     OpenLayers.Event.stop(evt);  });
        
        markers.addMarker(newmarker);
        
        //var sourceMarker=new OpenLayers.Marker(location,icon)
    } 
        
}

function marcadorDoc(){
    console.log("aqui stoy!");
    //marcadorDoc = new OpenLayers.Layer.Markers( "MarcadorDoc" );
//    marcadorDoc.id = "MarcadorDoc";
//    map.addLayer(marcadorDoc);
    
//    var size = new OpenLayers.Size(20,19); //tamaño del icono!!!
//    var offset = new OpenLayers.Pixel(-(size.w), -size.h);
    
//    for(i=0; i< infoMarcador.length;i++){
//        switch(infoMarcador[i].selectedradio){
//            case "foto":
//                icono = iconos[0];
//            break;
//            case "video":
//                icono = iconos[1];
//            break;
//            case "audio":
//                icono = iconos[2];
//            break;
//            default :
//                icono = iconos[3];
//        }
//        var icon = new OpenLayers.Icon(icono, size, offset);
//        var newmarcadorDoc = new OpenLayers.Marker(new OpenLayers.LonLat(infoMarcador[i].longitud,infoMarcador[i].latitud),icon);
//        newmarcadorDoc.documentoId=infoMarcador[i].material_id;
//        newmarcadorDoc.nombre = infoMarcador[i].titulo_registro;
//        newmarcadorDoc.events.register('mouseover', newmarcadorDoc, function(evt) { console.log(this.documentoId); OpenLayers.Event.stop(evt); $("#info_marcador").html(this.nombre); });
        
//        marcadorDoc.addMarker(newmarcadorDoc);
                
//         }               
                                
}
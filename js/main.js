
    $(document).ready(
   function init (){
 /*       var map = new L.Map('map', {
          center: [0,0],
          zoom: 3
        });

        cartodb.createLayer(map, 'http://montenoso2.cartodb.com/api/v2/viz/9ad57d16-0552-11e4-8ccb-0e10bcd91c2b/viz.json')
          .addTo(map)
          .on('done', function(layer) {
              //do stuff
          })
          .on('error', function(err) {
            alert("some error occurred: " + err);
          });*/


        var url = 'http://montenoso2.cartodb.com/api/v2/viz/9ad57d16-0552-11e4-8ccb-0e10bcd91c2b/viz.json';
        cartodb.createVis('map', url)
          .done(function(vis, layers) {
          });   
      }
    );
  

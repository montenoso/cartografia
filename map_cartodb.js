
$(document).ready(
  function init (){

    var url = 'http://montenoso2.cartodb.com/api/v2/viz/9ad57d16-0552-11e4-8ccb-0e10bcd91c2b/viz.json';
    cartodb.createVis('map', url)
      .done(function(vis, layers) {
      });   
  }
);


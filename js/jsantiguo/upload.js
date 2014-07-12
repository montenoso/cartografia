function uploadAjax(){
   /* 
   var oData = new FormData(document.forms.namedItem("añadirNuevo"));
    
    console.log(document.forms.namedItem("añadirNuevo"));
    console.log(oData);
    
    $.ajax({
        url: "insertar_archivo2.php",
        data: oData,
        processData: false,
        method: "POST",
        success: function(respdata) {
            $("#insertar").html(respdata);
        }
    });
   */
    
    var oOutput = document.getElementById("output");
  var oData = new FormData(document.forms.namedItem("añadirNuevo"));

  oData.append("CustomField", "This is some extra data");
  
  var oReq = new XMLHttpRequest();
  oReq.open("POST", "insertar_archivo2.php", true);
  oReq.onload = function(oEvent) {
    if (oReq.status == 200) {
      $("#insertar").html(oReq.responseText);
    } else {
      oOutput.innerHTML = "Error " + oReq.status + " occurred uploading your file.<br \/>";
    }
  };

  oReq.send(oData);
}

function uploadAjaxAgente(){

    
    var oOutputAgente = document.getElementById("outputAgente");
  var oDataAgente = new FormData(document.forms.namedItem("añadirNuevoAgente"));

  oDataAgente.append("CustomField", "This is some extra data");
  
  var oReq = new XMLHttpRequest();
  oReq.open("POST", "insertar_agente2.php", true);
  oReq.onload = function(oEvent) {
    if (oReq.status == 200) {
      $("#agente").html(oReq.responseText);
    } else {
      oOutputAgente.innerHTML = "Error " + oReq.status + " occurred uploading your file.<br \/>";
    }
  };

  oReq.send(oDataAgente);
}
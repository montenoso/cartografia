function showBusqueda(str)
{
  console.log($("#resultadosBusqueda"));
  //$("#resultadosBusqueda").load("busqueda.php?busqueda="+str);  
    
  $.get("busqueda.php?busqueda="+str, function(data) {
      $("#resultadosBusqueda").html(data);
  });
    
/*    
console.log("* "+str);
if (str=="")
  {
  document.getElementById("resultadosBusqueda").innerHTML="";
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
    document.getElementById("resultadosBusqueda").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","busqueda.php?busqueda="+str,true);
xmlhttp.send();
*/
}
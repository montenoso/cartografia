function showDoc(str)
{
    console.log("id llegando!"+str);
if (str=="")
  {
  document.getElementById("basicMap").innerHTML="";
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
    document.getElementById("basicMap").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ficha.php?id="+str,true);
xmlhttp.send();
}
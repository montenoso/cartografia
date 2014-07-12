function Cargar1 (url, target){ 
   var req; 
   if (window.XMLHttpRequest) { 
      req = new XMLHttpRequest(); 
   } 
   else 

      if (window.ActiveXObject) { 
         req = new ActiveXObject("Microsoft.XMLHTTP"); 
      } 
      document.getElementById("content").innerHTML = "Cargando<br>TB podemos poner una IMG de cargando..."; 
      req.onreadystatechange = function() 
      { 
         if (req.readyState == 4) 
         { 
            if (req.status == 200) 
            { 
               document.getElementById("content").innerHTML = req.responseText; 
            } 
            else 
            { 
               document.getElementById("content").innerHTML = "Error"; 
            } 
         } 
      } 
      req.open("GET", "relArg.php", true); 
      req.send(""); 
} 

function Cargar2 (url, target){ 
   var req; 
   if (window.XMLHttpRequest) { 
      req = new XMLHttpRequest(); 
   } 
   else 

      if (window.ActiveXObject) { 
         req = new ActiveXObject("Microsoft.XMLHTTP"); 
      } 
      document.getElementById("content").innerHTML = "Cargando<br>TB podemos poner una IMG de cargando..."; 
      req.onreadystatechange = function() 
      { 
         if (req.readyState == 4) 
         { 
            if (req.status == 200) 
            { 
               document.getElementById("content").innerHTML = req.responseText; 
            } 
            else 
            { 
               document.getElementById("content").innerHTML = "Error"; 
            } 
         } 
      } 
      req.open("GET", "relOmb.php", true); 
      req.send(""); 
} 

function Cargar3 (url, target){ 
   var req; 
   if (window.XMLHttpRequest) { 
      req = new XMLHttpRequest(); 
   } 
   else 

      if (window.ActiveXObject) { 
         req = new ActiveXObject("Microsoft.XMLHTTP"); 
      } 
      document.getElementById("content").innerHTML = "Cargando<br>TB podemos poner una IMG de cargando..."; 
      req.onreadystatechange = function() 
      { 
         if (req.readyState == 4) 
         { 
            if (req.status == 200) 
            { 
               document.getElementById("content").innerHTML = req.responseText; 
            } 
            else 
            { 
               document.getElementById("content").innerHTML = "Error"; 
            } 
         } 
      } 
      req.open("GET", "relVila.php", true); 
      req.send(""); 
} 

function Cargar4 (url, target){ 
   var req; 
   if (window.XMLHttpRequest) { 
      req = new XMLHttpRequest(); 
   } 
   else 

      if (window.ActiveXObject) { 
         req = new ActiveXObject("Microsoft.XMLHTTP"); 
      } 
      document.getElementById("content").innerHTML = "Cargando<br>TB podemos poner una IMG de cargando..."; 
      req.onreadystatechange = function() 
      { 
         if (req.readyState == 4) 
         { 
            if (req.status == 200) 
            { 
               document.getElementById("content").innerHTML = req.responseText; 
            } 
            else 
            { 
               document.getElementById("content").innerHTML = "Error"; 
            } 
         } 
      } 
      req.open("GET", "relGui.php", true); 
      req.send(""); 
}

function Cargar5 (url, target){ 
   var req; 
   if (window.XMLHttpRequest) { 
      req = new XMLHttpRequest(); 
   } 
   else 

      if (window.ActiveXObject) { 
         req = new ActiveXObject("Microsoft.XMLHTTP"); 
      } 
      document.getElementById("content").innerHTML = "Cargando<br>TB podemos poner una IMG de cargando..."; 
      req.onreadystatechange = function() 
      { 
         if (req.readyState == 4) 
         { 
            if (req.status == 200) 
            { 
               document.getElementById("content").innerHTML = req.responseText; 
            } 
            else 
            { 
               document.getElementById("content").innerHTML = "Error"; 
            } 
         } 
      } 
      req.open("GET", "relMou.php", true); 
      req.send(""); 
}
function ajaxFunction() {
    var xmlHttp;
    try {
    // Firefox, Opera 8.0+, Safari
    xmlHttp=new XMLHttpRequest();
    return xmlHttp;
    } catch (e) {
    // Internet Explorer
    try {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    return xmlHttp;
    } catch (e) {
    try {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    return xmlHttp;
    } catch (e) {
    alert("Tu navegador no soporta AJAX!");
    return false;
    }}}
}

function Enviar(_pagina,capa) {
    var
    ajax;
    ajax = ajaxFunction();

    ajax.open("POST", _pagina, true);

    ajax.setRequestHeader("Content-Type",
    "application/x-www-form-urlencoded");
    ajax.onreadystatechange = function()
    {

    if (ajax.readyState == 4)
    {
    document.getElementById(capa).innerHTML =
    ajax.responseText;

    }}
    ajax.send(null);
}
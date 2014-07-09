$(document).ready function ocultarFicha(){{
    //<input type="button" id="volver" value="volver al mapa" onClick="ocultarFicha(); init()"></input>
	$('input.ficha-window').click(function() {

                   var capa=document.getElementById("ficha");
 
                                
                //Getting the variable's value from a link 
	//	var loginBox = $(this).attr('href');

		//Fade in the Popup
		$(capa).fadeIn(300);
		
		//Set the center alignment padding + border see css style
		var popMargTop = ($(capa).height() + 24) / 2; 
		var popMargLeft = ($(capa).width() + 24) / 2; 
		
		$(capa).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('map').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').live('click', function() { 
	  $('#mask , .capa').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
});
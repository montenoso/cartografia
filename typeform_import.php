<?php
header('Content-Type: text/html; charset=utf-8');
require_once('conf.php');

$json = json_decode(file_get_contents( $typeform_api_url ));


$questions = array();

foreach( $json->questions as $question ) {
	$questions[$question->id] = $question->question;
}


$last_q = false;
$last_a = false;

$lines = array();
foreach( $json->responses as $response ) {

	foreach($questions as $qid => $q){
		if($qid == 'terms_1101624') {

		}
		else
		if( preg_match('#group(.*)#', $qid ) )  {
			echo "</table><h3>$q</h3> <table>";
		}
		else
		if( preg_match('#statement(.*)#', $qid ) ) {

		}
		else {
			if(property_exists( $response->answers, $qid ) ) {

				eval('$r = $response->answers->'.$qid.';');


				if(preg_match('#yesno_(.*)#', $qid) ){
					if($r == 1) {
						$r = 'Sí';
					}
					else {
						$r = 'Non';
					}
				} 
				if( strlen($r) > 0) {
					if($q != $last_q){
						echo '<br><b>'.$q.'</b>: '.$r.'';
					}
					else {
						$coma = ($r != '')?',':'';
						echo $coma.' '.$r;
					}
				}
			}
			$last_q = $q;
			$last_a = $r;
		}


	}
}

<?php
header('Content-Type: text/html; charset=utf-8');
echo "<!DOCTYPE html>";
echo "<html><head></head><body>";



require_once('conf.php');

global $typeform_api_url;

$json = json_decode(file_get_contents( $typeform_api_url ));


$questions = array();

foreach( $json->questions as $question ) {
	$questions[$question->id] = $question->question;
}




$last_q = false;
$last_a = false;
	
foreach( $json->responses as $response ) {
	$ID_1 = 0;
	$lines = array();

	foreach($questions as $qid => $q){
		if($qid == 'terms_1101624') {

		}
		else
		if( preg_match('#group(.*)#', $qid ) )  {
			$lines[$ID_1] =$q;
			$ID_1++;
		}
		else
		if( preg_match('#statement(.*)#', $qid ) ) {

		}
		else {
			if(property_exists( $response->answers, $qid ) ) {

				eval('$r = $response->answers->'.$qid.';');


				if(preg_match('#yesno_(.*)#', $qid) ){
					if($r == 1) {
						$r = 'Si';
					}
					else {
						$r = 'Non';
					}
				} 
				if( strlen($r) > 0) {
					if($q != $last_q){
						$ID_1++;
						$lines[$ID_1] =  array($q, $r);
					}
					else {
						$coma = ($r != '')?',':'';
						$lines[$ID_1][1] .= $coma.' '.$r;
					}
				}
			}
			$last_q = $q;
			$last_a = $r;
		}

	}
		imprime_tabla($lines, $response->id);
}



function imprime_tabla($lArray, $typeform_reference) {
	global $typeform_export_path;

	$file_content = '';

	$file_content .= "<table>\n";
	foreach ($lArray as $l) {
		if(is_array($l)) {
			$file_content .= "<tr><td>".$l[0]."</td><td>".$l[1]."</td></tr>\n";
		}
		else {
			$file_content .= "<tr><td><b>".$l."</b></td></tr>\n";
		}
	}
	$file_content .= "</table>\n";


	$fname = $typeform_export_path.'/'.$typeform_reference.'.php';
	if(!file_exists( $fname ) )	{
		file_put_contents($fname, $file_content);
		echo "Arquivo $typeform_reference creado con éxito <br>";
	}
}


